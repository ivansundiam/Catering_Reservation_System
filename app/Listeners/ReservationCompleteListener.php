<?php

namespace App\Listeners;

use App\Events\ReservationComplete;
use App\Mail\ReservationReceiptMail;
use App\Mail\ReservationCompleteMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ReservationCompleteListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ReservationComplete $event): void
    {
        Mail::to($event->user->email)->send(new ReservationReceiptMail($event->user, $event->reservation));
        Mail::to(User::admin()->email)->send(new ReservationCompleteMail($event->user, $event->reservation));
    }
}
