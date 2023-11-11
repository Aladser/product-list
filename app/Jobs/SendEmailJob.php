<?php

namespace App\Jobs;

use App\Mail\NewProductMail;
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

    private $articul;
    private $name;

    /** Отправка писем
     *
     * @return void
     */
    public function __construct($articul, $name)
    {
        $this->articul = $articul;
        $this->name = $name;
    }

    public function handle(): void
    {
        Mail::to(config('products.email'))->send(new NewProductMail($this->articul, $this->name));
    }
}
