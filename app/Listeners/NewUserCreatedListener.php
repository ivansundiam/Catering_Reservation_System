<?php

namespace App\Listeners;

use App\Mail\NewUserCreatedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class NewUserCreatedListener
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
    public function handle(object $event): void
    {
        Mail::to(User::admin()->email)->send(new NewUserCreatedMail($event->user));

    }
}
