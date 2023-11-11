<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewProductMail extends Mailable
{
    use Queueable;
    use SerializesModels;
    private $articul;
    private $name;

    public function __construct($articul, $name)
    {
        $this->articul = $articul;
        $this->name = $name;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Склад: новый товар',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'letter',
            with: [
                'articul' => $this->articul,
                'name' => $this->name,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
