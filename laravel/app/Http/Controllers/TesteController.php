<?php

/*echo "<pre>";
print_r(PDO::getAvailableDrivers());*/

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
//use Laravel\Lumen\Routing\Controller as BaseController;

class TesteController extends Controller{
   
              public function listadb()
              {
              	$contato = DB::select('SELECT * FROM contato');
          		return '<h1>Listagem de Contatos com Laravel</h1>';
              }
              
  }

  