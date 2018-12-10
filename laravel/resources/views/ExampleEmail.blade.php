<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		  <style type="text/css">
		   .box{
		    width:600px;
		    margin:0 auto;
		    border:1px solid #ccc;
		   }
		  </style>
        <title>Laravel - Resultados</title>
    </head>
    <body> 
     <br />
  <div class="container">
   <h3 align="center">Teste Email</h3><br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <tr>
      <td>Name</td>
      <td>Telefone</td>
      <td>Email</td>      
     </tr>   
    @foreach($dados as $r)
    <tr>
	    <td>{{ $r->nome }}</td>
	    <td>{{ $r->telefone }}</td>
	    <td>{{ $r->email }}</td></br>
    </tr>
    @endforeach
    </table>
   </div>
   
  </div>
    </body>
</html>