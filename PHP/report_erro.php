<?php

// MODO POST
$report_text = @$_POST['report_text'];

if(!isset($report_text))
{
    $report_text = '';
}

// Campo vazio
if ( $report_text == '' )
{
	echo "erro";
	return;	
}

include('conexao_bd.php');

$codigo = 0;
$resposta = '';

// Prevenção de injection
$query = " INSERT INTO 
				report_erro
				( 
					codigo
					,erro_desc
				) 
			Values
				(
					?
					,?
				)";

$querytratada = $conn->prepare($query); 
$querytratada->bind_param("is",$codigo,$report_text);

$querytratada->execute();

if ($querytratada->affected_rows > 0) 
{
	$resposta = 'ok';
} 
else 
{
	$resposta = 'erro';
}	

// FECHA CONEXAO
mysqli_close($conn);

// RETORNA RESULTADO
echo $resposta;
return;

?>


