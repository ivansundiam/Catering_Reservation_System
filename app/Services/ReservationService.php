<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use App\Actions\Uploads\StoreImage;

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
}