<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SampleMail extends Mailable
{
    use Queueable, SerializesModels;
    public array $content;

    /**
     * Create a new message instance.
     */
    public function __construct(array $content) {
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject($this->content)
            ->view('emails.reset-pass');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // return new Envelope(
        //     subject: 'Sample Mail',
        // );
        return new Envelope(
            from: new Address('alfred.andrianjatovo@camtrack.mg', 'Admin CAMTRACK'),
            subject: 'Veuillez réinitialiser votre mot de passe',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reset-pass',
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
