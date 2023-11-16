<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// отправка писем о новом товаре
class NewProductMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public string $articul, public string $productName)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: env('APP_NAME').': новый товар',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'letter',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
