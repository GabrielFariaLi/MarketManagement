<!DOCTYPE html>
<?php
session_start();
include ("includes/conexao.php");
include 'includes/funcoes.php';

    //Verifica se o utilizador não tem permissão para acessar o sistema.
    if(isset($_SESSION['permissao']) or !isset($_SESSION['utilizador_ID'])){
        if($_SESSION['permissao'] == "Visitante" or !isset($_SESSION['utilizador_ID'])){
            header("location:errorvisitante.php");
            exit;

        }
    }
?>

<html>

    <head>
    <title>Fornecedores</title>
        <meta charset = 'ISO-8859-1'>
        <link rel="stylesheet" href="includes/css/styleListar.css">
        <link rel="icon" href="includes/imgs/icon_pag.png">
    </head>

    <body>
        <nav>
        <?php show_nav_fornecedor(); ?>
        </nav>
        <br>
        <?php if($_SESSION['permissao'] == "Administrador" or $_SESSION['permissao'] == "Gerente"){ ?>
            <button id="btn_editar_explicacao" class="aviso_btn">
                <i  class="far fa-edit"  ></i><i style="font-size: 14px;" class="fas fa-question"></i>
            </button>
            <br>
            <br>
            <div id="texto_editar" class="bolha_txt">
            <div class="aviso_editar" >
            <p style="margin-left: 10px; margin-top: 10px;">O "Preço pelo peso" e "Peso do produto" são colunas editaveis quando selecionadas,quando des-<br>elecionadas são armazenados na base de dados</p>
            </div>
            </div>
        <?php } ?>
            <br>
            <h1 align="center">Fornecedor</h1>
            <br>



                <?php
                    if(isset( $_SESSION['msg'])){       //Comando que checa se a variavel universal "msg" possui algum valor.
                        echo  $_SESSION['msg'];         //Se a variavel estiver com algum valor, imprimi na tela o mesmo.
                        unset( $_SESSION['msg']);       //limpa a variavel msg para mensagens posteriores
                    }
                ?>
                <p id="error"></p>
                

            <table>
                
                <?php
                $custo_total = 0;
                $i =1;
                             $sql ="SELECT *
                             FROM fornecedor
                             left join catalogo_fornecedor
                             on catalogo_fornecedor.fornecedor_fk = fornecedor.ID_fornecedor
                             left join produto
                             on produto.cod_barra = catalogo_fornecedor.produto_fk
                             group by ID_fornecedor asc";            //comando em SQL utilizado para listagem das colunas
                $resultado = $ligacao->query($sql) or die($ligacao->error); // coloca na variavel "resultado" a query da variavel ligaï¿½ï¿½o
                while($linha = $resultado->fetch_array()){ 
                    
                    $id_fornecedor = $linha['ID_fornecedor'];
                    $nome_fornecedor = $linha['nome_fornecedor'];
                    $contacto_fornecedor = $linha['contacto'];
                    $email_fornecedor = $linha['email'];
                    $localidade_fornecedor = $linha['localidade'];

                    show_button_fornecedor($id_fornecedor,$i,$nome_fornecedor,$email_fornecedor,$localidade_fornecedor,$contacto_fornecedor);
                ?>

  <table id="lista_tudo<?php echo $i; ?>" class="conteudo_tabela_seccoes">
  <?php
  show_list_fornecedores($id_fornecedor,$i); 
  ?>
  </table>

<br>
<br>
<br>

                <?php $i++; } ?>
                 
            </table>           
    </body>

</html>