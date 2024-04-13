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

        // Initialize array with the current date/time
        $resData['payment_dates'] = [now()->toDateTimeString()]; 
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

        // concatenates receipt image paths
        $receiptImagePaths = $reservation->receipt_img ? explode(',', $reservation->receipt_img) : [];
        $receiptImagePaths[] = $newReceiptPhotoPath;

        // Records the date and time of each payment made for the reservation.
        $paymentDates = $reservation->payment_dates ?? [];
        $paymentDates[] = now()->toDateTimeString();

        // Update reservation with validated data and updated receipt image paths
        $reservation->update([
            'payment_percent' => $request->input('payment_percent'),
            'receipt_img' => implode(',', $receiptImagePaths),
            'payment_dates' => $paymentDates,
        ]);
    }
}