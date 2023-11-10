<?php

namespace App\Jobs;

use App\EMailSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Отправка писем
class SendEmailJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $articul;
    private $name;

    public function __construct($articul, $name)
    {
        $this->articul = $articul;
        $this->name = $name;
    }

    public function handle(): void
    {
        // $smtpSrv, $username, $password, $smtpSecure, $port, $emailSender, $emailSenderName
        $eMailSender = new EMailSender(
            env('MAIL_MAILER'),
            env('MAIL_USERNAME'),
            env('MAIL_PASSWORD'),
            env('MAIL_ENCRYPTION'),
            env('MAIL_PORT'),
            env('MAIL_FROM_ADDRESS'),
            env('MAIL_FROM_NAME')
        );

        $title = 'Магазин: новый продукт';
        $message = "
            <body>
                <p>Артикул: <span style='font-weight:bold'>{$this->articul}</span></p>
                <p>Название:<span style='font-weight:bold'>{$this->name}</span></p>
            </body>
        ";
        $eMailSender->send($title, $message, config('products.email'));
    }
}
