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
<title>Cadastrar Encomenda</title>
    <meta charset = 'ISO-8859-1'>
    <link rel="stylesheet" href="includes/css/styleListar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="icon" href="includes/imgs/icon_pag.png">
</head>

<body>
    <nav class="nav.inc">
    <?php show_nav_cadastrar_encomenda(); ?>
    </nav>



    <?php show_cadastrar_encomenda(); ?>
</body>

</html>