<!DOCTYPE html>
<?php
session_start();        //Resume a sessï¿½o atual
include ("includes/conexao.php"); //Inclui o ficheiro com os processos padr?es de conex?o a base de dados
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
    <title>Compras</title>
        <meta charset = 'ISO-8859-1'>
        <link rel="stylesheet" href="includes/css/styleListar.css">
        <link rel="icon" href="includes/imgs/icon_pag.png">
        
    </head>

    <body>

        <nav class="Compra_nav">
        <?php show_nav_compras(); ?>
        </nav>
        <br>
            <h1 align="center">Compras</h1>
        <br>

        <?php
                    if(isset( $_SESSION['msg'])){       //Comando que checa se a variavel universal "msg" possui algum valor.
                        echo  $_SESSION['msg'];         //Se a variavel estiver com algum valor, imprimi na tela o mesmo.
                        unset( $_SESSION['msg']);       //limpa a variavel msg para mensagens posteriores
                    }
                ?>


        <?php     $sql = "DELETE FROM compra
            WHERE compra.quantidade_compra = 0";
            $resultado = mysqli_query($ligacao,$sql); ?>

                <table>
                <?php
                $custo_total = 0;
                $i =1;

                    $sql ="SELECT *
                    FROM fatura
                    inner join compra
                    on fatura.id_fatura = compra.fatura_fk
                    group by id_fatura desc";            //comando em SQL utilizado para listagem das colunas
                $resultado = $ligacao->query($sql) or die($ligacao->error); // coloca na variavel "resultado" a query da variavel ligaï¿½ï¿½o
                while($linha = $resultado->fetch_array()){ 
                    
                    $id = $linha['ID_fatura'];
                    $data_fatura = $linha['data_fatura'];
                    $id_caixa = $linha['caixa_fk'];
                    $tipo_pagamento = $linha['tipo_pagamento'];
                    show_button_recibo($id,$i,$data_fatura,$id_caixa,$tipo_pagamento);
                ?>

  <table id="lista_tudo<?php echo $i; ?>" class="conteudo_tabela_seccoes">
  <?php
  show_list_compras($id,$custo_total); 
  ?>
  </table>

<br>
<br>
<br>

                <?php $i++; } ?>

        </table>
                    
    </body>
</html>