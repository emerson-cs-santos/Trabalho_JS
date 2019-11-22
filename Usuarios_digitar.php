<?php
include('PHP' . DIRECTORY_SEPARATOR . 'sessao.php');
$ID = $_GET['ID'];

//$ID = $_POST['ID'];

$acao       = '';

$codigo     = 0;
$usuario    = '';
$senha      = '';
$status     = '';
$email      = '';

if($ID > 0)
{
    $acao='ALTERAR';

    include('PHP'. DIRECTORY_SEPARATOR . 'conexao_bd.php');

    $query = "select * from usuarios where codigo = ?";
    $querytratada = $conn->prepare($query); 
    $querytratada->bind_param("i",$ID);
    $querytratada->execute();
    $result = $querytratada->get_result();

    $row = $result->fetch_assoc();

    $codigo     = $row["codigo"];
    $usuario    = $row["nome"];
    $senha      = $row["senha"];
    $status     = $row["tipo"];
    $email      = $row["email"];
}
else
{
    $acao='INCLUIR';
}

//echo $ID;
?>  

<?php
    include('cabecalho.php');
?>
                    <h1 id='titulo' class="text-center H1_titulo mt-3">Usuários</h1>
                </div> 
            </header>

            <main>
                <section class='row'>

                    <div class='col-12'>

                    <div class='text-center col-12 mt-4'>
                        <h2 class='H2_titulo'> <?php echo $acao; ?> </h2>
                    </div>                      

                        <form>
                            <div class="form-group row Status_Ativo">

                                <div class='col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3'>
                                    <label>Código:</label>
                                    <input value = "<?php echo $codigo; ?>" name='txtCODIGO' type="text" class="form-control" id="usuarios_digitar_codigo" disabled>
                                </div>

                                <div class='col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3'>
                                    <label>Status:</label>
                                    <input value = "<?php echo $status; ?>" name='txtSTATUS' type="text" class="form-control" id="usuarios_digitar_status" disabled>
                                </div>                                
                                
                                <div class='col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3'>
                                    <label>Usuário*</label>
                                    <input value = "<?php echo $usuario; ?>" name='txtDS_LOGIN' type="text" class="form-control" id="usuarios_digitar_login" maxlength="20" placeholder="Login">
                                </div>

                                <div class='col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3'>
                                    <label>E-mail*</label>
                                    <input value="<?php echo $email; ?>" type="email" class="form-control" name="txtDSemail" id="usuarios_digitar_email" maxlength="200" placeholder="nome@server.com.br">
                                </div>                                 

                                <div class='col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3'>
                                    <label>Senha*</label>
                                    <input value = "<?php echo $senha; ?>" name='txtDS_SENHA' type="password" class="form-control" id="usuarios_digitar_senha" maxlength="50"  placeholder="Senha" disabled>
                                </div>

                                <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                                    
                                    <div>
                                        <input id = 'usuarios_digitar_chksenha' type="checkbox" name="chksenha" value="" onchange='senha_habilitar()'> 
                                        <label>Definir/Alterar</label>
                                    </div>

                                    <div>
                                        <input id = 'usuarios_digitar_chkexibirsenha' type="checkbox" name="chkexibirsenha" value="" onchange='senha_exibir()'>                                 
                                        <label>Exibir senha</label>
                                    </div>
                                    
                                    <small class="form-text text-muted font-weight-bold">Senha deve ter no mínimo 6 caracteres</small> 

                                </div>  
                                                             
                            </div>
                            
                            <div class='central_botao'>
                                <!-- Esse botão usa JavaScript para validar e usa a página php 'novo_user' -->
                                <input id='cmd_gravar' type="button" name="cmd_gravar" class="btn btn-primary btn-lg" Value='Gravar'>
                                
                                <span class='espaco_objetos' >.......</span>

                                <!-- Esse botão chama direto a página php que exibe os usuários -->
                                <input id='cmd_voltar' type="button" name="cmd_voltar" class="btn btn-primary btn-lg" Value = 'Voltar'>
                            </div>
                        </form>
                    </div>
                </section>
            </main>

            <script>

                // Adiciona evento de click nos botões
				var botao_gravar = document.getElementById('cmd_gravar');
				botao_gravar.onclick = function(){ novo_cadastro('cadastro') };
				
				var botao_voltar = document.getElementById('cmd_voltar');
				botao_voltar.onclick = function(){ window.open("Usuarios.php", '_self') };				
				
            </script>               

        <?php
            include('footer.php');
        ?>
        </div>
    </body>
</html>