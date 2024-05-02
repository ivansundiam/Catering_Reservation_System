<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Http\Requests\ReservationRequest;
use App\Actions\Uploads\StoreImage;
use App\Events\ReservationComplete;
use App\Models\User;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationService {
    
    public function createReservation(ReservationRequest $request, StoreImage $storeImage) 
    {
        $resData = $request->validated();
        $userId = Auth::id();
        $user = User::findOrFail($userId);
        $rentals = $request->input('rentals');
        $addOns = $request->input('addOns');

        // stores image via StoreImage action
        $receiptPhotoPath = $storeImage->execute($request, 'receipt-img', 'receipts');
        
        // generate transaction number
        $transactionNumber = $this->generateTransactionNumber($userId);

        if($rentals){
            foreach ($rentals as &$addedItem) {            
                // Automatically deduct the quantity of Inventory items used as rental items
                $inventoryItem = Inventory::find($addedItem['id']);
                $newQuantity = $inventoryItem->quantity - $addedItem['quantity'];
                $inventoryItem->update(['quantity' => $newQuantity]);
            
                // Add the inventory item details to the rental item
                $addedItem['item'] = $inventoryItem;
            }
        }

        // Initialize array with the current date/time
        $resData['transaction_number'] = $transactionNumber;
        $resData['payment_dates'] = [now()->toDateTimeString()]; 
        $resData['user_id'] = $userId;
        $resData['receipt_img'] = $receiptPhotoPath;

        if($rentals){
            // convert the rentals data as JSON
            $resData['rentals'] = json_encode($resData['rentals']);
        }
        
        if($addOns){
            // convert the add ons data as JSON
            $resData['add_ons'] = json_encode($addOns);
        }
        
        $reservation = Reservation::create($resData);

        // Event that sends user email of reservation receipt
        event(new ReservationComplete($user, $reservation));
    }

    public function updateReservation(Request $request, StoreImage $storeImage, $id) 
    {
        $reservation = Reservation::findOrFail($id);
        $amountPaid = (float) str_replace(',', '', $request->input('amount_paid'));
     
        $request->validate([
            'payment_percent' => 'required',
            'amount_paid' => 'required|numeric',
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
            'amount_paid' => $amountPaid + $reservation->amount_paid,
            'receipt_img' => implode(',', $receiptImagePaths),
            'payment_dates' => $paymentDates,
        ]);
    }

    public function deleteReservation($id) 
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
    }

    private function generateTransactionNumber($userId) {
        $components = [
            date('YmdHi'),
            str_pad(random_int(0, 99999), 4, '0', STR_PAD_LEFT),    
            str_pad($userId, 4, '0', STR_PAD_LEFT),    
            
        ];

        $transactionNumber = implode('-', $components);

        return $transactionNumber;
    }
}