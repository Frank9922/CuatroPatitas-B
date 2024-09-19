<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(

        public Model $model,
        public $token,
        public $link = '',
    )
    {

        return $this->link = env('FRONTEND_URL') .'/verifyToken';

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        
        return new Envelope(
            subject: 'Verify Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
       

        return new Content(
            view: 'mails.verifyEmail',
            with:[
                'token' => $this->token,
                'model' => $this->model,
                'link'  => $this->link
            ]
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
