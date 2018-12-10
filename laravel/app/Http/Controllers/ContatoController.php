<?php

   	use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
	use RuntimeException;

    namespace App\Http\Controllers;

  class ContatoController extends Controller {

              public function lista(){
                          return '<h1>Informações para Contato</h1>
                                     <b>Nome:</b> Renato Lucena <br />
                                     <b>Telefone:</b> (xx) xxxxx-xxxx <br />
                                     <b>e-mail:</b> cpdrenato@gmail.com <br />';
              }
              public function teste(){

              	Bugsnag::notifyException(new RuntimeException("Test error"));

              }
              public function contato(){

    			    	return view('contato');
                
    			    }
  }
