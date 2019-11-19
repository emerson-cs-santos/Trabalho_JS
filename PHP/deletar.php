<?php

$codigo = @$_POST['codigo'];

if(!isset($codigo))
{
    $codigo = 0;
}

include('conexao_bd.php');

// Prevenção de injection
$query = " delete from usuarios WHERE codigo = ? ";

 $querytratada = $conn->prepare($query); 
 $querytratada->bind_param("i",$codigo);

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