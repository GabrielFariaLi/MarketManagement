
<?php
include ("includes/conexao.php");
include "includes/funcoes.php";
?>
<html>
<head>
<title>Login Formulario</title>
<link rel="stylesheet" href="includes/css/styleLogin.css">
<link rel="icon" href="includes/imgs/icon_pag.png">
</head>
<body>
<div class="login-form">
        
        <img src="includes/imgs/redefinirSenha.png">
            <h1>Redefinir Senha</h1>
        <?php
            if (isset($_GET["redefinir"])){
                if ($_GET["redefinir"] == "sucesso"){
                echo '<p class="sucesso_registrar">Cheque o seu email!</p>';
                }
            }

        ?>
            <hr>
        <br>
        <form class="formulario_logar" action="includes/redefinirSenha.inc.php" method="POST">
        
        <input type="text" class="caixa-input" name="email_id" placeholder="Introduza seu email...">
        
        <button type="submit" class="loginbtn_index" name="redefinir_senha_enviar">Receber nova senha por email!</button>
        <hr>
        <p class="or">OU</p>
        <p>Voltar para aréa de login?<a href="index.php">Clique aqui</a></p>
        </form>
    </div>
</body>