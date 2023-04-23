<?php

namespace App\Mail;

use App\Models\Candidature;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidatureResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public Candidature $candidature;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Candidature $candidature)
    {
        $this->candidature = $candidature;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: $this->candidature->job->company->user->email,
            to: $this->candidature->candidate->user->email,
            subject: 'Candidature Received :)',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'Mail/CandidatureResponseMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
