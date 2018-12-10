12/09/2018
Como configurar envio de email no Laravel dentro do cron?

 1
votar contra
favorita

Apos a criação do cron(código abaixo) é feito uma varredura no banco atras de dados alterados. Tenho de enviar um e-mail com estes dados. Como posso fazer isso ???

Codigo do cron:

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class envioEmailBIcron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'envioEmailBI:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       //Pegar os dados no banco
        $sql = ' select * from payments as P, receipts as R ';
        $sql .= ' where P.created_at < CURRENT_DATE AND P.updated_at < CURRENT_DATE ';
        $sql .= ' AND R.created_at < CURRENT_DATE AND R.updated_at < CURRENT_DATE';

        //pega os dados no banco
        $query = \DB::select($sql);

       // executando as funções de envio de e-mail
       $this->info('Example Cron comando rodando com êxito');
    }
}

***********************



Para criar um e-mail com dados vindo do banco de dados ou qualquer fonte que alimente, faça o seguinte:

Digite na linha de comando:

php artisan make:mail ExampleCronSend

isso criará uma classe de configuração de e-mail com esse layout:

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

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function build()
    {
        return $this->view('ExampleEmail')
                    ->to('email@recebe.com')
                    ->with(['dados' => $this->dados]);
    }
}

agora vai configurar uma pagina para o layout desse e-mail, um exemplo simples, crie dentro da pasta resources/views um pagina com o nome de ExampleEmail.blade.php:

<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel - Resultados</title>
    </head>
    <body>    
    @foreach($dados as $r)
        <p>{{$r->description}}</p>
    @endforeach
    </body>
</html>

isso fornece um layout agradável que ainda pode ser melhorado.

Volte ao arquivo de Command e adicione essa chamada

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Mail\ExampleCronSend;

class ExampleCron extends Command
{

    protected $signature = 'example:cron';
    protected $description = 'Example Cron Minutes';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {

        $dados = DB::table('example')->get();

        Mail::send(new ExampleCronSend($dados));

        $this->info('E-mail enviado com sucesso ...');

    }
}

para testar digite:

php artisan example:cron

e se o processo tiver Ok recebe a seguinte mensagem:

    inserir a descrição da imagem aqui

compartilharmelhorar esta resposta
