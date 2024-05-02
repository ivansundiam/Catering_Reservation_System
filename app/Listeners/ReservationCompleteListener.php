<?php

namespace App\Listeners;

use App\Events\ReservationComplete;
use App\Mail\ReservationReceiptMail;
use App\Mail\ReservationCompleteMail;
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
