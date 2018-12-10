<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExampleCronSend extends Mailable
{
    use Queueable, SerializesModels;

    private $dados;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->view('ExampleEmail')
                    ->to('cpdrenato@gmail.com')
                    ->with(['dados' => $this->dados]);
    }
}
// exemplo deste siste: https://pt.stackoverflow.com/questions/249448/como-configurar-envio-de-email-no-laravel-dentro-do-cron?rq=1