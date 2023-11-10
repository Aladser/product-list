<?php

namespace App\Jobs;

use Aladser\EMailSender;
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

    private $title;
    private $message;
    private $receiver;

    /** Отправка писем
     *
     * @param mixed $title    заголовок письма
     * @param mixed $message  сообщение
     * @param mixed $receiver получатель
     *
     * @return void
     */
    public function __construct($title, $message, $receiver)
    {
        $this->title = $title;
        $this->message = $message;
        $this->receiver = $receiver;
    }

    public function handle(): void
    {
        $eMailSender = new EMailSender(
            env('MAIL_MAILER'),       // smtp сервер
            env('MAIL_USERNAME'),     // учетная запись администратора для почты
            env('MAIL_PASSWORD'),     // пароль учтеки администратора для почты
            env('MAIL_ENCRYPTION'),   // тип шифрования
            env('MAIL_PORT'),         // порт почты
            env('MAIL_FROM_ADDRESS'), // адрес отправителя
            env('MAIL_FROM_NAME')     // имя отправителя
        );

        $eMailSender->send($this->title, $this->message, $this->receiver);
    }
}
