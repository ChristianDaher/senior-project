<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactRequest as ContactRequestModel;

class ContactRequest extends Mailable
{
    use Queueable, SerializesModels;

    public string $name, $email, $given_subject, $given_message;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactRequestModel $contactRequest)
    {
        $this->name = $contactRequest->name ?? 'Someone';
        $this->email = $contactRequest->email;
        $this->given_subject = $contactRequest->subject;
        $this->given_message = $contactRequest->message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Request',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.contact-request',
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
