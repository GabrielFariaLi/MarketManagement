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
<title>Cadastrar Fornecedor</title>
    <meta charset = 'ISO-8859-1'>
    <link rel="stylesheet" href="includes/css/styleListar.css">
    <link rel="icon" href="includes/imgs/icon_pag.png">
</head>

<body>
    <nav class="nav.inc">
    <?php show_nav_cadastrar_fornecedor(); ?>
    </nav>



    <?php show_cadastrar_fornecedor(); ?>
</body>

</html>