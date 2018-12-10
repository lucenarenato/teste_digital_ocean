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

        $dados = DB::table('contato')->get();

        Mail::send(new ExampleCronSend($dados));

        $this->info('E-mail enviado com sucesso ...');

    }
}