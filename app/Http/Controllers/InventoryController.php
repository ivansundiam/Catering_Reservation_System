<?php

namespace App\Http\Controllers;

use App\Actions\Uploads\StoreImage;
use App\Models\Inventory;
use App\Services\InventoryService;
use Illuminate\Contracts\View\View;
use App\Http\Requests\InventoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : View
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category');
        $quantityStatusFilter = $request->input('quantity-status');

        $query = Inventory::query();
            
        if($search) {
            $query->where('item_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");   
        }

        if($categoryFilter !== 'all'){
            $query->where('category', $categoryFilter);
        }

        if($quantityStatusFilter === "low"){
            $query->where('quantity', '<', 100);
        }
        else if($quantityStatusFilter === "very low"){
            $query->where('quantity', '<', 50);
        }

        $inventory = $query
            ->orderBy('id', 'desc')
            ->paginate(10);

        // If no filters or search terms are provided, load all inventory
        if(!$search && !$categoryFilter && !$quantityStatusFilter){
            $inventory = Inventory::orderBy('id', 'desc')->paginate(10);
        }

        return view('admin.inventory')->with('inventoryItems', $inventory);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryRequest $request, InventoryService $inventoryService, StoreImage $storeImage)
    {
        try {
            // creates an item and expects boolean value
            $itemExists = $inventoryService->createItem($request, $storeImage);

            // returns with different message if $itemExist
            return redirect()->route('inventory.index')
                ->with('success', $itemExists 
                    ? "Item quantity updated successfully" 
                    : "Item added successfully");
        } catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while creating items: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while creating items.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Inventory::findOrFail($id);
        return view('admin.inventory-details', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InventoryRequest $request, StoreImage $storeImage, InventoryService $inventoryService ,$id)
    {
        try {
            $result = $inventoryService->updateItem($request, $storeImage, $id);

            if ($result['success']) {
                return redirect()->route('inventory.show', ['inventory' => $result['item']->id])->with([
                    'success' => 'Item updated successfully',
                    'item' => $result['item']
                ]);
            } else {
                return back()->withErrors(['error' => $result['error']]);
            }
        } catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while updating items: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while updating items.');
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventoryService $inventoryService, $id)
    {
        try{
            $inventoryService->deleteItem($id);
    
            return redirect()->route('inventory.index')->with('success', "Items deleted successfully");
        }
        catch (\Exception $e) {
            // Handle any other exceptions
            Log::error('An error occurred while deleting the items: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'An error occurred while deleting the items.');
        }
    }
}
