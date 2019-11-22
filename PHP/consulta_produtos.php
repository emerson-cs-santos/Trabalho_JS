<?php
	include('..' . DIRECTORY_SEPARATOR . 'PHP' . DIRECTORY_SEPARATOR . 'sessao.php');

	$filtro = @$_GET['filtro_produto'];

	if (!isset($filtro))
	{
		$filtro = '';
	}
	
	include('..' . DIRECTORY_SEPARATOR . 'PHP' . DIRECTORY_SEPARATOR . 'conexao_bd.php');                      
	
	$query = "select * from produtos $filtro order by codigo desc";
	$result = $conn->query($query);

	$cont = 0;

	// Montando array para enviar como json para o Java Script
	while($row = $result->fetch_assoc()) 
	{	
		$consulta[$cont]['Codigo']		= $row["codigo"];
		$consulta[$cont]['Nome']		= $row["nome"];
		$consulta[$cont]['tipo']		= $row["tipo"];
		$consulta[$cont]['Categoria']	= $row["categoria"];			
		$consulta[$cont]['Preco']		= number_format($row["preco"], 2, ',', '.') ;
		$consulta[$cont]['Estoque']		= number_format($row["estoque"], 0, ',', '.') ;

		$imagem = trim($row["imagem"]);				
		if($imagem == '')
		{
			$imagem     =   'Imagens/produto_sem_imagem.jpg';
		}			
		$consulta[$cont]['Imagem']		= $imagem;

		$cont = $cont + 1;
	}
	
	// Se não tiver registros
	if ( $result->num_rows == 0 )
	{
		$consulta[0]['Sem_Reg'] = 'Sim';
	}
	
	 echo json_encode($consulta);
	 return;
?>