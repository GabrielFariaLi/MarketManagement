<?php
session_start();
include ("includes/conexao.php");
include 'includes/funcoes.php';
date_default_timezone_set("Europe/Lisbon");

    //Verifica se o utilizador não tem permissão para acessar o sistema.
    if(isset($_SESSION['permissao']) or !isset($_SESSION['utilizador_ID'])){
        if($_SESSION['permissao'] == "Visitante" or !isset($_SESSION['utilizador_ID'])){
            header("location:errorvisitante.php");
            exit;

        }
    }

$id_tabela = $_GET['idtabela'];

?>

<html>

    <head>
    <title>Registrar Chegada</title>
        <meta charset = 'ISO-8859-1'>
        <link rel="stylesheet" href="includes/css/styleListar.css">
        <link rel="icon" href="includes/imgs/icon_pag.png">
    </head>

    <body>
        <nav class="nav.inc">
        <?php show_nav_registrar_chegada(); ?>
        </nav>

        <?php show_registrar_chegada($id_tabela); ?>
    </body>

</html>