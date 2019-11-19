<?php

$codigo = @$_POST['codigo'];

if(!isset($codigo))
{
    $codigo = 0;
}

include('conexao_bd.php');

// Deletar imagem
$query			=	"select imagem from produtos where codigo = ?";
$querytratada	=	$conn->prepare($query); 
$querytratada	->	bind_param("i",$codigo);
$querytratada	->	execute();
$result			=	$querytratada->get_result();

$row			= $result->fetch_assoc();
$imagem			= '../' . $row["imagem"];
@unlink($imagem);

// Deletar registro
$query = " delete from produtos WHERE codigo = ? ";

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