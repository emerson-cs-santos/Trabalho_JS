<?php
    include('PHP/sessao.php');
    include('cabecalho.php');
?>
                    <h1 class="text-center H1_titulo mt-3">Produtos</h1>
                </div> 
            </header>

            <main>
                <section class='row'>

                    <div class='text-center col-12 mt-4'>
                        <h2 class='H2_titulo'> Controle e Listagem </h2>
                    </div>

                    <!-- Botões principais -->
                    <form action='Produtos_digitar.php?ID=0' method='POST' class='form-group row mt-3 col-12 d-flex justify-content-center'>
                        <button type="submit" id='botao_incluir_produto' class="btn btn-success fa fa-pencil-square-o botao_incluir" data-placement="top" data-toggle="tooltip" title="Adicionar novo produto"> Incluir</button>
                    </form>

                    <!-- Filtros -->
                    <div class='form-group row col-12 Status_Ativo'>
                        <span class='font-weight-bold'>Filtros:</span>
                    </div>    

                    <!-- Filtro por Código -->
                    <div class='form-group row mt-1 col-12 Status_Ativo'>
                        <span class=''>ID:</span>
                        <span class='espaco_objetos' >................</span>
                        <input type="number" min="1" max="999999" id='produtos_filtro_codigo' class="form-control col-2" oninput='filtrar_produto()'>
                    </div>  

                    <!-- Filtro pelo Produto -->
                    <div class='form-group row mt-1 col-12 Status_Ativo'>
                        <span class=''>Produto:</span>
                        <span class='espaco_objetos' >....</span>
                        <input type="text" id='produtos_filtro_nome' class="form-control col-4" oninput='filtrar_produto()'>
                    </div>  

                    <!-- Filtro pela Categoria -->
                    <div class='form-group row mt-1 col-12 Status_Ativo'>
                        <span class=''>Categoria:</span>
                        <span class='espaco_objetos' >.</span>
                        <input type="text" id='produtos_filtro_categoria' class="form-control col-4" oninput='filtrar_produto()'>
                    </div>                                                

                    <!-- Filtro de Status -->
                    <div class='form-group row mt-1 col-12 Status_Ativo'>
                        <span>Status:</span>
                        <span class='espaco_objetos' >.........</span>

                        <select id='produtos_filtro_status' onchange='filtrar_produto()'>
                            <option value="Todos">Todos</option>
                            <option value="Ativos">Ativos</option>
                            <option value="Inativos">Inativos</option>
                        </select>
                    </div>                 

                    <div id='table' class='container mt-3'> </div>
                </section>  
            </main>

            <script>

                // AJAX
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        
                        var resposta = this.responseText;

                        var table = document.getElementById("table");
                        table.innerHTML = resposta;                        
                    }
                }

                // MODO GET
                xmlhttp.open("GET", "PHP/consulta_produtos_enviando_html.php",true);
                xmlhttp.send();                

            </script>

            <?php
                include('footer.php');
            ?>

        </div>
    </body>
</html>

