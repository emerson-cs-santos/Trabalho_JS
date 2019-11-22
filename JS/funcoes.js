// VALIDA CARACTERES ESPECIAIS
function char_especial(campo) 
{
    var format = /[!@#$%^&*()+\-=\[\]{};':"\\|,.<>\/?]+/;

    if (format.test(campo))
    {
        return(true);
    }

    return(false);
}

// VALIDA SE TEM ESPAÇO
function valida_espaco(campo) 
{
    if (/\s/.test(campo))
    {
        return(true);
    }

    return(false);
}

function preview_image(event) 
{
    var reader = new FileReader();
    reader.onload = 
        function()
        {
            var output = document.getElementById('produtos_digitar_IMG_inputfile');
            output.src = reader.result;
        }
    reader.readAsDataURL(event.target.files[0]);
}

function senha_habilitar() 
{
    var chksenha = document.getElementById('usuarios_digitar_chksenha');
    var txtsenha = document.getElementById('usuarios_digitar_senha');

    // Se marcado para definir/alterar a senha, será desabilitado o checkbox para fazer isso, pois precisamos dele marcado para saber se precisamos passar o MD5 quando estiver alterando o cadastro.
    if (chksenha.checked)
    {
        txtsenha.disabled=false;
        txtsenha.value = '';
        chksenha.disabled=true;
    }
}

function senha_exibir() 
{
    var chkexibirsenha = document.getElementById('usuarios_digitar_chkexibirsenha');
    var txtsenha = document.getElementById('usuarios_digitar_senha');

    if (chkexibirsenha.checked)
    {
        txtsenha.type='text';
    }
    else
    {
        txtsenha.type='password';
    }
}

function validar_email(email)
{
    usuario = email.substring(0, email.indexOf("@"));
    dominio = email.substring(email.indexOf("@")+ 1, email.length);
     
    if ((usuario.length >=1) &&
        (dominio.length >=3) && 
        (usuario.search("@")==-1) && 
        (dominio.search("@")==-1) &&
        (usuario.search(" ")==-1) && 
        (dominio.search(" ")==-1) &&
        (dominio.search(".")!=-1) &&      
        (dominio.indexOf(".") >=1)&& 
        (dominio.lastIndexOf(".") < dominio.length - 1)) 
    {
        return(false);
    }
    else
    {
        return(true);
    }
}


function tabela_render_produtos(parametros)
{
   // AJAX
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function () {
       if (this.readyState == 4 && this.status == 200) 
       
       {
            // Retorno em json do PHP
            var resposta = JSON.parse(this.responseText); 
			
            // Div onde a tabela é removida e criada novamente
            var div_table = document.getElementById('table');

            // Remover tabela atual - Sempre haverá uma tabela como primeiro filho, mesmo que não retorne resultados do php, ao menos a tag TABLE será criada.
            var table_remover = div_table.firstElementChild;
            div_table.removeChild(table_remover);

            // Criar tabela na arvore DOM
            var table = document.createElement('table');
			
			// Sem registros
			var sem_reg	= resposta[0]['Sem_Reg'];
			
			if ( sem_reg == 'Sim' )
			{
				table.innerHTML = 'Não foram encontrados registros...';
				div_table.appendChild(table);
				return false;
			}			
			
            table.id='produtos_table';
            table.classList.add("table");
            table.classList.add("table-hover");
            table.classList.add("table-inverse");
            table.classList.add("table-sm");
            table.classList.add("table-bordered");
            table.classList.add("table_format");

            var thead = document.createElement('thead');
            thead.classList.add('thead-light');

            var tr = document.createElement('tr');
            tr.classList.add('Status_Ativo');

            table.appendChild(thead);
            thead.appendChild(tr);

            // Cria um vetor com os nomes das colunas
            var colunas = resposta[0];

            // Cria as colunas na tabela
            Object.keys(colunas).forEach
                (function(key) 
                    {
                    var valor_coluna = key;

                    // Coluna de Tipo não é exibida na grade
                    if (valor_coluna == 'tipo')
                    {
                        return;
                    }
                        
                    // CRIA COLUNA
                    var thfor = document.createElement('th');   
                    
                    // ADICIONA COLUNA DO GRUPO DA COLUNA
                    tr.appendChild(thfor);        

                    // ALIMENTA LINHA
                    thfor.innerHTML = valor_coluna;
                    }   
                );

            // Adicionando os botões da grade nas colunas

            // Editar/Alterar
            var thfor = document.createElement('th');
            tr.appendChild(thfor);
            thfor.innerHTML = 'Alterar';

            // Preview na loja
            var thfor = document.createElement('th');
            tr.appendChild(thfor);
            thfor.innerHTML = 'Loja';            

            // Desativar / Ativar
            var thfor = document.createElement('th');
            tr.appendChild(thfor);
            thfor.innerHTML = 'Desativar';              

            // Excluir
            var thfor = document.createElement('th');
            tr.appendChild(thfor);
            thfor.innerHTML = 'Excluir';


            // CRIA CORPO DAS LINHAS
            var tbody = document.createElement('tbody');
            // ADICIONA CORPO A TABELA
            table.appendChild(tbody);                

            // Adicionando linhas
            for (var ncount_linha = 0; ncount_linha < Object.keys(resposta).length; ncount_linha ++) 
            {
                
                // CRIA GRUPO DE LINHA
                var trfor = document.createElement('tr');
                var tipo_status = '';

                if ( resposta[ncount_linha]['tipo'] == 'Ativo')
                {
                    tipo_status = 'Status_Ativo';
                }
                else
                {
                    tipo_status = 'Status_Inativo';
                }
                
                trfor.classList.add(tipo_status);

                // ADICIONA GRUPO DA LINHA AO CORPO
                tbody.appendChild(trfor);

                var codigo_para_botao = 0;
                
                // PASSA POR CADA COLUNA DA LINHA ATUAL DO OBJETO
                Object.keys(resposta[ncount_linha]).forEach
                    (function(value) 
                    {
                        // Coluna de Tipo não é exibida na grade
                        if (value == 'tipo')
                        {
                            return;
                        }

                        var valor_linha = resposta[ncount_linha][value];

                        // Código é utilizado nas tags de botões
                        if (value == 'Codigo')
                        {
                            codigo_para_botao = valor_linha;
                        }                        

                        // CRIA LINHA
                        var tdfor = document.createElement('td');

                        // ALIMENTA LINHA

                        if (value == 'Imagem')
                        {
                            var tdimg = document.createElement('img');
                            tdimg.setAttribute("src", valor_linha);
                            tdimg.setAttribute("width", "100");
                            tdimg.setAttribute("height", "100");
                            tdimg.setAttribute("alt", "Preview do produto");
                            tdimg.setAttribute("border", "3");

                            tdfor.appendChild(tdimg);
                        } 
                        else
                        {
                            tdfor.innerHTML = valor_linha;
                        }

                        // ADICIONA LINHA AO GRUPO DE LINHA
                        trfor.appendChild(tdfor);
                    }   
                );  
                
                // Adicionando os botões da grade na linha

                // Editar
                var tdEditar = document.createElement('td');
                tdEditar.classList.add('Status_Ativo');

                var ancoraEditar = document.createElement('a');
                ancoraEditar.type = 'button';
                ancoraEditar.classList.add('btn');
                ancoraEditar.classList.add('btn-primary');
                ancoraEditar.classList.add('fa');
                ancoraEditar.classList.add('fa-pencil');
                ancoraEditar.classList.add('fa-2x');
                ancoraEditar.classList.add('botoes_grade');
                ancoraEditar.setAttribute('data-placement','top');
                ancoraEditar.setAttribute('data-toggle','tooltip');
                ancoraEditar.title='Alterar cadastro do produto';
                ancoraEditar.href= 'Produtos_digitar.php?ID=' + codigo_para_botao;
                tdEditar.appendChild(ancoraEditar);

                trfor.appendChild(tdEditar);


                // Preview na loja
                var tdLoja = document.createElement('td');
                tdLoja.classList.add('Status_Ativo');

                var ancoraLoja = document.createElement('a');
                ancoraLoja.type = 'button';
                ancoraLoja.classList.add('btn');
                ancoraLoja.classList.add('btn-info');
                ancoraLoja.classList.add('fa');
                ancoraLoja.classList.add('fa-shopping-bag');
                ancoraLoja.classList.add('fa-2x');
                ancoraLoja.classList.add('botoes_grade');
                ancoraLoja.setAttribute('data-placement','top');
                ancoraLoja.setAttribute('data-toggle','tooltip');
                ancoraLoja.title='Preview do produto na loja';
                ancoraLoja.href= 'show_produtos.php?ID=' + codigo_para_botao;
                tdLoja.appendChild(ancoraLoja);

                trfor.appendChild(tdLoja);                

                
                // Inativar / Ativar
                var tdInativar = document.createElement('td');
                tdInativar.classList.add('Status_Ativo');

                var ancoraInativar = document.createElement('a');
                ancoraInativar.type = 'button';
                ancoraInativar.classList.add('btn');
                ancoraInativar.classList.add('btn-warning');
                ancoraInativar.classList.add('fa');
                ancoraInativar.classList.add('fa-warning');
                ancoraInativar.classList.add('fa-2x');
                ancoraInativar.classList.add('botoes_grade');
                ancoraInativar.setAttribute('data-placement','top');
                ancoraInativar.setAttribute('data-toggle','tooltip');
                ancoraInativar.title='Desativar produto';
                ancoraInativar.parametro = codigo_para_botao;
                ancoraInativar.addEventListener('click',function(e){
                     desativar_produto(e.currentTarget.parametro);
                })
                
                tdInativar.appendChild(ancoraInativar);

                trfor.appendChild(tdInativar);                

                // Excluir
                var tdExcluir = document.createElement('td');
                tdExcluir.classList.add('Status_Ativo');

                var ancoraExcluir = document.createElement('a');
                ancoraExcluir.type = 'button';
                ancoraExcluir.classList.add('btn');
                ancoraExcluir.classList.add('btn-danger');
                ancoraExcluir.classList.add('fa');
                ancoraExcluir.classList.add('fa-eraser');
                ancoraExcluir.classList.add('fa-2x');
                ancoraExcluir.classList.add('botoes_grade');
                ancoraExcluir.setAttribute('data-placement','top');
                ancoraExcluir.setAttribute('data-toggle','tooltip');
                ancoraExcluir.title='Apagar do produto do sistema';
                ancoraExcluir.parametro = codigo_para_botao;
                ancoraExcluir.addEventListener('click',function(e){
                    deletar_produto(e.currentTarget.parametro);
                })                  
                tdExcluir.appendChild(ancoraExcluir);

                trfor.appendChild(tdExcluir);
            }

            // Adicionando tabela na arvore DOM
            div_table.appendChild(table);
       }
   }

    // MODO GET
    xmlhttp.open("GET", "PHP/consulta_produtos.php?" + parametros,true);
    xmlhttp.send();

}


function report_erro_exibir()
{
    var div_hidden = document.getElementById('report_erro_div');

    if (div_hidden.hidden == true)
    {
        div_hidden.hidden = false;
    }
    else
    {
        div_hidden.hidden = true;
    }    
}

function report_erro()
{

    var report_text = document.getElementById("report_erro_text").value;

    var params = "report_text=" + encodeURIComponent(report_text);

    swal_click = true;

    // AJAX
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var resposta = this.responseText;

            // Tirando ENTER
            resposta = resposta.replace(/(\r\n|\n|\r)/gm, "");

            switch (resposta) {
                case 'ok':
                    swal
                        (
                        {
                            title: "Recebemos seu feedback!",
                            text: "Obrigado por ajudar a melhorar nosso site!",
                            icon: "success",
                            button: "OK",
                        }

                        ).then

                        (
                        (swal_click) => {
                            report_erro_exibir();
                        }
                        );
                    break;

                default:
                    swal(
                        {
                            title: "Problemas ao enviar report!",
                            text: "Por favor entrar em contato com o administrador do sistema!",
                            icon: "error",
                            button: "OK",
                        }
                    )
            }
        }
    }

    // MODO POST
    xmlhttp.open("POST", "PHP/report_erro.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);    
}