<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Mail\Mailables\Address;

class ReservationReceiptMail extends Mailable
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
            subject: 'Reservation Receipt',
            from: new Address($admin->mail_email, $admin->name),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.reservation-receipt', 
            
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function build(): ReservationReceiptMail
    {
        $reservation = Reservation::with('package', 'menu')->findOrFail($this->reservation->id);

        // Generate PDF
        $data = [
            'title' => 'Reservation Receipt',
            'date' => date('M d, Y'),
            'reservation' => $reservation,
        ];
        $pdf = Pdf::loadView('admin.pdf.receipt-pdf', $data);

        // Attach PDF to email
        return $this
            ->subject('Reservation Receipt Mail')
            ->markdown('mail.reservation-receipt')
            ->attachData($pdf->output(), $reservation->transaction_number . '-receipt.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
