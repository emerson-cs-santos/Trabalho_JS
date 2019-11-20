<?php
/* HEADERS DO CORS */ 
header("Access-Control-Allow-Origin: *"); /* nao convem liberar todos os dominios */
header ("Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST");
header ("Access-Control-Allow-Headers: *");

/* obtendo o conteudo do body */
$json =  file_get_contents('php://input');

/* convertendo o body em formato json em objeto php*/
$pessoa = json_decode ($json);

/* devolvendo o atributo nome do objeto pessoa */
echo $pessoa->nome;



?>