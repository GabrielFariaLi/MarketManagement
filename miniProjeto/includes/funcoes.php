<?php
    ob_start();
    header("Content-Type: text/html; charset=ISO-8859-1",true);
    include ("conexao.php");
?>

<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/76b3b4460b.js" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

  <link rel="stylesheet" href="includes/css/styleRegistrar.css">
  <link rel="stylesheet" href="includes/css/style.css">
  <link rel="icon" href="includes/imgs/icon_pag.png">

<?php
/*=========LISTA DE FUNÇÕES==========*/
/*)FUNÇÃO QUE MOSTRA PAGINA DE LOGIN DO SISTEMA - OK*/
function show_index(){ ?> 
        <div class="login-form">
        
        <img src="includes/imgs/icon_form3.png">
            <h1>Efetuar Login</h1>
        <?php
            if (isset($_GET["registrar"])){
                if ($_GET["registrar"] == "sucesso"){
                echo '<p class="sucesso_registrar">O cadastro foi realizado com sucesso!</p>';
                }
            }

            if (isset($_GET["novasenha"])){
                if ($_GET["novasenha"] == "senhaatualizada"){
                echo '<p class="sucesso_registrar">A senha foi atualizada com sucesso!</p>';
                }
            }

            if (isset($_GET['error'])){
                if($_GET['error'] == "camposvazios"){
                    echo '<p class="error_registrar">Preencha todos os campos!</p>';
                }
                else if ($_GET['error'] == "palavrapasse_incorreta"){
                    echo '<p class="error_registrar">Palavra passe incorreta!</p>';
                }
                else if ($_GET['error'] == "palavrapasse_invalida"){
                    echo '<p class="error_registrar">Palavra passe inválida!</p>';
                }
                else if ($_GET['error'] == "usuario_inexistente"){
                    echo '<p class="error_registrar">Username não está cadastrado!</p>';
                }
            }
            else if (isset($_GET["login"])){
                if ($_GET["login"] == "sucesso"){
                echo '<p class="sucesso_registrar">O login foi realizado com sucesso!</p>';
                }
            }
        ?>
            <hr>
        <br>
        <form class="formulario_logar" action="includes/login.inc.php" method="POST">
        
        <input type="text" class="caixa-input" name="email_id" placeholder="Introduza seu email ou username">
        <input type="password" class="caixa-input" name="senha_id" placeholder="Introduza Palavra passe">
        
        <button type="submit" class="loginbtn_index" name="login-enviar">Login</button>
        <a href="redefinirSenha.php">Esqueceu sua senha?</a>
        <hr>
        <p class="or">OU</p>
        <p>Você ainda não possui uma conta? <a href="registrar.php">Registrar agora</a></p>
        </form>
        </div>
<?php } ?>

<?php
/*)FUNÇÃO QUE MOSTRA O NUMERO DE SECÇÕE, ENCOMENDAS E FORNECEDORES ARMAZENADOS NA BASE DE DADOS  - OK*/
    $sql = "SELECT count(tipo) as n_seccoes FROM seccao";
    $resultado = mysqli_query($ligacao,$sql);
    $registo=mysqli_fetch_assoc($resultado);
    if($registo){
        $n_seccoes=$registo['n_seccoes'];
    }

    $sql = "SELECT COUNT(encomenda.ID_encomenda) as n_encomendas FROM encomenda";
    $resultado = mysqli_query($ligacao,$sql);
    $registo=mysqli_fetch_assoc($resultado);
    if($registo){
        if($n_seccoes < $registo['n_encomendas']){
            $n_seccoes=$registo['n_encomendas'];
        }
    }
    
    $sql = "SELECT count(id_fornecedor) as n_fornecedor FROM fornecedor;";
    $resultado = mysqli_query($ligacao,$sql);
    $registo=mysqli_fetch_assoc($resultado);
    if($registo){
        $n_fornecedor=$registo['n_fornecedor'];
    }
?>



<?php
/*1)FUNÇÃO QUE MOSTRA NAVEGADOR DA P?GINA home.php - OK*/
function show_nav_home(){ ?>
                    <?php if(isset($_SESSION['permissao'])){ 
                            if($_SESSION['permissao'] == "Administrador"){?>
                    <a class="permissoesbtn" href="gerirPermissoes.php" >Gerir permissões</a>
                    <?php } } ?>
                <div class="market_management">
                    <h1 class="market_management">Market Management</h1>
                </div>
                <div class="formulario_login_div">

                    <?php

                        if(isset($_SESSION['utilizador_ID'])){

                            echo '<form action="includes/logout.inc.php" method="post">

                                <button class="btnlogout" type="submit" name="btnlogout">Logout</button>

                                </form>';
                        }
                        else{
                            echo '';
                        } ?>
                </div>
                <div class="hamburger">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
<?php }?>

<?php
/*1)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA gerirPermissoes.php - OK*/
function show_nav_gerir_permissao(){ ?>
    
            <a style="margin-right:1600px" title="Voltar a pagina principal" id="home.inc" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
<?php }?>

<?php
/*1)FUNÇÃO QUE MOSTRA TABELA DE UTILIZADORES - OK*/
function show_list_utilizador(){ ?>
    <table class = "conteudo_tabela">
            <thead>
                <tr>
                    <td>Username</td>
                    <td>email</td>
                    <td>permissao</td>
                    <td>Redefinir</td>
                    <td></td>
                    
                </tr>
            </thead>
            <tbody>
            <br>
            <h1 align = 'center'>Utilizadores</h1>

            <?php
                    if(isset( $_SESSION['msg'])){       //Comando que checa se a variavel universal "msg" possui algum valor.
                        echo  $_SESSION['msg'];         //Se a variavel estiver com algum valor, imprimi na tela o mesmo.
                        unset( $_SESSION['msg']);       //limpa a variavel msg para mensagens posteriores
                    }
                ?>

            <?php
            
            include("includes/sistema_login_bd.php");
            $sql = "SELECT * FROM utilizador";
            $resultado = $ligacao->query($sql) or die($ligacao->error);
            while($linha = $resultado->fetch_array()){
                $username = $linha['ID_username'];
                $email = $linha['email_utilizador'];
                $permissao = $linha['permissao'];
                ?>
                
                <?php if($_SESSION['utilizador_ID'] != $linha['ID_utilizador']){ ?>
                <tr>
                <td><?php  echo $username;?></td>
                <td><?php  echo $email;?></td>
                   
                <td>
                    <?php  echo $permissao; ?>

                </td>
                <td>
                    <form method="post" action="includes/gerirPermissao.inc.php">
                        <input type="hidden" id="utilizadorid" name="utilizadorid" value="<?php echo $linha['ID_utilizador']; ?>">

                    
                        <select class="select_css"  name ="tipos_permissao_form" class="dropdown_registrar" required>
                            <option value="Administrador">Administrador</option>
                            <option value="Gerente">Gerente</option>
                            <option value="Gestor de estoque">Gestor de estoque</option>
                            <option value="Visitante">Visitante</option>
                        </select>
                

                </td>                <td><button class="btnlogout" type="submit">Redefinir</button></td>
                    </form>

                
                </tr>
            <?php } 
            }?>
            </tbody>

         </table>
    

<?php }?>


<?php
/*1.1)FUNÇÃAO QUE MOSTRA TABELA CATALOGO DE PRODUTOS - ok*/
function show_card_menu(){ ?>

    <div class="container">
        <div class="card">
            <div class="face face1">
                <div class="conteudo">
                    <img class="card_menu" src="includes/imgs/imagem_Seccoes.png">
                    <h3>Secções</h3>
                </div>
            </div>
            <div class="face face2">
                <div class="conteudo">
                    <p class="Conteudo_seccoes">
                    Aréa de listagem de todas as secções
                    do hipermercado,capacidade de editar,
                    adicionar e excluir as mesmas
                    ou deslocar um produto de uma
                    secção a outra.
                    </p>
                    <a href="listarseccao.php">Listar As Secções</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="face face1">
                <div class="conteudo">
                    <img class="card_menu" src="includes/imgs/icon_estoque.png">
                    <h3>"Estoque"</h3>
                </div>
            </div>
            <div class="face face2">
                <div class="conteudo">
                    <p class="Conteudo_seccoes">
                    Área de prova concreta que sabemos como copiar e colar uma div obrigado professor S2
                    </p>
                    <a href="listarseccao.php">Listar Os Estoques</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="face face1">
                <div class="conteudo">
                    <img class="card_menu" src="includes/imgs/imagem_Encomendas.png">
                    <h3>Encomendas</h3>
                </div>
            </div>
            <div class="face face2">
                <div class="conteudo">
                    <p class="Conteudo_encomendas">
                    Aréa de listagem de todas as encomendas
                    e fornecedores do hipermercado,capacidade de
                    excluir ou editar os mesmos.
                    </p>
                    <a href="listarEncomenda.php">Listar As Encomendas</a>
                    <a href="listarFornecedor.php">Listar Os Fornecedores</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="face face1">
                <div class="conteudo">
                    <img class="card_menu" src="includes/imgs/imagem_Produtos.png">
                    <h3>Produtos</h3>
                </div>
            </div>
            <div class="face face2">
                <div class="conteudo">
                    <p class="Conteudo_produtos">
                    Aréa de listagem de todos os produtos
                    do hipermercado,capacidade de
                    excluir, adicionar ou editar os mesmos.
                    </p>
                    <a href="catalogo.php">Catálogo dos Produtos</a>
                </div>
            </div>
        </div>

        <?php if(isset($_SESSION['permissao'])){ 
                if ($_SESSION['permissao'] == "Gerente" or $_SESSION['permissao'] == "Administrador") { ?>
        <div class="card">
            <div class="face face1">
                <div class="conteudo">
                    <img class="card_menu" src="includes/imgs/imagem_Compras.png">
                    <h3>Compras</h3>
                </div>
            </div>
            <div class="face face2">
                <div class="conteudo">
                    <p class="Conteudo_compras">
                    Aréa de listagem de todas as compras
                    efetuadas pelo hipermercado, com a sua respectiva
                    fatura
                    </p>
                    <a href="listarCompra.php">Listar As Compras</a>
                    <a href="listarDevolucao.php">Listar As Devoluções</a>
                </div>
            </div>
        </div>
        <?php   } 
              } ?>
    </div>
<?php } ?>
<?php

/*1.2)FUNÇÃO QUE MOSTRA TABELA CATALOGO DE PRODUTOS - ok*/
function show_marketmanagement_card($nome_usuario){ ?>
    <figure class="bemvindo_card">
  <img class="market_management_card" src="includes/imgs/homepageIMG.jpg" alt="sample72"/>
  <figcaption>
    <br><br><br><br>
    <h3>Bem vindo(a) <br> <?php echo $nome_usuario; ?></h3>
    <p>
    Em caso de dúvida contacte algum administrador
    <br>
    gabriel@hotmail.com
    <br>
    fernandin@gmail.com
    </p>
  </figcaption>
  <a href="#"></a>
    </figure>

<?php } ?>

<?php
/*2)FUNÇÃO QUE MOSTRA TABELA CATALOGO DE PRODUTOS - ok*/
function show_list_catalog(){ ?>
    <table class = "conteudo_tabela">
            <thead>
                <tr>
                    <td>Código de Barras</td>
                    <td>Produto</td>
                    <td>Preço pelo peso</td>
                    <td>Peso Produto</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>
            <br>
            <h1 align = 'center'>Catálogo</h1>

            <?php
                    if(isset( $_SESSION['msg'])){       //Comando que checa se a variavel universal "msg" possui algum valor.
                        echo  $_SESSION['msg'];         //Se a variavel estiver com algum valor, imprimi na tela o mesmo.
                        unset( $_SESSION['msg']);       //limpa a variavel msg para mensagens posteriores
                    }
                ?>

            <?php
            include("includes/conexao.php");
            $sql = "SELECT * FROM produto";
            $resultado = $ligacao->query($sql) or die($ligacao->error);
            while($linha = $resultado->fetch_array()){
                $cod_barra = $linha['cod_barra'];
                $descricao = $linha['descricao'];
                $preco = $linha['preco_unitario'];
                $peso = $linha['peso'];
                $unidade_medida = $linha['unidade_medida_produto'];
                ?>
            
                <tr>
                <td><?php  echo $cod_barra;?></td>
                <td><div <?php if($_SESSION['permissao'] == "Administrador" or $_SESSION['permissao'] == "Gerente"){ ?>
                                contenteditable="true"
                                onBlur="updateValor(this,'descricao','<?php echo $cod_barra; ?>')" 
                                onClick="ativar(this)"
                        <?php } ?>
                         ><?php  echo $descricao;?></td></div>
                <td>
                    <div <?php if($_SESSION['permissao'] == "Administrador" or $_SESSION['permissao'] == "Gerente"){ ?>
                                contenteditable="true"
                                onBlur="updateValor(this,'preco_unitario','<?php echo $cod_barra; ?>')" 
                                onClick="ativar(this)"
                        <?php } ?> >
                        <?php  echo $preco;?> 
                        
                    </div>
                    <i class="fas fa-euro-sign fa-xs"></i>

                </td>
                   
                <td><div <?php if($_SESSION['permissao'] == "Administrador" or $_SESSION['permissao'] == "Gerente"){ ?>
                                contenteditable="true"
                                onBlur="updateValor(this,'peso','<?php echo $cod_barra; ?>')" 
                                onClick="ativar(this)"
                        <?php } ?> >
                    <?php  echo $peso;?>
                    </div>
                    <div <?php if($_SESSION['permissao'] == "Administrador" or $_SESSION['permissao'] == "Gerente"){ ?>
                                contenteditable="true"
                                onBlur="updateValor(this,'unidade_medida_produto','<?php echo $cod_barra; ?>')" 
                                onClick="ativar(this)"
                        <?php } ?> >
                    <?php echo $unidade_medida;?>
                    </div>
                    
                </td>

                
                
                <td>
                        <!--Coluna "Ação"  atribuidas com um link que as leva para outros ficheiros para processar a devida função.
                        Evidenciando que cada link passa o valor da coluna que vai ser editada ou apagada-->
                        
                        <a title = "Apagar produto" onclick= "conf_apag_id_unico(<?php echo $cod_barra; ?>)" class="acoes">
                        <i  class="far fa-trash-alt"></i>
                        </a>
                </td>
                </tr>
            <?php }?>
            </tbody>

         </table>
<?php }?>

<?php
/*2.1)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA catalogo - ok*/
function show_nav_catalog(){ ?>
    <div class="links_inc">
    <a title="Voltar a pagina principal" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
            <a title="cadastrar novo produto" class="home" href="CadastrarProduto.php">
                <i class="fas fa-folder-plus"></i>
            </a>
    </div>

                <div class="logo">
                    <h4>Navegador</h4>

                </div>

                <div class="pesquisar_catalogo">
                    <div class="procurar-box">
                        <form method="POST" action="ProcurarProduto.php">
                            <input type="hidden" name="procurarcatalogo" value="1">
                            <input class="procurar-txt" type="text" name="procurar" placeholder="Digite para pesquisar por um nome/código..."> 
                            <button class="procurar-btn">
                            <i class="fas fa-search fa-lg"></i>
                            </button>
                            </form>
                    </div>
                </div>

                
                <ul class="link_nave">


                    <li><a class="li_primario">Secção</a>
                        <ul class="sublink_nave">
                            <li><a href="listarSeccao.php">Listar</a></li>
                        </ul>
                    </li>

                    <li><a class="li_primario">Encomendas</a>
                        <ul class="sublink_nave">
                            <li><a href="listarEncomenda.php">Listar</a></li>
                            <li><a href="listarFornecedor.php">Fornecedor</a></li>
                        </ul>
                    </li>

                    <?php if(isset($_SESSION['permissao'])){ 
                            if ($_SESSION['permissao'] == "Gerente" or $_SESSION['permissao'] == "Administrador") { ?>

                    <li><a class="li_primario">Compras</a>
                        <ul class="sublink_nave">
                            <li><a href="listarCompra.php">Listar</a></li>
                            <li><a href="listarDevolucao.php">Devoluções</a></li>
                        </ul>
                    </li>

                    <?php   } 
                          } ?>       
                </ul>
<?php } ?>

<?php
/*2.2)FUNÇÃO QUE CADASTRA PRODUTO- ok*/
function show_cadastrar_produto($cod_barra_atual){ ?>
    <main>
    <div class="wrapper-main">
    
    <section class="seccao_form">


        <img class="produto_cadastrar_img" src="includes/imgs/imagem_produtos_cadastrar.png">

        <h1>Cadastrar Produto</h1>

        


        <hr class="linha_registrar">
            <?php
                    if(isset( $_SESSION['msg'])){       //Comando que checa se a variavel universal "msg" possui algum valor.
                        echo  $_SESSION['msg'];         //Se a variavel estiver com algum valor, imprimi na tela o mesmo.
                        unset( $_SESSION['msg']);       //limpa a variavel msg para mensagens posteriores
                    }
            ?>
        <br>

        <form class="formulario_inserir" action="includes/cadastrarProduto.inc.php" method="post">

            <label class="titulo_texts" >Nome do novo produto:  <span title="Nome do produto que deseja cadastrar no mercado.">*</span></label>

            <input class="caixa_input" type="text"  placeholder="Ex: Laranja" name="nome_produto">
            <br>
            <br>

            <label class="titulo_texts" >Preço do novo produto:  <span title="O preço do produto é constituído por 3 partes ">*</span></label>
            <br>
            
            <div class="Peso_preco_cadastrar">
            <br>
                <div class="titulo_texts_group">
                    <p>Preço do produto em euros: (relação com o peso) <span title="O preço pelo peso fornecido abaixo">*</span></p>
                </div>

            <input class="caixa_input_group" type="number" min="0" step="0.01" id="Preco"     placeholder="Ex 2.70" name="preco_produto">
            <br>
            <br>

            <label class="titulo_texts_group" >Peso do produto: (relação com o preço)  <span title="Peso do produto que será vendido pelo preço acima">*</span></label>

            <input class="caixa_input_group" type="number" step="0.01" min="0" placeholder="Ex: 300" name="peso_produto">
            <br>
            <br>

            <label class="titulo_texts_group" >Unidade de medida:  <span title="Unidade de medida do peso acima. Preferencia por abreviações">*</span></label>

            <input class="caixa_input_group" type="text" maxlength="8"  placeholder="Ex: unidades,Kg,Gr,Ml" name="unidade_medida_produto">
            <br>
            </div>            
            <div class="titulo_texts">Código de barra do produto a ser registrado: <?php echo $cod_barra_atual; ?></div>
            <br>



            <!--Check box se for necessario impletação posteriormente:
                <input type="checkbox" name="confirma_chegada" id="confirmar_chegada_valor" checked required> 
            <label class="confirma_text"for="confirmar_chegada_valor">Quero continuar com a deslocação.</label><br><br>-->

            <input type="hidden" id="seccaotipo" name="seccaotipo" value="">

            <button class="btnregistrar_chegada" type="submit" name="registrar_enviar">Registrar</button>


        </form>

    </section>

    </div>

</main>
<?php }?>

<?php
/*2.3)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA cadastrar_produto.php -  OK*/
function show_nav_cadastrar_produto(){ ?>
            <a title="Retornar ao catálogo" class="home" href="catalogo.php">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            
            <a title="Voltar a pagina principal" id="home.inc" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
<?php }?>

<?php
/*2.4)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA cadastrar_produto.php -  OK*/
function show_list_procurar_produto_catalogo($pesquisar){ ?>
            <thead>
                <tr>
                    <td>Cod_barra</td>
                    <td>Produto</td>
                    <td>Preço pelo peso</td>
                    <td>Peso Produto</td>
                    
                </tr>
            </thead>
            <tbody>
            <br>
            <h1 align = 'center'>Resultados para '<?php echo $pesquisar; ?>'</h1>
            <?php
            include("includes/conexao.php");
            $sql = "SELECT * 
            FROM produto
            WHERE descricao LIKE '%$pesquisar%' or cod_barra = '$pesquisar'";
            $resultado = $ligacao->query($sql) or die($ligacao->error);
            while($linha = $resultado->fetch_array()){ ?>
            
                <tr>
                <td><?php  echo $linha['cod_barra'];?></td>
                <td><?php  echo $linha['descricao'];?></td>
                <td><?php  echo $linha['preco_unitario'];?>
                <i class="fas fa-euro-sign fa-xs"></i>
                </td>
                <td><?php  echo $linha['peso'];
                           echo $linha['unidade_medida_produto'];?></td>
                </tr>
            <?php }?>
            </tbody>
<?php }?>


<?php
/*3) FUNÇÃO QUE MOSTRA A LISTA DE SECÇÕES*/
function  show_list_Seccao($id) { ?>
    <thead> 
      
        <tr>
            <td><b>Produto</b></td>
            <td><b>Secção</b></td>
            <td><b>Prateleira</b></td>
            <td><b>Quantidade na Secção</b></td>
            <td><b>Quantidade Total</b></td>
            <td><b>Data armazenado</b></td>
            <td><b>Ações</b></td>              
        </tr>
    </thead> 

            <tbody>
                    
                <tr>

                <?php
                include("includes/conexao.php");

                $sql ="SELECT cod_barra, descricao,tipo, quantidade_deslocacao, quantidade_total, prateleira, data_deslocacao,id_seccao,produto.unidade_medida_produto
                FROM produto
                INNER JOIN deslocacao
                on deslocacao.produto_fk = produto.cod_barra
                INNER JOIN seccao
                on deslocacao.seccao_fk = seccao.ID_seccao
                where tipo = '$id'
                ";            //comando em SQL utilizado para listagem das colunas
                $resultado = $ligacao->query($sql) or die($ligacao->error); // coloca na variavel "resultado" a query da variavel ligação

                 while($linha = $resultado->fetch_array()){ 
                    $id = $linha['cod_barra']; 
                    $id_seccao = $linha['id_seccao']; 
                    $quantidade_atual = $linha['quantidade_deslocacao']; /*é atribuido a variavel linha o valor da ligacao ao query*/
                    if($linha['quantidade_deslocacao']){?>     
                    
                    <td><?php echo $linha["descricao"];?></td>  <!--Imprime o valor de linha na tabela--> 
                    <td><?php echo $linha["tipo"];?></td>
                    <td >
                        <?php echo $linha["prateleira"];?>
                        <a title = "Mover para prateleira." onclick="desloca_prateleira('<?php echo $id; ?>' , '<?php echo $id_seccao; ?>')" class="acoes"><i  class="far fa-edit"  ></i></a>

                    </td>
                    
                    <td>
                        <?php       echo $linha["quantidade_deslocacao"]; ?>
                        
                        <?php       echo $linha['unidade_medida_produto'];?>
                    </td>
                    <?php if ($linha['quantidade_total'] <= 100){ ?>
                                <td style="color:red;">
                        <?php }else if($linha['quantidade_total'] <= 1000){ ?>
                                <td style="color:yellow;">
                        <?php    }else{ ?>
                            <td>
                        <?php     } ?> 
                        <?php echo $linha["quantidade_total"];
                              echo $linha['unidade_medida_produto'];?></td>
                    <td><?php echo date("d/m/Y h:i:s A", strtotime($linha["data_deslocacao"]));?></td>
                    <td>        
                        <!--Coluna "Ação"  atribuidas com um link que as leva para outros ficheiros para processar a devida função.
                        Evidenciando que cada link passa o valor da coluna que vai ser editada ou apagada-->
                        
                        <a title = "Apagar produto" onclick= "conf_apag('<?php echo $id; ?>','<?php echo $id_seccao; ?>','<?php echo $quantidade_atual;  ?>')" class="acoes">
                        <i  class="far fa-trash-alt"></i>
                        </a>
                        <a href="deslocar_produto.php?idproduto=<?php echo $id; ?>&idseccao=<?php echo $linha['id_seccao']; ?>" title = "Deslocar produto para outra secção"  class="acoes">
                        <i class="fas fa-dolly"></i>
                        </a>
    
                    </td>


                </tr> 
            
                <?php }} ?>
            </tbody>

<?php } ?>

<?php
/*3.1)FUNÇÃO QUE MOSTRA O FORMULARIO DE DESLOCAR PRODUTO -  OK*/
function show_deslocar_produto($produto,$seccao_deslocar,$quantidade_produto_total,$unidade_medida,$tipo_seccao,$descricao){ 
    include("conexao.php"); ?>
    <main>
    <div class="wrapper-main">
    
    <section class="seccao_form">


        <img src="includes/imgs/imagem_Seccoes_deslocar.png">

        <h1>Deslocar Produto '<?php echo $descricao; ?>'</h1>

        <hr class="linha_registrar">
        
        <br>

        <form class="formulario_inserir" action="includes/deslocProduto.inc.php" method="post">

            <input type="hidden" id="idproduto" name="idproduto" value="<?php echo $produto; ?>">

            <input type="hidden" id="idseccao" name="idseccao" value="<?php echo $seccao_deslocar; ?>">

            <input type="hidden" id="quantidadeatual" name="quantidadeatual" value ="<?php echo $quantidade_produto_total; ?>">

            <input type="hidden" id="unidademedida" name="unidademedida" value ="<?php echo $unidade_medida; ?>">

            <label class="titulo_texts" >Quantidade que pretende deslocar:  <span title="Quantidade de produtos a ser deslocados.">*</span></label>

            <input class="caixa_input" type="number" step="0.01" min="0" max="<?php echo $quantidade_produto_total; ?>" value="<?php echo $quantidade_produto_total; ?>" name="quantidade_deslocada">
            <br>

            <div class="holder">
                <div class="titulo_texts">
                    <p>Secção do armazenamento: <span title="Secção aonde será armazenado a quantidade acima, se o produto ja existir na secção,o valor será incrementado, se não, o produto será adicionado!">*</span></p>
                </div>
                <div class="row">
                    <div class="select">
            <select  name ="tipos_seccoes_form" class="dropdown_registrar" required>
            <?php
            $sql ="SELECT seccao.tipo,seccao.id_seccao
                             FROM seccao
                             order by seccao.tipo";            //comando em SQL utilizado para listagem das colunas
                $resultado = $ligacao->query($sql) or die($ligacao->error); // coloca na variavel "resultado" a query da variavel ligação
                while($linha = $resultado->fetch_array()){ ?>
                    <option class="option_chegada" value="<?php echo $linha['id_seccao']; ?>"><?php echo $linha['tipo']; ?></option>
                <?php } ?>
            </select>
            </div>
        </div>
    </div>  
            <!--Check box se for necessario impletação posteriormente:
                <input type="checkbox" name="confirma_chegada" id="confirmar_chegada_valor" checked required> 
            <label class="confirma_text"for="confirmar_chegada_valor">Quero continuar com a deslocação.</label><br><br>-->

            <input type="hidden" id="seccaotipo" name="seccaotipo" value="<?php echo $tipo_seccao; ?>">

            <button class="btnregistrar_chegada" type="submit" name="registrar_enviar">Registrar</button>


        </form>

    </section>

    </div>

    </main>
<?php }?>

<?php
/*3.2)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA deslocar_produto.php -  OK*/
function show_nav_deslocar_produto(){ ?>

            <a title="Retornar a listagem das Secções" class="home" href="listarSeccao.php">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            
            <a title="Voltar a pagina principal" id="home.inc" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
<?php } ?>

<?php
/*3.3)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA listarSeccao.php -  OK*/
function show_nav_listarseccao() {?>
    <a title="Voltar a pagina principal" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
            <a title="Inserir novo produto" class="home" href="CadastrarSeccao.php">
                <i class="fas fa-folder-plus"></i>
            </a>

                <div class="logo">
                    <h4>Navegador</h4>
                </div>
                <ul class="link_nave">

                <div class="pesquisar">
                    <div class="procurar-box">
                        <form method="POST" action="ProcurarProduto.php">
                            <input type="hidden" name="procurarseccao" value="1">
                            <input class="procurar-txt_fornecedor"style="font-size:14px;" type="text" name="procurar" placeholder="Digite para pesquisar por um produto/secção..."> 
                            <button class="procurar-btn">
                            <i class="fas fa-search fa-lg"></i>
                            </button>
                            </form>
                    </div>
                </div>
       
                    <li><a class="li_primario">Encomendas</a>
                        <ul class="sublink_nave">
                            <li><a href="listarEncomenda.php">Listar</a></li>
                            <li><a href="listarFornecedor.php">Fornecedor</a></li>
                        </ul>
                    </li>

                    <?php if(isset($_SESSION['permissao'])){ 
                            if ($_SESSION['permissao'] == "Gerente" or $_SESSION['permissao'] == "Administrador") { ?>

                    <li><a class="li_primario">Compras</a>
                        <ul class="sublink_nave">
                            <li><a href="listarCompra.php">Listar</a></li>
                            <li><a href="listarDevolucao.php">Devoluções</a></li>
                        </ul>
                    </li>

                    <?php   }
                           } ?>            

                    <li><a class="li_primario">Produtos</a>
                        <ul class="sublink_nave">
                            <li><a href="catalogo.php">Cátalogo</a></li>
                        </ul>
                    </li>
                </ul>
 
<?php }?>

<?php
/*3.4)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA cadastrarseccao.php -  OK*/
function show_nav_cadastrar_seccao() {?>
            <a title="Retornar a lista de secções" class="home" href="listarSeccao.php">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            
            <a title="Voltar a pagina principal" id="home.inc" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
<?php }?>

<?php
/*3.5)FUNÇÃO QUE MOSTRA FORMULARIO PARA CADASTRAR UMA SECÇÃO-  OK*/
function show_cadastrar_seccao() {?>
    <main>
    <div class="wrapper-main">
    
    <section class="seccao_form">


        <img class="produto_cadastrar_img" src="includes/imgs/imagem_produtos_cadastrar.png">

        <h1>Cadastrar Secção</h1>

        


        <hr class="linha_registrar">
            <?php
                    if(isset( $_SESSION['msg'])){       //Comando que checa se a variavel universal "msg" possui algum valor.
                        echo  $_SESSION['msg'];         //Se a variavel estiver com algum valor, imprimi na tela o mesmo.
                        unset( $_SESSION['msg']);       //limpa a variavel msg para mensagens posteriores
                    }
            ?>
        <br>

        <form class="formulario_inserir" action="includes/cadastrarSeccao.inc.php" method="post">
            <div class="holder">
            <label class="titulo_texts" >Nome da nova secção:  <span title="Nome da secção que deseja cadastrar no mercado.">*</span></label>

            <input class="caixa_input" type="text"  placeholder="Ex: Congelados,Cereais.." name="nome_seccao">
        </div>
            <br>
            <br>
            <!--Check box se for necessario impletação posteriormente:
                <input type="checkbox" name="confirma_chegada" id="confirmar_chegada_valor" checked required> 
            <label class="confirma_text"for="confirmar_chegada_valor">Quero continuar com a deslocação.</label><br><br>-->

            <button class="btnregistrar_chegada" type="submit" name="registrar_enviar">Registrar</button>


        </form>

    </section>

    </div>

    </main>
<?php }?>

<?php
/*3.6)FUNÇÃO QUE MOSTRA FORMULARIO PARA CADASTRAR UMA SECÇÃO-  OK*/
function show_list_procurar_produto($pesquisar) {?>
            <thead>
                <tr>
                    <td>Produto</td>
                    <td>Secção armazenado</td>
                    <td>Prateleira</td>
                    <td>Quantidade secção armazenado</td>
                    <td>Quantidade total</td>
                    <td>Data armazenado</td>
                    
                </tr>
            </thead>
            <tbody>
            <br>
            <h1 align = 'center'>Resultados para '<?php echo $pesquisar; ?>'</h1>
            <?php
            include("includes/conexao.php");
            $sql = "SELECT * 
            FROM deslocacao 
            inner join produto
            on deslocacao.produto_fk = produto.cod_barra
            inner join seccao
            on deslocacao.seccao_fk = seccao.id_seccao
            WHERE descricao LIKE '%$pesquisar%' or tipo = '$pesquisar'";
            $resultado = $ligacao->query($sql) or die($ligacao->error);
            while($linha = $resultado->fetch_array()){ ?>
            
                <tr>
                <td><?php  echo $linha['descricao'];?></td>
                <td><?php  echo $linha['tipo'];?></td>
                <td><?php  echo $linha['prateleira'];?></td>
                <td><?php  echo $linha['quantidade_deslocacao'];?></td>
                <td><?php  echo $linha['quantidade_total'];?></td>
                <td><?php  echo date("d/m/Y h:i:s A", strtotime($linha["data_deslocacao"]));?></td>
                </tr>
            <?php }?>
            </tbody>
<?php }?>

<?php
/*4) FUNÇÃO QUE MOSTRA LISTA DE FORNECEDORES  -  OK*/
function show_list_fornecedores($id_fornecedor,$i){ ?>


    <thead> 
      
        <tr>
            <td><b>Produto</b></td>
            <td><b>Preço pelo peso</b></td>
            <td><b>Peso produto</b></td>
            <td><b>Ações</b></td>              
        </tr>
    </thead> 

            <tbody>
                    
                <tr>

                <?php
                include("includes/conexao.php");

                $sql ="SELECT *
                FROM catalogo_fornecedor
                INNER JOIN produto
                on catalogo_fornecedor.produto_fk = produto.cod_barra
                where fornecedor_fk = '$id_fornecedor'
                ";            //comando em SQL utilizado para listagem das colunas
                
                $resultado = $ligacao->query($sql) or die($ligacao->error); // coloca na variavel "resultado" a query da variavel ligação
                $numero_linhas = mysqli_num_rows($resultado);
                if($numero_linhas > 0)  
                {  
                 while($linha = $resultado->fetch_array()){ 
                     $id_produto = $linha['cod_barra'];?>     
                    
                    <td>
                        <?php echo $linha["descricao"];?>
                    </td>  
                        
                    <td>
                        <div <?php if($_SESSION['permissao'] == "Administrador" or $_SESSION['permissao'] == "Gerente"){ ?>
                                    contenteditable="true"
                                    onBlur="updateValor_duploid(this,'preco','<?php echo $id_fornecedor; ?>','<?php echo $id_produto; ?>','fornecedor')" 
                                    onClick="ativar(this)"
                            <?php } ?>><?php echo $linha["preco"];?>
                        </div>
                    <i class="fas fa-euro-sign fa-xs"></i>
                    </td>


                    <td>
                        <div <?php if($_SESSION['permissao'] == "Administrador" or $_SESSION['permissao'] == "Gerente"){ ?>
                                    contenteditable="true"
                                    onBlur="updateValor_duploid(this,'peso_fornecedor','<?php echo $id_fornecedor; ?>','<?php echo $id_produto; ?>','fornecedor')" 
                                    onClick="ativar(this)"
                            <?php } ?>><?php echo $linha['peso_fornecedor'];?>
                        </div>
                        <div <?php if($_SESSION['permissao'] == "Administrador" or $_SESSION['permissao'] == "Gerente"){ ?>
                                    contenteditable="true"
                                    onBlur="updateValor_duploid(this,'unidade_medida_fornecido','<?php echo $id_fornecedor; ?>','<?php echo $id_produto; ?>','fornecedor')" 
                                    onClick="ativar(this)"
                            <?php } ?>>
                              <?php echo $linha['unidade_medida_fornecido']; ?>
                        </div>
                    </td>
                
                    <td>        
                        <!--Coluna "Ação"  atribuidas com um link que as leva para outros ficheiros para processar a devida função.
                        Evidenciando que cada link passa o valor da coluna que vai ser editada ou apagada-->                        
                        <a title = "Apagar produto" onclick= "conf_apag_duploid('<?php echo $id_fornecedor; ?>','<?php echo $id_produto; ?>','fornecedor')" class="acoes">
                        <i  class="far fa-trash-alt"></i>
                        </a>   
                    </td>


                </tr> 
            
                <?php } //fileira que poderá adicionar novos valores a bd?>
                            <tr>  
                            <td >

                                <select id="nome_produto_fornecedor<?php echo $i; ?>" class="select_css" name ="tipos_produtos_select"  required>
                                <?php
                                $sql ="SELECT produto.descricao,produto.cod_barra
                                            FROM produto
                                            order by produto.descricao";            //comando em SQL utilizado para listagem das colunas
                                    $resultado = $ligacao->query($sql) or die($ligacao->error); // coloca na variavel "resultado" a query da variavel ligação
                                    while($linha = $resultado->fetch_array()){ ?>
                                        <option class="option_chegada" value="<?php echo $linha['descricao']; ?>"><?php echo $linha['descricao']; ?></option>
                                    <?php } ?>
                                </select>

                               </td>  
                               <td >
                                    <div class="td_dinamica_fornecedor" id="preco_produto<?php echo $i; ?>" onClick="ativar(this)" onblur="desativar(this)" contenteditable placeholder="Preço pelo peso"></div>
                                    <div><i class="fas fa-euro-sign fa-xs"></i> </div>
                              </td>  
                               <td >
                                   <div class="td_dinamica_fornecedor" id="peso_produto<?php echo $i; ?>" onClick="ativar(this)" onblur="desativar(this)" contenteditable placeholder="Peso produto"></div>
                                   <div class="td_dinamica_fornecedor" id="unidade_medida_fornecedor<?php echo $i; ?>" onClick="ativar(this)" onblur="desativar(this)" contenteditable placeholder="Unidade de medida"></div>
                               </td>  
                               <td><button type="button" name="btn_add" id="btn_add<?php echo $i; ?>" class="adicionar_produto_fornecido"><img class="simbolomais" src="includes/imgs/simbolo_mais.png"></button></td>  
                            </tr>
                            <!--<div class="aviso_adicionar_fornecedor" >
                            <p style="margin-left: 10px; margin-top: 10px;">O "Preço pelo peso" e "Peso do produto" são colunas editaveis quando selecionadas,quando des-<br>elecionadas são armazenados na base de dados</p>
                            </div>-->
            </tbody>
            <?php    }else {?>
                <tr>  
                            <td >

                                <select id="nome_produto_fornecedor<?php echo $i; ?>"  class="select_css" name ="tipos_produtos_select"  required>
                                <?php
                                $sql ="SELECT produto.descricao,produto.cod_barra
                                            FROM produto
                                            order by produto.descricao";            //comando em SQL utilizado para listagem das colunas
                                    $resultado = $ligacao->query($sql) or die($ligacao->error); // coloca na variavel "resultado" a query da variavel ligação
                                    while($linha = $resultado->fetch_array()){ ?>
                                        <option class="option_chegada" value="<?php echo $linha['descricao']; ?>"><?php echo $linha['descricao']; ?></option>
                                    <?php } ?>
                                </select>

                               </td>  
                               <td id="preco_produto<?php echo $i; ?>" onClick="ativar(this)" contenteditable placeholder="Preço pelo peso"></td>  
                               <td >
                                   <div id="peso_produto<?php echo $i; ?>" onClick="ativar(this)" contenteditable placeholder="Peso produto"></div>
                                   <div id="unidade_medida_fornecedor<?php echo $i; ?>" onClick="ativar(this)" contenteditable placeholder="Unidade de medida"></div>
                               </td>  
                               <td><button type="button" name="btn_add" id="btn_add<?php echo $i; ?>" class="btn btn-xs btn-success">+</button></td>  
                            </tr>  
<?php } }?>

<?php
/*4.1)FUNÇÃO QUE MOSTRA BOTÃO QUE AGRUPA TODOS OS FORNECEDORES -  OK*/
function show_button_fornecedor($id_fornecedor,$i,$nome_fornecedor,$email_fornecedor,$localidade_fornecedor,$contacto_fornecedor) { ?>
    <div class="wrapper">
        <a id="exibir_listagembtn<?php echo $i; ?>" class="cta">
            <span id="exibir_listagembtn<?php echo $i; ?>"><?php echo $nome_fornecedor." - ".$id_fornecedor; ?> 
                                                                <br> 
                                                                <p class="sub_paragrafo1"><?php echo $email_fornecedor ?></p>
                                                                <p class="sub_paragrafo1"><?php echo $contacto_fornecedor; ?></p>
                                                                <p class="sub_paragrafo2_label"> Localidade: <?php echo $localidade_fornecedor;?> </p>                                                               
                                                                
            </span>
            <span id="exibir_listagembtn<?php echo $i; ?>">
                <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                        <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                        <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                    </g>
                </svg>
            </span> 
        </a>
    </div>

<?php } ?>

<?php
/*4.2)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA listarFornecedor.php  -  OK*/
function show_nav_fornecedor(){ ?>
    <a title="Voltar a pagina principal" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
            <a title="Adicionar novo Fornecedor" class="home" href="cadastrarFornecedor.php">
                <i class="fas fa-folder-plus"></i>
            </a>

                <div class="logo">
                    <h4>Navegador</h4>
                </div>

                <div class="pesquisar_catalogo">
                    <div class="procurar-box">
                        <form method="POST" action="ProcurarProduto.php">
                            <input type="hidden" name="procurarfornecedor" value="1">
                            <input class="procurar-txt_fornecedor" type="text" name="procurar" placeholder="Digite para pesquisar por dados fornecedores."> 
                            <button class="procurar-btn">
                            <i class="fas fa-search fa-lg"></i>
                            </button>
                            </form>
                    </div>
                </div>

                <ul class="link_nave">
                    <li><a class="li_primario">Secção</a>
                        <ul class="sublink_nave">
                            <li><a href="listarSeccao.php">Listar</a></li>
                        </ul>
                    </li>

                    <li><a class="li_primario">Encomendas</a>
                        <ul class="sublink_nave">
                            <li><a href="listarEncomenda.php">Listar</a></li>
                        </ul>
                    </li>

                    <?php if(isset($_SESSION['permissao'])){ 
                            if ($_SESSION['permissao'] == "Gerente" or $_SESSION['permissao'] == "Administrador") { ?>

                    <li><a class="li_primario">Compras</a>
                        <ul class="sublink_nave">
                            <li><a href="listarCompra.php">Listar</a></li>
                            <li><a href="listarDevolucao.php">Devoluções</a></li>
                        </ul>
                    </li>

                    <?php   }
                           } ?>      

                    <li><a class="li_primario">Produtos</a>
                        <ul class="sublink_nave">
                            <li><a href="catalogo.php">Catálogo</a></li>
                        </ul>
                    </li>
                </ul>
<?php } ?>

<?php
/*4.3)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA cadastrarFornecedor.php  -  OK*/
function show_nav_cadastrar_fornecedor(){ ?>
            <a title="Retornar a listagem dos fornecedores" class="home" href="listarFornecedor.php">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            
            <a title="Voltar a pagina principal" id="home.inc" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
<?php } ?>

<?php
/*4.4)FUNÇÃO QUE MOSTRA O FORMULARIO PARA CADASTRO DO FORNECEDOR  -  OK*/
function show_cadastrar_fornecedor(){ ?>
    <main>
    <div class="wrapper-main">
    
    <section class="seccao_form">


        <img class="produto_cadastrar_img" src="includes/imgs/icon_fornecedor_cadastrar.png">

        <h1>Cadastrar Fornecedor</h1>

        


        <hr class="linha_registrar">
            <?php
                    if(isset( $_SESSION['msg'])){       //Comando que checa se a variavel universal "msg" possui algum valor.
                        echo  $_SESSION['msg'];         //Se a variavel estiver com algum valor, imprimi na tela o mesmo.
                        unset( $_SESSION['msg']);       //limpa a variavel msg para mensagens posteriores
                    }
            ?>
        <br>

        <form class="formulario_inserir" action="includes/cadastrarFornecedor.inc.php" method="post">
            <div class="holder">
            <label class="titulo_texts" >Nome do Fornecedor:  <span title="Nome da empresa a qual será solicitado encomendas.">*</span></label>

            <input class="caixa_input" type="text"  placeholder="Nome empresa" name="nome_fornecedor">
            <br><br>

            <label class="titulo_texts" >Contacto:  <span title="Numero de contacto com o fornecedor.">*</span></label>

            <input class="caixa_input" type="tel"  placeholder="123-456-789" name="contacto_fornecedor" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" maxlength="11">
            <br><br>

            <label class="titulo_texts" >Email:  <span title="Email de contacto com o fornecedor.">*</span></label>

            <input class="caixa_input" type="email"  placeholder="exemplo@hotmail.com" name="email_fornecedor">
            <br><br>

            <label class="titulo_texts" >Localidade:  <span title="Localidade do fornecedor.">*</span></label>

            <input class="caixa_input" type="text"  placeholder="Ex: Porto,Lisboa.." name="localidade_fornecedor">
        </div>
            <br>
            <br>
            <!--Check box se for necessario impletação posteriormente:
                <input type="checkbox" name="confirma_chegada" id="confirmar_chegada_valor" checked required> 
            <label class="confirma_text"for="confirmar_chegada_valor">Quero continuar com a deslocação.</label><br><br>-->

            <button class="btnregistrar_chegada" type="submit" name="registrar_enviar">Registrar</button>


        </form>

    </section>

    </div>
    </main>
<?php } ?>

<?php
/*4.5)FUNÇÃO QUE MOSTRA O FORMULARIO PARA CADASTRO DO FORNECEDOR  -  OK*/
function show_list_procurar_produto_fornecedor($pesquisar){ ?>
            <thead>
                <tr>
                    <td>ID empresa</td>
                    <td>Nome empresa</td>
                    <td>Produto fornecido</td>
                    <td>Preço pelo peso</td>
                    <td>Peso produto</td>
                    <td>Contacto</td>
                    <td>Email</td>
                    <td>Endereço</td>
                    
                </tr>
            </thead>
            <tbody>
            <br>
            <h1 align = 'center'>Resultados para '<?php echo $pesquisar; ?>'</h1>
            <?php
            include("includes/conexao.php");
            $sql = "SELECT * 
                    FROM fornecedor
                    left join catalogo_fornecedor
                    on catalogo_fornecedor.fornecedor_fk = fornecedor.ID_fornecedor
                    left join produto
                    on produto.cod_barra = catalogo_fornecedor.produto_fk
            WHERE id_fornecedor = '$pesquisar' or nome_fornecedor LIKE '%$pesquisar%' or contacto = '$pesquisar' or email = '$pesquisar' or localidade = '$pesquisar'";
            $resultado = $ligacao->query($sql) or die($ligacao->error);
            while($linha = $resultado->fetch_array()){ ?>
            
                <tr>
                <td><?php  echo $linha['ID_fornecedor'];?></td>
                <td><?php  echo $linha['nome_fornecedor'];?></td>
                <td><?php  echo $linha['descricao'];?></td>
                <td><?php  echo $linha['preco'];?></td>
                <td><?php  echo $linha['peso'];?></td>
                <td><?php  echo $linha['contacto'];?></td>
                <td><?php  echo $linha['email'];?></td>
                <td><?php  echo $linha['localidade'];?></td>
                </tr>
            <?php }?>
            </tbody>
<?php } ?>

<?php
/*5)FUNÇÃO QUE MOSTRA LISTA DE ENCOMENDAS -  OK*/
function show_list_encomendas($id,$custo_total,$data_chegada){ ?>
            <thead>
                <tr>
                    <td>Produto</td>
                    <td>Empresa</td>
                    <td>Quantidade</td>
                    <td>Custo Produto</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>
            
            <?php
            include("includes/conexao.php");
            $sql = "SELECT * FROM encomenda
            inner join solicitacao
            on encomenda.ID_encomenda = solicitacao.encomenda_fk
            inner join produto
            on produto.cod_barra = solicitacao.produto_fk
            inner join fornecedor
            on fornecedor.ID_fornecedor = solicitacao.fornecedor_fk
            where id_encomenda = '$id'";
            $resultado = $ligacao->query($sql) or die($ligacao->error);
            while($linha = $resultado->fetch_array()){  
                $quantidade= $linha['quantidade_solicitacao'];
                $custo = $linha['custo_solicitacao'];
                $id_encomenda = $linha['ID_encomenda'];
                $produto = $linha['cod_barra'];
                $id_fornecedor = $linha['ID_fornecedor'];
                
                ?>
                <tr>
                <td><?php  echo $linha['descricao'];?></td>
                <td><?php  echo $linha['nome_fornecedor'];?></td>
                <td>
                <?php  if(is_null($data_chegada)){  ?>
                    <div id="quantidade_encomenda"<?php if($_SESSION['permissao'] == "Administrador" or $_SESSION['permissao'] == "Gerente"){ ?>
                                contenteditable="true"
                                onBlur="updateValor_triploid(this,'quantidade_solicitacao','<?php echo $id_encomenda; ?>','<?php echo $produto; ?>','<?php echo $id_fornecedor; ?>','encomenda')" 
                                onClick="ativar(this)"
                        <?php } ?>>
                <?php } ?>
                    <?php  echo $quantidade;?>
                    </div> 
                    <?php echo $linha['unidade_medida_produto'];?>
                </td>
                <td>    
                <?php  if(is_null($data_chegada)){  ?>
                    
                        <div <?php if($_SESSION['permissao'] == "Administrador" or $_SESSION['permissao'] == "Gerente"){ ?>
                                contenteditable="true"
                                onBlur="updateValor_triploid(this,'custo_solicitacao','<?php echo $id_encomenda; ?>','<?php echo $produto; ?>','<?php echo $id_fornecedor; ?>','encomenda')" 
                                onClick="ativar(this)"
                        <?php } ?>>
                        <?php } ?>
                            <?php  echo $custo;?>
                        </div>
                            
                            <i class="fas fa-euro-sign fa-xs"></i></td>
                         
                <td>        
                        <!--Coluna "Ação"  atribuidas com um link que as leva para outros ficheiros para processar a devida função.
                        Evidenciando que cada link passa o valor da coluna que vai ser editada ou apagada-->                       
                        <a title = "Apagar produto" onclick= "conf_apag_duploid('<?php echo $id_encomenda; ?>','<?php echo $produto; ?>','encomenda')" class="acoes">
                        <i  class="far fa-trash-alt"></i>
                        </a>

    
                    </td>
                </tr>
                
            <?php 
            $custo_total += $linha['custo_solicitacao'];
            }?>
            </tbody> 
            <tfoot>
                <tr>
                    <td>Data Chegada: <?php  if(!is_null($data_chegada)){ 
                                                echo date("d/m/Y h:i:s A", strtotime($data_chegada));

                                            }else if (is_null($data_chegada)){ 
                                                echo "Encomenda ainda não entregue."; } ?></td>
                    <td></td>
                    <td>Custo total: </td>
                    <td> <?php  echo number_format($custo_total, 2, '.', ''); ?> Euros</td>
                    <td>
                        <?php  if(is_null($data_chegada)){  ?>
                        <a href="registrar_data_chegada_encomenda.php?idtabela=<?php echo $id; ?>" title = "Marcar como encomenda entregue"  class="acoes_encomenda">
                        <i class="fas fa-clipboard-check fa-lg"></i>
                        </a>
                        <?php } ?>
                    </td>
                </tr>
            </tfoot>



<?php } ?>

<?php
/*5.1)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA listarEncomenda.php -  OK*/
function show_nav_encomendas(){ ?>
    <a title="Voltar a pagina principal" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
            <a title="cadastrar nova encomenda" class="home" href="cadastrarEncomenda.php">
                <i class="fas fa-folder-plus"></i>
            </a>

                <div class="logo">
                    <h4>Navegador</h4>
                </div>

                <div class="pesquisar_encomenda">
                    <div class="procurar-box">
                        <form method="POST" action="ProcurarProduto.php">
                            <input type="hidden" name="procurarencomenda" value="1">
                            <input class="procurar-txt_fornecedor" type="text" name="procurar" placeholder="Digite para pesquisar numero da encomenda..."> 
                            <button class="procurar-btn">
                            <i class="fas fa-search fa-lg"></i>
                            </button>
                            </form>
                    </div>
                </div>

                <ul class="link_nave">
                    <li><a class="li_primario">Secção</a>
                        <ul class="sublink_nave">
                            <li><a href="listarSeccao.php">Listar</a></li>
                        </ul>
                    </li>

                    <li><a class="li_primario">Encomendas</a>
                        <ul class="sublink_nave">
                            <li><a href="listarFornecedor.php">Fornecedor</a></li>
                        </ul>
                    </li>

                    <?php if(isset($_SESSION['permissao'])){ 
                            if ($_SESSION['permissao'] == "Gerente" or $_SESSION['permissao'] == "Administrador") { ?>

                    <li>
                        <a class="li_primario">Compras</a>
                        <ul class="sublink_nave">
                            <li><a href="listarCompra.php">Listar</a></li>
                            <li><a href="listarDevolucao.php">Devoluções</a></li>
                        </ul>
                    </li>

                    <?php   }
                           } ?>      
            
                    <li><a class="li_primario">Produtos</a>
                        <ul class="sublink_nave">
                            <li><a href="catalogo.php">Catálogo</a></li>
                        </ul>
                    </li>
                </ul>
<?php } ?>

<?php
/*5.2)FUNÇÃO QUE MOSTRA BOTÃO QUE AGRUPA TODAS AS ENCOMENDAS -  OK*/
function show_button_encomenda($id,$i,$datasoli,$data_chegada,$fornecedor) { ?>
    <div class="wrapper">
        <a id="exibir_listagembtn<?php echo $i; ?>" class="cta">
            <span id="exibir_listagembtn<?php echo $i; ?>"><?php echo "Encomenda - ". $id; ?> 
                                                                <br> 
                                                                <p class="sub_paragrafo1"><?php echo date("d/m/Y H:i:s", strtotime($datasoli)); ?></p>
                                                                <p class="sub_paragrafo1">Fornecedor da encomenda: <?php echo $fornecedor; ?></p>
                                                                <p class="sub_paragrafo2_label"> Status: </p>
                                                                <?php if(isset($data_chegada)){ ?> 
                                                                        <p class="sub_paragrafo2_entregue"> <?php echo "Encomenda entregue!";?> </p> <?php 
                                                                      }else{ ?> <p class="sub_paragrafo2_naoentregue"> <?php echo "Encomenda não entregue!"; } ?> </p> </span>
            <span id="exibir_listagembtn<?php echo $i; ?>">
                <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                        <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                        <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                    </g>
                </svg>
            </span> 
        </a>
    </div>

<?php } ?>

<?php
/*5.3)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA registrarChegada.php -  OK*/
function show_nav_registrar_chegada(){ ?>
            <a title="Retornar a listagem das encomendas" class="home" href="listarEncomenda.php">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            
            <a title="Voltar a pagina principal" id="home.inc" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
<?php } ?>
<?php

/*5.4)FUNÇÃO QUE MOSTRA REGISTRO DE CHEGADA DAS ENCOMENDAS -  OK*/
function show_registrar_chegada($id_tabela){ 
    include("conexao.php"); ?>

    <main>
    <div class="wrapper-main">
    
    <section class="seccao_form">


        <img src="includes/imgs/imagem_encomendas_chegada.png">

        <h1>Registrar Chegada</h1>

        <hr class="linha_registrar">

        <br>

        <form class="formulario_inserir" action="includes/inserirChegadaEncomenda.inc.php" method="post">

            <input type="hidden" id="idtabela" name="idtabela" value="<?php echo $id_tabela; ?>">


            <label class="titulo_texts" >Data de chegada da encomenda: <span title="Introduza a data de chegada para atualização dos status. Dia de hoje será definido como padrão.">*</span></label>

            <input class="caixa_input" type="date" name="date_chegada" value="<?php echo date('Y-m-d'); ?>">
            <br>

            <div class="holder">
                <div class="titulo_texts">
                    <p>Secção do armazenamento: <span title="Ler Aviso de procedimento a baixo">*</span></p>
                </div>
                <div class="row">
                    <div class="select">
            <select  name ="tipos_seccoes_form" class="dropdown_registrar" required>
            <?php
            $sql ="SELECT seccao.tipo,seccao.id_seccao
                             FROM seccao
                             order by seccao.tipo";            //comando em SQL utilizado para listagem das colunas
                $resultado = $ligacao->query($sql) or die($ligacao->error); // coloca na variavel "resultado" a query da variavel ligação
                while($linha = $resultado->fetch_array()){ ?>
                    <option class="option_chegada" value="<?php echo $linha['id_seccao']; ?>"><?php echo $linha['tipo']; ?></option>
                <?php } ?>
            </select>
            </div>
        </div>
    </div>

            <div class="aviso_chegada">
                <label class="titulo_texts" >Aviso de Procedimento: </label><br>

                <div class="textaviso">
                    Após a introdução da data de chegada, a encomenda em questão ja é tida como pertencente do hipermercado,
                    todos os produtos associados a esta encomenda se dirigirão para a secção selecionado pelo utilizador.
                    Se nenhuma secção for selecionada, por padrão esta encomenda se encaminha para o armazem,
                    aonde poderá ser deslocada a qualquer outra secção, na pagina destinada a listar as Secções
                    
                </div>
            </div>
            <br>
            <input type="checkbox" name="confirma_chegada" id="confirmar_chegada_valor" checked required> 
            <label class="confirma_text"for="confirmar_chegada_valor">Afirmo que li o aviso de procedimento e quero continuar.</label><br><br>



            <button class="btnregistrar_chegada" type="submit" name="registrar_enviar">Registrar</button>


        </form>

    </section>

    </div>

    </main>

<?php } ?>

<?php
/*5.5)FUNÇÃO QUE MOSTRA BOTÃO QUE AGRUPA TODAS AS ENCOMENDAS -  OK*/
function show_nav_cadastrar_encomenda() { ?>
            <a title="Retornar a listagem das encomendas" class="home" href="listarEncomenda.php">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            
            <a title="Voltar a pagina principal" id="home.inc" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
<?php } ?>

<?php
/*5.6)FUNÇÃO QUE MOSTRA O FORMULARIO DE CADASTRAR ENCOMENDA -  OK*/
function show_cadastrar_encomenda() { ?>
    <main>
    <div class="wrapper-main">
    
    <section class="seccao_form">
    <?php include("conexao.php"); ?>

        <img class="produto_cadastrar_img" src="includes/imgs/imagem_encomendas_cadastrar.png">

        <h1>Cadastrar Encomenda</h1>

        


        <hr class="linha_registrar">
            <?php
                    if(isset( $_SESSION['msg'])){       //Comando que checa se a variavel universal "msg" possui algum valor.
                        echo  $_SESSION['msg'];         //Se a variavel estiver com algum valor, imprimi na tela o mesmo.
                        unset( $_SESSION['msg']);       //limpa a variavel msg para mensagens posteriores
                    }
            ?>
        <br>

        <form class="formulario_inserir" action="includes/cadastrarEncomenda.inc.php" method="post">
            <div class="holder">
            <div class="titulo_texts_group">
                <p>Nome da empresa:<span title="Nome da empresa já registrada na lista de fornecedores do mercado, que será solicitada os produtos abaixo.">*</span></p>
            </div>
            <div class="row">
                <div class="select">
                    <select id="select_fonecedor_encomenda"  name ="tipos_fornecedores_select" class="dropdown_registrar" required>
                    <?php
                    $sql ="SELECT fornecedor.id_fornecedor,fornecedor.nome_fornecedor
                            FROM fornecedor
                            order by fornecedor.nome_fornecedor";            //comando em SQL utilizado para listagem das colunas
                    $resultado = $ligacao->query($sql) or die($ligacao->error); // coloca na variavel "resultado" a query da variavel ligação?>
                    <option class="option_chegada" value="">Selecionar Fornecedor</option>
                    <?php while($linha = $resultado->fetch_array()){ ?>
                            <option class="option_chegada" value="<?php echo $linha['id_fornecedor']; ?>"><?php echo $linha['nome_fornecedor']; ?></option>
                    <?php } ?>

                    
                    </select>
                </div>
            </div>
            </div>


            <div id="area_cadastro_encomenda" class="area_cadastro_encomenda">
                <div id="holdernumero" class="holder">
            <div id="Produto_form_encomenda" class="Produto_form_encomenda">     
                
            <br>
                <div class="titulo_texts_group">
                    <p>Escolha o produto que será encomendado:<span title="O produto tem de estar já registrado no catalogo com seu devido preço no mercado.">*</span></p>
                </div>

                <div class="row">
                    <div class="select">
                <select id="select_produto_encomenda"  name ="tipos_produtos_select[]" class="dropdown_registrar" required>
                    <option class="option_chegada" value="">Selecione Fornecedor Primeiro!</option>
                </select>
                    </div>
                </div>

            <label class="titulo_texts_group" >Quantidade solicitada:  <span title="Quantidade que será solicitada do produto acima.">*</span></label>

            <input class="caixa_input_group" type="number" step="0.01" min="0"  placeholder="Ex: 300" name="quantidade_solicitacao[]">
            <br>
            <br>

            <a  href="#" id="adicionar" class="btnadicionar" onClick="return false;"> Adicionar novo Produto</a> <a href="#" id="remover" class="btnremover" style="display: none;" onClick="return false;">  Remover Produto</a>
            <br><br>
        </div>
        </div>    
        </div>
            <br>
            <br>
            <!--Check box se for necessario impletação posteriormente:
                <input type="checkbox" name="confirma_chegada" id="confirmar_chegada_valor" checked required> 
            <label class="confirma_text"for="confirmar_chegada_valor">Quero continuar com a deslocação.</label><br><br>-->

            <button class="btnregistrar_chegada" type="submit" name="registrar_enviar">Registrar</button>


        </form>

    </section>

    </div>
    </main>
<?php } ?>

<?php
/*5.6)FUNÇÃO QUE MOSTRA O FORMULARIO DE CADASTRAR ENCOMENDA -  OK*/
function show_list_procurar_produto_encomenda($pesquisar) { ?>
            <thead>
                <tr>
                    <td>Encomenda</td>
                    <td>Empresa</td>
                    <td>Produto</td>
                    <td>Quantidade</td>
                    <td>Custo Produto</td>
                    <td>Data Chegada</td>
                    
                    
                </tr>
            </thead>
            <tbody>
            <br>
            <h1 align = 'center'>Resultados para '<?php echo $pesquisar; ?>'</h1>
            <?php
            include("includes/conexao.php");
            $sql = "SELECT * 
            FROM solicitacao
            inner join produto
            on solicitacao.produto_fk = produto.cod_barra
            inner join encomenda
            on solicitacao.encomenda_fk = encomenda.id_encomenda
            inner join fornecedor
            on solicitacao.fornecedor_fk = fornecedor.id_fornecedor
            WHERE encomenda_fk = '$pesquisar' or data_encomenda = '$pesquisar' or data_chegada = '$pesquisar'";
            $resultado = $ligacao->query($sql) or die($ligacao->error);
            while($linha = $resultado->fetch_array()){ ?>
            
                <tr>
                <td><?php  echo $linha['encomenda_fk'];?></td>
                <td><?php  echo $linha['nome_fornecedor'];?></td>
                <td><?php  echo $linha['descricao'];?></td>

                <td><?php  echo $linha['quantidade_solicitacao'];
                           echo $linha['unidade_medida_produto'];?></td>
                
                <td><?php  echo $linha['custo_solicitacao'];?>
                <i class="fas fa-euro-sign fa-xs"></i>
                </td>
                <td><?php  echo date("d/m/Y h:i:s A", strtotime($linha["data_chegada"]));?></td>
                </tr>
            <?php }?>
            </tbody>
<?php } ?>


<?php
/*6)FUNÇÃO QUE MOSTRA LISTA DE COMPRAS -  OK*/
function show_list_compras($id,$custo_total){ ?>

            <thead>
                <tr>

                    <td>Produto</td>
                    <td>Quantidade</td>
                    <td></td>
                    <td>Custo</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>
            <br>
            <?php
            include("includes/conexao.php");
            $sql = "SELECT * FROM compra
            inner join Fatura
            on Fatura.ID_fatura = compra.fatura_fk
            inner join produto
            on produto.cod_barra = compra.produto_fk
            where id_fatura = '$id'
            ";
            $resultado = $ligacao->query($sql) or die($ligacao->error);
            while($linha = $resultado->fetch_array()){ 
                $custo = (($linha['preco_unitario'] * $linha['quantidade_compra']) / $linha['peso']);
                          ?>
                <tr>

                <td ><?php  echo $linha['descricao'];?></td>
                <td><?php  echo $linha['quantidade_compra'];
                           echo $linha['unidade_medida_produto'];?></td>
                <td></td>
                <td><?php  echo $custo; ?><i class="fas fa-euro-sign fa-xs"></i></td>
                <td>
                    <a  href="devolverProduto.php?idproduto=<?php echo $linha['cod_barra']; ?>&idcaixa=<?php echo $linha['caixa_fk']; ?>&idfatura=<?php echo $linha['fatura_fk']; ?>" title="Devolver Produto"  class="acoes">
                    <i  class="fas fa-exchange-alt fa-2x"></i>
                    </a>
                </td>
                </tr>

            <?php

            $custo_total += $custo;
            $nif = $linha['nif'];
            }            
            $sql = "UPDATE compra
            set custo = '$custo'
            ";
            $resultado = $ligacao->query($sql) or die($ligacao->error);   
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>NIF cliente:</td>
                    <td><?php  echo $nif;?></td>
                    <td>Custo total: </td>
                    <td><?php  echo number_format($custo_total, 2, '.', ''); ?> Euros</td>
                    <td></td>
                </tr>
            </tfoot>


<?php } ?>

<?php
/*6.1)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA listarCompras.php -  OK*/
function show_nav_compras(){ ?>
            <a title="Voltar a pagina principal" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
            <a title="cadastrar nova compra" class="novo_elemento" href="cadastrarCompra.php">
                <i class="fas fa-folder-plus"></i>
            </a>

                <div class="logo">
                    <h4>Navegador</h4>
                </div>

                <div class="pesquisar_catalogo">
                    <div class="procurar-box">
                        <form method="POST" action="ProcurarProduto.php">
                            <input type="hidden" name="procurarcompra" value="1">
                            <input class="procurar-txt" type="text" name="procurar" placeholder="Digite para pesquisar pelo numero da fatura..."> 
                            <button class="procurar-btn">
                            <i class="fas fa-search fa-lg"></i>
                            </button>
                            </form>
                    </div>
                </div>

                <ul class="link_nave">
                    <li><a class="li_primario">Secção</a>
                        <ul class="sublink_nave">
                            <li><a href="listarSeccao.php">Listar</a></li>
                        </ul>
                    </li>

                    <li><a class="li_primario">Encomendas</a>
                        <ul class="sublink_nave">
                            <li><a href="listarEncomenda.php">Listar</a></li>
                            <li><a href="listarFornecedor.php">Fornecedor</a></li>
                        </ul>
                    </li>

                    <?php if(isset($_SESSION['permissao'])){ 
                            if ($_SESSION['permissao'] == "Gerente" or $_SESSION['permissao'] == "Administrador") { ?>

                    <li><a class="li_primario">Compras</a>
                        <ul class="sublink_nave">
                            <li><a href="listarDevolucao.php">Devoluções</a></li>
                        </ul>
                    </li>

                    <?php   } 
                          } ?>

                    <li><a class="li_primario">Produtos</a>
                        <ul class="sublink_nave">
                            <li><a href="catalogo.php">Catálogo</a></li>
                        </ul>
                    </li>
                </ul>
<?php } ?>

<?php
/*6.2)FUNÇÃO QUE MOSTRA BOTÃO QUE AGRUPA TODAS AS COMPRAS -  OK*/
function show_button_recibo($id,$i,$data_fatura,$id_caixa,$tipo_pagamento) { ?>
    <br><br>

    <div class="wrapper">
        <a id="exibir_listagembtn<?php echo $i; ?>" class="cta">
            <span id="exibir_listagembtn<?php echo $i; ?>"><?php echo "Fatura/recibo - ". $id; ?> 
                                                                <br> 
                                                                <p class="sub_paragrafo1"><?php echo date("d/m/Y H:i:s", strtotime($data_fatura)); ?></p>
                                                                <p class="sub_paragrafo1">Pagamento em: <?php echo $tipo_pagamento; ?></p>
                                                                <p class="sub_paragrafo2_label"> Caixa efetuada a transação: <?php echo $id_caixa; ?> </p>                                                               
                                                                </span>
            <span id="exibir_listagembtn<?php echo $i; ?>">
                <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                        <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                        <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                    </g>
                </svg>
            </span> 
        </a>
    </div>
<?php } ?>

<?php
/*6.3)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA cadastrarCompra -  OK*/
function show_nav_cadastrar_compra() { ?>
            <a title="Retornar a listagem das Compras" class="home" href="listarCompra.php">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            
            <a title="Voltar a pagina principal" id="home.inc" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
<?php } ?>


<?php
/*6.4)FUNÇÃO QUE MOSTRA FORMULARIO DE CADASTRAR COMPRA -  OK*/
function show_cadastrar_compra() { ?>
    <main>
    <div class="wrapper-main">
    
    <section class="seccao_form">
    <?php include("conexao.php"); ?>

        <img class="produto_cadastrar_img" src="includes/imgs/imagem_cadastrar_compra.png">

        <h1>Realizar Venda</h1>

        


        <hr class="linha_registrar">
            <?php
                    if(isset( $_SESSION['msg'])){       //Comando que checa se a variavel universal "msg" possui algum valor.
                        echo  $_SESSION['msg'];         //Se a variavel estiver com algum valor, imprimi na tela o mesmo.
                        unset( $_SESSION['msg']);       //limpa a variavel msg para mensagens posteriores
                    }
            ?>
        <br>

        <form class="formulario_inserir" action="includes/cadastrarCompra.inc.php" method="post">
        
        <label class="titulo_texts" >Qual a forma de pagamento?  <span title="Quantidade que será solicitada do produto acima.">*</span></label>
        <div class="row">
                    <div class="select">
        <select  name ="tipo_pagamento_select[]" class="dropdown_registrar" required>
            <option class="option_chegada" value="Cartão">Cartão</option>
            <option class="option_chegada" value="Dinheiro">Dinheiro</option>
            <option class="option_chegada" value="Cheque">Cheque</option>
        </select>
                    </div>
        </div>

            <div class="holder">

            <div id="area_cadastro_encomenda" class="area_cadastro_encomenda">
                <div class="holder">
            <div id="Produto_form_encomenda" class="Produto_form_encomenda">     
                
            <br>
                <div class="titulo_texts_group">
                    <p>Escolha o produto da venda:<span title="O produto tem de estar já registrado no catalogo com seu devido preço no mercado.">*</span></p>
                </div>

                <div class="row">
                    <div class="select">
                <select  name ="tipos_produtos_venda_select[]" class="dropdown_registrar" required>
            <?php
            $sql ="SELECT produto.descricao,produto.cod_barra
                          FROM produto
                          order by produto.descricao";            //comando em SQL utilizado para listagem das colunas
                $resultado = $ligacao->query($sql) or die($ligacao->error); // coloca na variavel "resultado" a query da variavel ligação
                while($linha = $resultado->fetch_array()){ ?>
                    <option class="option_chegada" value="<?php echo $linha['cod_barra']; ?>"><?php echo $linha['descricao']; ?></option>
                <?php } ?>
            </select>
                    </div>
                </div>

            <label class="titulo_texts_group" >Quantidade:  <span title="Quantidade que será solicitada do produto acima.">*</span></label>

            <input class="caixa_input_group" type="number" step="0.01" min="0"  placeholder="Ex: 300" name="quantidade_venda[]">
            <br>
            <br>


            <a  href="#" id="adicionar" class="btnadicionar" onClick="return false;"> Adicionar novo Produto</a> <a href="#" id="remover" class="btnremover" style="display: none;" onClick="return false;">  Remover Produto</a>
            <br><br>
        </div>
        </div>    
        </div>
            <br>
            <br>
            <!--Check box se for necessario impletação posteriormente:
                <input type="checkbox" name="confirma_chegada" id="confirmar_chegada_valor" checked required> 
            <label class="confirma_text"for="confirmar_chegada_valor">Quero continuar com a deslocação.</label><br><br>-->

            <button class="btnregistrar_chegada" type="submit" name="registrar_enviar">Registrar</button>


        </form>

    </section>

    </div>
    </main>
<?php } ?>

<?php
/*6.5)FUNÇÃO QUE MOSTRA RESULTADO DA PESQUISA SOBRE COMPRA -  OK*/
function show_list_procurar_produto_compra($pesquisar) { ?>
            <thead>
                <tr>
                    <td>Fatura</td>
                    <td>Produto</td>
                    <td>Quantidade</td>
                    <!--<td>Custo Produto</td>-->
                    <td>Data Compra</td>
                    
                    
                </tr>
            </thead>
            <tbody>
            <br>
            <h1 align = 'center'>Resultados para '<?php echo $pesquisar; ?>'</h1>
            <?php
            include("includes/conexao.php");
            $sql = "SELECT * 
            FROM compra
            inner join produto
            on compra.produto_fk = produto.cod_barra
            inner join fatura
            on compra.fatura_fk = fatura.id_fatura
            WHERE fatura_fk = '$pesquisar' or data_fatura = '$pesquisar'";
            $resultado = $ligacao->query($sql) or die($ligacao->error);
            while($linha = $resultado->fetch_array()){ ?>
            
                <tr>
                <td><?php  echo $linha['fatura_fk'];?></td>
                <td><?php  echo $linha['descricao'];?></td>

                <td><?php  echo $linha['quantidade_compra'];
                           echo $linha['unidade_medida_produto'];?></td>
                
                <!--<td><?php  //echo $linha['custo'];?>
                <i class="fas fa-euro-sign fa-xs"></i>
                </td>-->
                <td><?php  echo date("d/m/Y h:i:s A", strtotime($linha["data_fatura"]));?></td>
                </tr>
            <?php }?>
            </tbody>
<?php } ?>

<?php
/*7)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA devolverProduto.inc.php -  OK*/
function show_nav_devolver_produto(){ ?>
            <a title="Retornar a listagem das Compras" class="home" href="listarCompra.php">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            
            <a title="Voltar a pagina principal" id="home.inc" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
<?php } ?>

<?php
/*7.1)FUNÇÃO QUE MOSTRA FORMULARIO PARA DEVOLUÇÃO DO PRODUTO -  OK*/
function show_devolver_produto($horario_compra,$quantidade_compra,$produto,$fatura,$caixa,$quantidade_total){ ?>
    <main>


  <?php include("conexao.php");
        $sql = "SELECT produto.descricao,produto.unidade_medida_produto
        FROM produto
        WHERE cod_barra = '$produto'";
        $resultado = mysqli_query($ligacao,$sql);
        $registo=mysqli_fetch_assoc($resultado);
        if($registo){
            $produto_nome=$registo['descricao'];
            $unidade_medida=$registo['unidade_medida_produto'];

        } ?>
    <div class="wrapper-main">
    
    <section class="seccao_form">


        <img class="produto_cadastrar_img" src="includes/imgs/imagem_produtos_devolver.png">

        <h1>Devolver Produto
            "<?php echo $produto_nome; ?>"
        </h1>

        


        <hr class="linha_registrar">
            <?php
                    if(isset( $_SESSION['msg'])){       //Comando que checa se a variavel universal "msg" possui algum valor.
                        echo  $_SESSION['msg'];         //Se a variavel estiver com algum valor, imprimi na tela o mesmo.
                        unset( $_SESSION['msg']);       //limpa a variavel msg para mensagens posteriores
                    }
            ?>
        <br>

        <form class="formulario_inserir" action="includes/devolverProduto.inc.php" method="post">
            <div class="textaviso">
            <p>Como regulamento do hipermercado, o produto só pode ser devolvido num prazo maximo de 15 dias.</p>
            <p>Data de compra do produto: <?php echo date("d/m/Y", strtotime($horario_compra)); ?> </p>
            <?php if(strtotime($horario_compra) < strtotime('-15 days')){ ?>

                    <h2 style="color:red">O produto não pode ser devolvido</h2>
                    

            <?php }else if (strtotime($horario_compra) > strtotime('-15 days')){ ?>

                            <h2 style="color:green">O produto pode ser devolvido</h2>

                    
            </div>

            <input type="hidden" id="idproduto" name="idproduto" value="<?php echo $produto; ?>">

            <input type="hidden" id="idfatura" name="idfatura" value="<?php echo $fatura; ?>">

            <input type="hidden" id="idcaixa" name="idcaixa" value="<?php echo $caixa; ?>">

            <input type="hidden" id="idquantidadecompra" name="idquantidadecompra" value="<?php echo $quantidade_compra; ?>">

            <input type="hidden" id="idunidademedida" name="idunidademedida" value="<?php echo $unidade_medida; ?>">

            <input type="hidden" id="idquantidade_total" name="idquantidadetotal" value="<?php echo $quantidade_total; ?>">

            <label class="titulo_texts" >Motivo de devolução:  <span title="Breve texto com o motivo da devolução, falando sobre a satisfação do cliente com o produto.">*</span></label>

            <input class="caixa_input" type="text"  placeholder="Motivo de devolução" name="motivo_devolucao">
            <br>
            <br>
            <label class="titulo_texts" >Quantidade que deseja devolver:  <span title="Nome do produto que deseja cadastrar no mercado.">*</span></label>

            <input class="caixa_input" type="number" step="0.01" min="0" max="<?php echo $quantidade_compra; ?>"  value="<?php echo $quantidade_compra; ?>" name="quantidade_devolucao">
            <br>
            <br>




            <!--Check box se for necessario impletação posteriormente:
                <input type="checkbox" name="confirma_chegada" id="confirmar_chegada_valor" checked required> 
            <label class="confirma_text"for="confirmar_chegada_valor">Quero continuar com a deslocação.</label><br><br>-->

            <input type="hidden" id="seccaotipo" name="seccaotipo" value="">

            <button class="btnregistrar_chegada" type="submit" name="registrar_enviar">Registrar</button>

            <?php } ?>
        </form>

    </section>

    </div>

    </main>
<?php } ?>

<?php
/*8) FUNÇÃO QUE MOSTRA LISTA DE DEVOLUÇÕES  -  OK*/
function show_list_devolucao(){ ?>
            <thead>
                <tr>
                    <td>Fatura Correspondente</td>
                    <td>Produto Devolvido</td>
                    <td>Quantidade Devolvida</td>
                    <td>Motivo</td>
                    <td>Data de Devolução</td>
                </tr>
            </thead>
            <tbody>
            <br>
            <h1 align = 'center'>Devoluções</h1>
            <?php
            include("includes/conexao.php");
            $sql = "SELECT * FROM devolucao
            inner join fatura
            on devolucao.fatura_fk = fatura.id_fatura
            inner join produto
            on devolucao.produto_fk = produto.cod_barra";
            $resultado = $ligacao->query($sql) or die($ligacao->error);
            while($linha = $resultado->fetch_array()){ ?>
            
                <tr>
                <td><?php  echo $linha['fatura_fk'];?></td>
                <td><?php  echo $linha['descricao'];?></td>
                <td><?php  echo $linha['quantidade_devolucao'];
                           echo $linha['unidade_medida_produto'];?></td>
                <td><?php  echo $linha['satisfacao'];?></td>
                <td><?php  echo date("d/m/Y h:i:s A", strtotime($linha["data_devolucao"]));?></td>
                </tr>
            <?php }?>
            </tbody>
<?php } ?>

<?php
/*8.1) FUNÇÃO QUE MOSTRA NAVEGADOR DA PAGINA listardevolucao.php   -  OK*/
function show_nav_devolucao(){ ?>
            <a title="Voltar a pagina principal" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>

                <div class="logo">
                    <h4>Navegador</h4>
                </div>

                <div class="pesquisar_devolucao">
                    <div class="procurar-box">
                        <form method="POST" action="ProcurarProduto.php">
                            <input type="hidden" name="procurardevolucao" value="1">
                            <input class="procurar-txt_fornecedor" type="text" name="procurar" placeholder="Digite para pesquisar por uma fatura..."> 
                            <button class="procurar-btn">
                            <i class="fas fa-search fa-lg"></i>
                            </button>
                            </form>
                    </div>
                </div>

                <ul class="link_nave">
                    <li><a class="li_primario">Secção</a>
                        <ul class="sublink_nave">
                            <li><a href="listarSeccao.php">Listar</a></li>
                        </ul>
                    </li>

                    <li><a class="li_primario">Encomendas</a>
                        <ul class="sublink_nave">
                            <li><a href="listarEncomenda.php">Listar</a></li>
                            <li><a href="listarFornecedor.php">Fornecedor</a></li>
                        </ul>
                    </li>

                    <?php if(isset($_SESSION['permissao'])){ 
                            if ($_SESSION['permissao'] == "Gerente" or $_SESSION['permissao'] == "Administrador") { ?>

                    <li><a class="li_primario">Compras</a>
                        <ul class="sublink_nave">
                            <li><a href="listarCompra.php">Listar</a></li>
                        </ul>
                    </li>

                    <?php   } 
                          } ?>

                    <li><a class="li_primario">Produtos</a>
                        <ul class="sublink_nave">
                            <li><a href="catalogo.php">Catálogo</a></li>
                        </ul>
                    </li>
                </ul>
<?php } ?>

<?php
/*8.2)FUNÇÃO QUE MOSTRA NAVEGADOR DA PÁGINA cadastrar_produto.php -  OK*/
function show_nav_cadastrar_devolucao(){ ?>
            <a title="Retornar as devoluções" class="home" href="listarDevolucao.php">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            
            <a title="Voltar a pagina principal" id="home.inc" class="home" href="home.php">
                <i class="fas fa-home"></i>
            </a>
<?php }?>

<?php
/*8.3)FUNÇÃO QUE MOSTRA RESULTADO DA PESQUISA SOBRE COMPRA -  OK*/
function show_list_procurar_produto_devolucao($pesquisar) { ?>
            <thead>
                <tr>
                    <td>Fatura Correspondente</td>
                    <td>Produto Devolvido</td>
                    <td>Quantidade Devolvida</td>
                    <td>Motivo</td>
                    <td>Data de Devolução</td>
                    
                    
                </tr>
            </thead>
            <tbody>
            <br>
            <h1 align = 'center'>Resultados para '<?php echo $pesquisar; ?>'</h1>
            <?php
            include("includes/conexao.php");
            $sql = "SELECT * FROM devolucao
            inner join fatura
            on devolucao.fatura_fk = fatura.id_fatura
            inner join produto
            on devolucao.produto_fk = produto.cod_barra
            WHERE fatura_fk = '$pesquisar' or data_devolucao = '$pesquisar' or descricao = '$pesquisar'";
            $resultado = $ligacao->query($sql) or die($ligacao->error);
            while($linha = $resultado->fetch_array()){ ?>
            
                <tr>
                <td><?php  echo $linha['fatura_fk'];?></td>
                <td><?php  echo $linha['descricao'];?></td>

                <td><?php  echo $linha['quantidade_devolucao'];
                           echo $linha['unidade_medida_produto'];?></td>
                
                <td><?php  echo $linha['satisfacao'];?>
                </td>
                <td><?php  echo date("d/m/Y h:i:s A", strtotime($linha["data_devolucao"]));?></td>
                </tr>
            <?php }?>
            </tbody>
<?php } ?>

<?php
/*8)FUNÇÃO QUE DESLOCA PRODUTO ENTRE SECÇÕES -  OK*/
function deslocar_produto(){ ?>
    <?php
    include("conexao.php");    //Inclui o ficheiro com os processos padrões de conexão a base de dados
 
    $quantidade_atual = $_POST ['quantidadeatual'];
    $quantidade_deslocada = $_POST['quantidade_deslocada'];
    $seccao_deslocada =  $_POST['tipos_seccoes_form'];
    $seccao_origem = $_POST['idseccao'];
    $seccao_tipo_origem = $_POST['seccaotipo'];
    $produto = $_POST['idproduto'];
    $quantidade_final = $quantidade_atual - $quantidade_deslocada;



        if(!empty($quantidade_deslocada)){  


            //Atualiza quantidade atual na secção.
    $sql = "UPDATE deslocacao
            SET quantidade_deslocacao = '$quantidade_final'
            where deslocacao.produto_fk = '$produto' and deslocacao.seccao_fk = '$seccao_origem'";
            $resultado = mysqli_query($ligacao,$sql);



            //aréa que determina se ja existe um produto na secção a ser deslocada
        $sql = "SELECT * 
            from deslocacao
            where deslocacao.produto_fk = '$produto' and deslocacao.seccao_fk = '$seccao_deslocada'";
            $resultado = mysqli_query($ligacao,$sql);
            $registo=mysqli_fetch_assoc($resultado);
            if($registo){
                $quantidade_final_seccao = $registo['quantidade_deslocacao'] + $quantidade_deslocada;
                $sql = "UPDATE deslocacao
                        SET quantidade_deslocacao =  '$quantidade_final_seccao'
                        WHERE deslocacao.produto_fk = '$produto' AND deslocacao.seccao_fk = '$seccao_deslocada'";
                        $resultado = mysqli_query($ligacao,$sql);
                        $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Produto Deslocado com sucesso!</p>";
                        header("Location: ../listarSeccao.php");
                }// caso não exista este produto nessa secção
        else{   
                $sql="INSERT INTO deslocacao(produto_fk,seccao_fk,origem,quantidade_deslocacao) VALUES ('$produto','$seccao_deslocada','$seccao_tipo_origem','$quantidade_deslocada')";
                $resultado = mysqli_query($ligacao,$sql);
                $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Produto deslocado com sucesso!</p>";
                header("Location: ../listarSeccao.php");
        }          
 
                if(mysqli_affected_rows($ligacao)){             //Condição que verifica se a linha foi alterada
                    $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Produto deslocado com sucesso! <?php echo $seccao ?></p>";        
                    header("Location: ../listarSeccao.php");          
                    $resultado = mysqli_query($ligacao,$sql) or die($ligacao->error);
 
                }else{
                    $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'>Produto n?o foi deslocado com sucesso</p>";  //Se não foi alterada o sistema retorna uma mensagem de fracasso
                    header("Location: ../listarSeccao.php");
                }   
        }else{
            $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'>Necessario selecionar um produto</p>";      //id_apagar não foi atribuido
            header("Location: ../listarSeccao.php");
         } ?>
<?php   } ?>

<?php
/*9)FUNÇÃO QUE APAGAR PRODUTO DE UMA SECÇÃO -  OK*/
function apagar_produto(){
    
    session_start();                //Resume a sessão atual
    include ("conexao.php");    //Inclui o ficheiro com os processos padrões de conexão a base de dados
 
    $id = $_GET['id_apagar'];
    $id_seccao = $_GET['id_seccao'];
    $quantidade_atual = $_GET['id_quantidade_atual'];

    $sql = "SELECT quantidade_total
            from produto
            where cod_barra = '$id'";                    //Comando em SQL 
        $resultado = mysqli_query($ligacao,$sql);
        $registo=mysqli_fetch_assoc($resultado);
        if($registo){
            $quantidade_atual_total = $registo['quantidade_total'];
            $quantidade_atual_total_final =   $quantidade_atual_total - $quantidade_atual;
            $sql = "UPDATE produto
                    set quantidade_total = $quantidade_atual_total_final
                    WHERE cod_barra = '$id'";                    //Comando em SQL 
            $resultado = mysqli_query($ligacao,$sql) or die($ligacao->error);
        }
 
        if(!empty($id)){                                                          //se o id_apagar não foi atribuido, então o codigo termina e impõe o requisito de selecionar um aluno


            $sql = "DELETE FROM deslocacao WHERE produto_fk = '$id' and seccao_fk = '$id_seccao'";                    //Comando em SQL 
            $resultado = mysqli_query($ligacao,$sql) or die($ligacao->error);
            
            


 
                if(mysqli_affected_rows($ligacao)){             //Condição que verifica se a linha foi alterada
                    $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Produto apagado com sucesso</p>";        
                    header("Location: ../listarSeccao.php");          
                    $resultado = mysqli_query($ligacao,$sql) or die($ligacao->error);
 
                }else{
                    $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'>Produto não foi apagado com sucesso</p>";  //Se não foi alterada o sistema retorna uma mensagem de fracasso
                    header("Location: ../listarSeccao.php");
                }   
        }else{
            $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'>Necessario selecionar um produto</p>";      //id_apagar não foi atribuido
            header("Location: ../listarSeccao.php");
        }
} ?>


<?php
/*10)FUNÇÃO QUE MOSTRA FORMULARIO PARA REGISTRO DE NOVO UTILIZADOR NO LOGIN DATABASE - OK*/
function show_register_inputs() { 
    if( isset($_GET['email'])){  
        $email =  $_GET['email'];
    }if(isset($_GET['u_id']) ){
        $usuario = $_GET['u_id'];
    }
    ?>
    <main>
    <div class="wrapper-main">
    
    <section class="seccao_form">


        <img src="includes/imgs/icon_form.png">

        <h1>Registrar</h1>
        *  Campos obrigatorios
        <?php
        if (isset($_GET['error'])){
            if($_GET['error'] == "campo_vazio"){
                echo '<p class="error_registrar">Preencha todos os campos obrigatorios!</p>';
            }
            else if ($_GET['error'] == "email_username_invalido"){
                echo '<p class="error_registrar">Email e username inválidos!</p>';
            }
            else if ($_GET['error'] == "email_invalido"){
                echo '<p class="error_registrar">Email inválido!</p>';
            }
            else if ($_GET['error'] == "username_invalido"){
                echo '<p class="error_registrar">Username inválido!</p>';
            }
            else if ($_GET['error'] == "verificacao_palavrapasse"){
                echo '<p class="error_registrar">As senhas não combinam!</p>';
            }
            else if ($_GET['error'] == "username_existente"){
                echo '<p class="error_registrar">O nome de usuario ja existe!</p>';
            }
        }
        else if (isset($_GET["registrar"])){
            if ($_GET["registrar"] == "sucesso"){
            echo '<p class="sucesso_registrar">O cadastro foi realizado com sucesso!</p>';
            }
        }
        ?>
        <hr class="linha_registrar">

        <br>

        <form class="formulario_registrar" action="includes/registrar.inc.php" method="post">

            <label class="titulo_texts" ><span title="Utilizado para autenticação. Tamanho minimo de 5 caracteres, Tamanho maximo de 15 caracteres. Barra de espaço e Simbolos não são permitidos, Caracteres permitidos: a-z A-Z 0-9">Nome de utilizador: *</span></label>

            <input class="caixa_input" type="text" name="utilizador_id" placeholder="Utilizador" pattern=".{5,15}" value="<?php if(isset($usuario)){ echo $usuario;} ?>">
            <br>
            <label class="titulo_texts" ><span title="Utilizado para autenticação."Nome do email: <span title="Utilizado para autenticação.">*</span></label>

            <input class="caixa_input" type="text" name="email_utilizador_id" placeholder="exemplo@mail.com" value="<?php if(isset($email)){ echo $email;} ?>">

            <label class="titulo_texts" title="Introduza"><span title="Tamanho mínimo de 5 caracteres. Simbolos são permitidos, Caracteres permitidos: a-z A-Z 0-9">Senha: *</span></label>

            <input class="caixa_input" type="password" name="palavrapasse_utilizador_id" placeholder="Palavra passe" pattern=".{5,100}">

            <label class="titulo_texts" title="Introduza"><span title="Repitir a senha">Confirme a senha: *</span></label>

            <input class="caixa_input" type="password" name="palavrapasse_utilizador_id-repetir" placeholder="Repita a Palavra passe" pattern=".{5,100}" ><br>

            <button class="btnregistrar" type="submit" name="registrar_enviar">Registrar</button>

            <p>Você possui uma conta? <a href="index.php">Efetuar login</a></p>

        </form>

    </section>

    </div>

    </main>

<?php }?>

<?php
/*=========LISTA DE FUNÇÕES JAVASCRIPT========*/?>
<script>

    //function desloca_armazem(id){
    //    var 
    //}

    //função que apaga produto de uma secção
    function conf_apag(id,id_seccao,quantidade_atual)
        {
            var r=confirm("Tem certeza que deseja apagar esses dados?");        //cria um "alert" com duas opções confirmar ou cancelar
            if (r==true)
            {
                window.location.href= 'includes/apagarProduto.php?id_apagar='+id+'&id_seccao='+id_seccao+'&id_quantidade_atual='+quantidade_atual+''; //caso o utilizador confirme, redireciona para a função de apagar a linha selecionada com o id especifico
            }
                else
                {   
                    ans = "<p style='color:red;'>Apagamento Cancelado</p>";  //caso o utilizador cancele, retorna uma mensagem explicando o fracasso e atribui na variavel ans
                }
        document.getElementById("error").innerHTML=ans      //atribui na mensagem de error a resposta do cancelamento
        }


        //função que apaga produto do catalogo
        function conf_apag_id_unico(id)
        {
            var r=confirm("Tem certeza que deseja apagar esses dados?");        //cria um "alert" com duas opções confirmar ou cancelar
            if (r==true)
            {
                window.location.href= 'includes/apagarProduto_id_unico.php?id_apagar='+id+''; //caso o utilizador confirme, redireciona para a função de apagar a linha selecionada com o id especifico
            }
                else
                {   
                    ans = "<p style='color:red;'>Apagamento Cancelado</p>";  //caso o utilizador cancele, retorna uma mensagem explicando o fracasso e atribui na variavel ans
                }
        document.getElementById("error").innerHTML=ans      //atribui na mensagem de error a resposta do cancelamento
        }



        //função que trata do apagamento de dados em associações (com PK conjunta)
        function conf_apag_duploid(id,iddois,pagina)
        {   var pagina = pagina 
           if (pagina == "encomenda") {
            var r=confirm("Tem certeza que deseja apagar esses dados da encomenda?");        //cria um "alert" com duas opções confirmar ou cancelar
            if (r==true)
            {
                window.location.href= 'includes/apagarProduto_idduplo.php?id_apagar='+id+'&id_produto='+iddois+'+&pagina='+pagina+''; //caso o utilizador confirme, redireciona para a função de apagar a linha selecionada com o id especifico
            }
            }    else
                {   
                    ans = "<p style='color:red;'>Apagamento Cancelado</p>";  //caso o utilizador cancele, retorna uma mensagem explicando o fracasso e atribui na variavel ans
                }
                if (pagina == "fornecedor") {
            var r=confirm("Tem certeza que deseja apagar o produto do fornecedor?");        //cria um "alert" com duas opções confirmar ou cancelar
            if (r==true)
            {
                window.location.href= 'includes/apagarProduto_idduplo.php?id_apagar='+id+'&id_produto='+iddois+'+&pagina='+pagina+''; //caso o utilizador confirme, redireciona para a função de apagar a linha selecionada com o id especifico
            }
            }    else
                {   
                    ans = "<p style='color:red;'>Apagamento Cancelado</p>";  //caso o utilizador cancele, retorna uma mensagem explicando o fracasso e atribui na variavel ans
                }
        document.getElementById("error").innerHTML=ans      //atribui na mensagem de error a resposta do cancelamento
        }


        //função que redireciona o utilizador para gerir permissões
        function gerirPermissao(id){
            window.location.href= 'includes/redefinirPermissao.php?id_utilizador='+id+'';
        }




        //Função que desloca de uma prateleira para outra
        function desloca_prateleira(id_produto,id_seccao){
        var prateleira
        
            prateleira = prompt ("Deslocar para qual prateleira? max 20");
        
        
        if(prateleira < 20){
            window.location.href= 'includes/deslocPrateleira.inc.php?id_produto='+id_produto+'&id_seccao='+id_seccao+'&id_prateleira='+ prateleira+'';
        }else{
                alert ("Deslocamento cancelado");
        }
        }
        //função que trata das colunas editadas em tabela de chave unica
        function updateValor(elemento,coluna,id){
            var valor_virgula = elemento.innerText
            var valor = valor_virgula.toString().replace(",", ".");
            console.log(valor+coluna+id);
            $(elemento).attr('class','processando');
            $.ajax({
                url:'includes/editar_valor.php',
                type: 'post',
                data:{
                    value: valor,
                    column: coluna,
                    id: id
                },
                success:function(php_result){
                    $(elemento).removeAttr('class');
                    console.log(php_result);
                }
            })

        }
        //função que trata das colunas editadas em tabela de chave composta
        function updateValor_duploid(elemento,coluna,id,id_dois,pagina){
            var valor_virgula = elemento.innerText
            var valor = valor_virgula.toString().replace(",", ".");
            console.log(valor+coluna+id+id_dois);
            $(elemento).attr('class','processando');
            $.ajax({
                url:'includes/editar_valor_duploid.php',
                type: 'post',
                data:{
                    value: valor,
                    column: coluna,
                    id: id,
                    id_dois: id_dois,
                    pagina: pagina
                },
                success:function(php_result){
                    $(elemento).removeAttr('class');
                    console.log(php_result);
                }
            })
        }
                //função que trata das colunas editadas em tabela de chave composta
                function updateValor_triploid(elemento,coluna,id,id_dois,id_tres,pagina){
            var valor_virgula = elemento.innerText
            var valor = valor_virgula.toString().replace(",", ".");
            console.log(valor+coluna+id+id_dois+id_tres+pagina);
            $(elemento).attr('class','processando');
            $.ajax({
                url:'includes/editar_valor_triploid.php',
                type: 'post',
                data:{
                    value: valor,
                    column: coluna,
                    id: id,
                    id_dois: id_dois,
                    id_tres: id_tres,
                    pagina: pagina
                },
                success:function(php_result){
                    $(elemento).removeAttr('class');
                    console.log(php_result);
                }
            })
        }
        //função para estilizar os conteteditable ativar corresponde a fase de selecionar o campo
        function ativar(elemento){
            $(elemento).attr('class','ativar')
        }

        //função para estilizar os conteteditable ativar corresponde a fase de selecionar o campo
        function desativar(elemento){
            $(elemento).removeAttr('class','ativar');
            $(elemento).attr('class','td_dinamica_fornecedor');
        
        }



<?php for($i=1;$i<=$n_seccoes;$i++){?>
    //função que permite abrir a listagem relacionada ao seu respectivo botão
    $(document).ready(function(){
        $("#exibir_listagembtn<?php echo $i;?>").click(function(){
        $("#lista_tudo<?php echo $i;?>").slideToggle(100);
        });
        

    });


<?php } ?>
$(document).ready(function(e){
    //variaveis 
    var i = 0;
    var html = '<p /> <div><label class="titulo_texts" >Produto numero: '+ i + ' </label></div>';
    var maxOpcoes = 4;

   

    //Remover linhas do formulario
    $("#area_cadastro_encomenda").on('click','#remover', function(e) {
        if(i > 0){
            var r=confirm("Tem certeza que deseja apagar esses dados?");        //cria um "alert" com duas opções confirmar ou cancelar
                            if (r==true){
        $(this).parent('div').parent().remove();
        i--;}
        }


    });


    //comando multiplicar forms 
    
    $('#adicionar').click(function(e){
        i++;
        if(i > 0){
        $("#remover").show();
        
    }
        var f = $(this).parent().parent(),
            c = f.clone(true,true);
        c.insertAfter(f);
        
        

    });
    //Comando que mostra a explicação da edição das colunas
    $("#btn_editar_explicacao").click(function(){
        $("#texto_editar").slideToggle(100);
        
        });

    
        //comando que disponibiliza os produtos por fornecedor
        //drop down dinamico
    $('#select_fonecedor_encomenda').on('change',function(){
  
        var fornecedorID = $(this).val();
        if(fornecedorID){
            $.ajax({
                type:'POST',
                url:'includes/fornecedor_produto.inc.php',
                data:'fornecedor_id='+fornecedorID,
                success:function(html){
                    $('#select_produto_encomenda').html(html);
                }
            }); 
        }else{
            $('#select_produto_encomenda').html('<option value="">Selecione Fornecedor Primeiro!</option>');
        }
    });




    <?php for($i=1;$i<=100;$i++){?>


        //atualiza tabelas com novos valores 

    //função que permite adicionar dinamicamente novos valores a tabela
    $(document).on('click', '#btn_add<?php echo $i; ?>', function(){  
        
        var nome_produto = $('#nome_produto_fornecedor<?php echo $i; ?>').val();
        var preco_produto_virgula = $('#preco_produto<?php echo $i; ?>').text(); 
        var preco_produto = preco_produto_virgula.toString().replace(",", ".");  
        var peso_produto_virgula = $('#peso_produto<?php echo $i; ?>').text();
        var peso_produto = peso_produto_virgula.toString().replace(",", "."); 
        var unidade_medida_fornecedor = $('#unidade_medida_fornecedor<?php echo $i; ?>').text();  
        var id_fornecedor = <?php echo $i ?>;
        if(nome_produto == '')  
        {  
            alert("Introduza o nome do produto!");  
            return false;  
        }  
        if(preco_produto == '')  
        {  
            alert("Introduza o peso do produto!");  
            return false;  
        }  
        if(peso_produto == '')  
        {  
            alert("Introduza o preço do produto!");  
            return false;  
        } 

        $.ajax({  
            url:'includes/inserir_produtos_fornecedor.inc.php',  
            method:'post',  
            data:{
                nome_produto:nome_produto,
                preco_produto:preco_produto,
                peso_produto:peso_produto,
                unidade_medida_fornecedor:unidade_medida_fornecedor,
                id_fornecedor:id_fornecedor},
                 
            success:function(data)  
            {  
            
                alert("Produto adicionado com sucesso!");
                //$('#lista_tudo<?php echo $i; ?>').DataTable().ajax.reload();
                location.reload();
                //$("#lista_tudo<?php //echo $i; ?>").load("../listarFornecedor.php #lista_tudo<?php //echo $i; ?>");


            }  
        })  
    }); 

    //comando que disponibiliza a tabela de preço sugerida para cada produto do fornecedor
    $('#nome_produto_fornecedor<?php echo $i; ?>').on('change',function(){
  
  var descricao_produto = $(this).val();
  if(descricao_produto){
      $.ajax({
          type:'POST',
          url:'includes/indicarValorProduto.inc.php',
          data:'descricao_produto='+descricao_produto,
          success:function(html){
              $('#preco_produto<?php echo $i; ?>').html(html);
          }
      }); 
  

      $.ajax({
          type:'POST',
          url:'includes/indicarPesoProduto.inc.php',
          data:'descricao_produto='+descricao_produto,
          success:function(html){
              $('#peso_produto<?php echo $i; ?>').html(html);
          }
      }); 
  

      $.ajax({
          type:'POST',
          url:'includes/indicarUnidadeProduto.inc.php',
          data:'descricao_produto='+descricao_produto,
          success:function(html){
              $('#unidade_medida_fornecedor<?php echo $i; ?>').html(html);
          }
      }); 
  }
});    


    $(function() {
    $('#peso_produto<?php echo $i; ?>').maskMoney({ decimal: '.', thousands: '', precision: 2 });
    })

    $(function() {
    $('#preco_produto<?php echo $i; ?>').maskMoney({ decimal: '.', thousands: '', precision: 2 });
    })
<?php } ?>
    

});


    //Comando para aceitar valores com virgula em type numbers
    $(function() {
    $('#Preco').maskMoney({ decimal: '.', thousands: '', precision: 2 });
    })

    $(function() {
    $('#quantidade_encomenda').maskMoney({ decimal: '.', thousands: '', precision: 2 });
    })




    

</script>




<?php
/*=============LISTA DE QUERYS=============*/
/*QUERY QUE SELECIONA  TODOS PRODUTOS
function query_select_catalog(){
            include("includes/conexao.php");
            $sql = "SELECT * FROM produto";
            $resultado = $ligacao->query($sql) or die($ligacao->error);

            return $resultado;
}?>*/