<?php

namespace App\Mail;

use App\Enums\TokenType;
use App\Models\Token;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TokenMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $tokenSubject;
    protected $amount;

    /**
     * Create a new message instance.
     */
    public function __construct(protected Token $token)
    {
        if($this->token->type == TokenType::withdrawal->name) {
            $this->tokenSubject = 'Withdrawal Token';
        }

        $withdrawal = $this->token->tokenable;
        $this->amount = $withdrawal->amount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->tokenSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mails.token',
            with: [
                'token' => $this->token,
                'amount' => $this->amount
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
