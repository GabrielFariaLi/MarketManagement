<?php 
session_start();

include 'includes/funcoes.php';
include ("includes/conexao.php");

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
<title>Gerir Permissão</title>
    <meta charset = 'ISO-8859-1'>
    <link rel="stylesheet" href="includes/css/styleListar.css">
    <link rel="stylesheet" href="includes/css/styleRegistrar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="icon" href="includes/imgs/icon_pag.png">
</head>

<body>
    <nav class="nav.inc">
    <?php show_nav_gerir_permissao(); ?>
    </nav>



    <?php show_list_utilizador(); ?>
</body>

</html>