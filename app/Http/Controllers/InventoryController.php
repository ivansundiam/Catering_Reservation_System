<?php

namespace App\Http\Controllers;

use App\Actions\Uploads\StoreImage;
use App\Models\Inventory;
use App\Services\InventoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\InventoryRequest;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $inventory = Inventory::orderBy('id', 'desc')->paginate(10);
        return view('admin.inventory')->with('inventoryItems', $inventory);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
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
