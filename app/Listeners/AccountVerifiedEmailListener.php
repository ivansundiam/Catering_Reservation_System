<?php

namespace App\Listeners;

use App\Events\AccountVerified;
use App\Mail\AccountVerifiedMail;
use Illuminate\Support\Facades\Mail;

class AccountVerifiedEmailListener
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
    public function handle(AccountVerified $event): void
    {
        Mail::to($event->user->email)->send(new AccountVerifiedMail($event->user));
    }
}
