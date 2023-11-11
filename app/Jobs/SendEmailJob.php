<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

// Отправка писем
class SendEmailJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $mail;
    private $receiver;

    public function __construct($mail, $receiver)
    {
        $this->mail = $mail;
        $this->receiver = $receiver;
    }

    public function handle(): void
    {
        Mail::to($this->receiver)->send($this->mail);
    }
}
