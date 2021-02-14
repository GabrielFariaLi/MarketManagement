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
    <title>Encomendas</title>
        <meta charset = 'ISO-8859-1'>
        <link rel="stylesheet" href="includes/css/styleListar.css">
        <link rel="icon" href="includes/imgs/icon_pag.png">
    </head>

    <body>
        <nav>
        <?php show_nav_encomendas(); ?>
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
                <p style="margin-left: 10px; margin-top: 10px;">As colunas "Quantidade" e "Custo Produto" são editaveis em encomendas que não foram  entre-<br>gues e assim que inseridas são armazenadas pela base de dados.</p>
                </div>
                </div>
            <?php } ?>
            <br>
            <h1 align="center">Encomendas</h1>
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
                             FROM encomenda
                             inner join solicitacao
                             on encomenda.id_encomenda = solicitacao.encomenda_fk
                             inner join fornecedor
                             on solicitacao.fornecedor_fk = fornecedor.id_fornecedor
                             group by id_encomenda desc";            //comando em SQL utilizado para listagem das colunas
                $resultado = $ligacao->query($sql) or die($ligacao->error); // coloca na variavel "resultado" a query da variavel ligaï¿½ï¿½o
                while($linha = $resultado->fetch_array()){ 
                    
                    $id = $linha['ID_encomenda'];
                    $datasoli = $linha['data_encomenda'];
                    $data_chegada = $linha['data_chegada'];
                    $fornecedor = $linha['nome_fornecedor'];

                    show_button_encomenda($id,$i,$datasoli,$data_chegada,$fornecedor);
                ?>

  <table id="lista_tudo<?php echo $i; ?>" class="conteudo_tabela_seccoes">
  <?php
  show_list_encomendas($id,$custo_total,$data_chegada); 
  ?>
  </table>

<br>
<br>
<br>

                <?php $i++; } ?>
                 
            </table>           
    </body>

</html>