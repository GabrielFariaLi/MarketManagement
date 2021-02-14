
<?php
session_start();        //Resume a sessï¿½o atual
include 'includes/funcoes.php';

    //Verifica se o utilizador n�o tem permiss�o para acessar o sistema.
    if(isset($_SESSION['permissao']) or !isset($_SESSION['utilizador_ID'])){
        if($_SESSION['permissao'] == "Visitante" or !isset($_SESSION['utilizador_ID'])){
            header("location:errorvisitante.php");
            exit;

        }
    }
?>

<html>

    <head>
    <title>Log Devolu��o</title>
        <meta charset = 'ISO-8859-1'>
        <link rel="stylesheet" href="includes/css/styleListar.css">
        <link rel="icon" href="includes/imgs/icon_pag.png">
    </head>

    <body>
        <nav>
        <?php show_nav_devolucao(); ?>
        </nav>
        <table class = "conteudo_tabela">
        <?php show_list_devolucao(); ?>
        </table>
    </body>

</html>