<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Mail\Mailables\Address;

class ReservationCompleteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $reservation;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Reservation $reservation)
    {
        $this->user = $user;
        $this->reservation = $reservation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $admin = User::admin();

        return new Envelope(
            subject: 'New Reservation Added',
            from: new Address($admin->mail_email, $admin->name),

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.reservation-complete',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
