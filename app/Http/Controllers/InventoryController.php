<?php

namespace App\Http\Controllers;

use App\Actions\Uploads\StoreImage;
use App\Models\Inventory;
use App\Services\InventoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\InventoryRequest;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : View
    {
        $search = $request->input('search');

        $inventory = Inventory::where(function ($query) use ($search) {
            $query->where('item_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('quantity', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.inventory')->with('inventoryItems', $inventory);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryRequest $request, InventoryService $inventoryService, StoreImage $storeImage)
    {
        // creates an item and expects boolean value
        $itemExists = $inventoryService->createItem($request, $storeImage);

        // returns with different message if $itemExist
        return redirect()->route('inventory.index')
            ->with('success', $itemExists 
                ? "Item quantity updated successfully" 
                : "Item added successfully");

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
        $result = $inventoryService->updateItem($request, $storeImage, $id);

        if ($result['success']) {
            return redirect()->route('inventory.show', ['inventory' => $result['item']->id])->with([
                'success' => 'Item updated successfully',
                'item' => $result['item']
            ]);
        } else {
            return back()->withErrors(['error' => $result['error']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
