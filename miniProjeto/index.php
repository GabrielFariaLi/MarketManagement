<?php
    header("Content-Type: text/html; charset=ISO-8859-1",true);
    //session_start();
    include 'includes/funcoes.php';
    if(isset($_SESSION['utilizador_ID'])){
    require "home.php";
    }
?>
<html>
<head>
<title>Login Formulario</title>
<link rel="stylesheet" href="includes/css/styleLogin.css">
<link rel="icon" href="includes/imgs/icon_pag.png">
</head>
    <body>
        <?php show_index(); ?>
    </body>
