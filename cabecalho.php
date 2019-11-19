<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Gamer Shopping</title>
    <meta charset="utf-8"> 

    <link href="Imagens/icon.png" rel="icon">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Manual de uso referente aos alerts customizados "swal": https://sweetalert.js.org/guides/ -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<!-- JQUERY -->
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script> 

    <!-- Form Modal do Login -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>   
    
    <!-- Utilizado para formatar valores decimais -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- Biblioteca de ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    

    <!-- CSS -->
    <link rel="stylesheet" href="css/Login.css">
    <link rel="stylesheet" href="css/Geral.css">  
    <link rel="stylesheet" href="css/imagens.css">  

    <!-- JavaScript -->
    <script src="JS/login.js"></script>
    <script src="JS/funcoes.js"></script>    
    <script src="JS/produtos.js"></script>  
    <script src="JS/deletar_ou_ativar.js"></script>
    <script src="JS/filtrar.js"></script>
    <script src="JS/reset_email.js"></script>
</head>

<body>
    <div class='container'>
        <header class='row'>
            <div class="col-12">
                <nav id='navbar' class='navbar navbar-expand-lg navbar-light row'>

                    <a class="nav_link col-2" href='Index.php'><img src='Imagens/controle.png' alt='Logo do site' style='height:100px; width:100px;'></a>
                    
                    <a class='navbar-brand p-4 col-3' href='Index.php' style='font-size: 25px;'>Home</a>

                    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                        <span class='navbar-toggler-icon'></span>
                    </button>

                    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                        <ul class='nav nav-pills'> 

                            <li class='nav-item'>
                                <a class='nav-link' href='Jogos.php'>Jogos</a>
                            </li>    

                            <?php

                                if (isset($_SESSION['controle']))
                                {
                                    $user = $_SESSION['controle'];
                                    echo "
                                        <li class='nav-item'>
                                                <a class='nav-link' href='PHP" . DIRECTORY_SEPARATOR . "sair.php'>Bem vindo! $user - Sair </a>
                                        </li>";
                                }
                                else
                                {
                                    echo "
                                    <li class='nav-item'>
                                        <a class='nav-link' href='Login.php'>Bem vindo!           Entre ou se cadastre-se</a>
                                    </li> ";
                                }

                            ?>

                            <li class='nav-item'>
                                <a class='nav-link' href='Painel.php'>Painel</a>
                            </li>           
                        </ul>
                    </div>
                </nav>
