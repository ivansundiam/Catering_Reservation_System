<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use App\Actions\Uploads\StoreImage;
use Illuminate\Http\Request;

class ReservationService {
    
    public function createReservation(ReservationRequest $request, StoreImage $storeImage) 
    {
        // stores image via StoreImage action
        $receiptPhotoPath = $storeImage->execute($request, 'receipt-img', 'receipts');

        $resData = $request->validated();
        $resData['user_id'] = Auth::id();
        $resData['receipt_img'] = $receiptPhotoPath;

        Reservation::create($resData);
    }

    public function updateReservation(Request $request, StoreImage $storeImage, $id) 
    {
        $reservation = Reservation::findOrFail($id);
        
        $request->validate([
            'payment_percent' => 'required',
            'receipt-img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'receipt-img.required' => 'Upload the receipt image.',
        ]);

        $newReceiptPhotoPath = $storeImage->execute($request, 'receipt-img', 'receipts');

        $receiptImagePaths = $reservation->receipt_img ? explode(',', $reservation->receipt_img) : [];
        $receiptImagePaths[] = $newReceiptPhotoPath;

        // Update reservation with validated data and updated receipt image paths
        $reservation->update([
            'payment_percent' => $request->input('payment_percent'),
            'receipt_img' => implode(',', $receiptImagePaths),
        ]);
    }
}