<?php

namespace App\Services;

use App\Http\Requests\InventoryRequest;
use App\Actions\Uploads\StoreImage;
use App\Models\Inventory;
use Illuminate\Support\Facades\Storage;
class InventoryService {
    
    public function createItem(InventoryRequest $request, StoreImage $storeImage)
    {
        // Check if the item already exists
        $existingItem = Inventory::where('item_name', $request->input('item_name'))->first();
        if ($existingItem) {
            // Update the quantity of the existing item
            $existingItem->quantity += $request->input('quantity');
            $existingItem->save();

            return true;
        }
        else {
            // stores image via StoreImage action
            $itemPhotoPath = $storeImage->execute($request, 'item_img', 'items');

            $itemData = $request->validated();
            $itemData['item_img'] = $itemPhotoPath;

            Inventory::create($itemData);

            return false;
        }        
    }

    public function updateItem(InventoryRequest $request, StoreImage $storeImage, $id)
    {
        $item = Inventory::findOrFail($id);

        // Update fields other than the image
        $item->update($request->validated());

        if ($request->hasFile('item_img')) {
            $itemPhotoPath = $storeImage->execute($request, 'item_img', 'items');

            // Delete the previous image file if it exists
            if ($item->item_img) {
                Storage::disk('public')->delete($item->item_img);
            }

            // Update the item_img field with the new file path
            $item->item_img = $itemPhotoPath;
            $item->save();
        }

        if ($item->wasChanged()) {
            return [
                'success' => true,
                'item' => $item
            ];
        } else {
            return [
                'success' => false,
                'error' => 'No changes were made to the item.'
            ];
        }
    }
}