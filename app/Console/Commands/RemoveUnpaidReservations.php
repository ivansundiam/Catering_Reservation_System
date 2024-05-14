<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RemoveUnpaidReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:remove-unpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove reservations that are past the payment due date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reservations = Reservation::all();
        foreach ($reservations as $reservation) {
            // Parse reservation dates
            $reservationDate = Carbon::parse($reservation->date);
            $dateReserved = Carbon::parse($reservation->created_at);
            $today = Carbon::now();
            $nextPaymentDate = '';

            // Calculate the difference in days between the date reserved and the reservation date
            $daysDifference = $dateReserved->diffInDays($reservationDate);

            // Determine next and second payment dates based on days difference
            if ($daysDifference > 30) {
                if($reservation->payment_percent === 20){
                    $nextPaymentDate = $reservationDate->copy()->subMonth();
                } elseif($reservation->payment_percent === 60) {
                    $nextPaymentDate = $reservationDate->copy()->subWeek();
                }
                
                
            } else {
                if($reservation->payment_percent === 20){
                    $nextPaymentDate = $dateReserved->copy()->addDays($daysDifference / 2.6);
                } elseif($reservation->payment_percent === 60) {
                    $nextPaymentDate = $dateReserved->copy()->addDays($daysDifference / 1.2);
                }
            }

            // Check if reservation is past the payment due date
            if ($nextPaymentDate && $nextPaymentDate < $today) {

                $reservation->delete();
                Log::info('Reservation ID ' . $reservation->id . ' has been removed due to missing payment.');
                $this->info('Reservation ID ' . $reservation->id . ' has been removed due to missing payment.');
            }

        }
        
        $this->info('Expired reservations have been removed successfully.');
    }
}
