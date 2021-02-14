
<?php
include ("includes/conexao.php");
include "includes/funcoes.php";

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
<title>Redefinir Senha</title>
<link rel="stylesheet" href="includes/css/styleLogin.css">
<link rel="icon" href="includes/imgs/icon_pag.png">
</head>
<body>
<div class="login-form">
        
        <img src="includes/imgs/redefinirSenha.png">
            <h1>Redefinir Senha</h1>
        <?php

            $selecionar = $_GET["selecionar"];
            $validador = $_GET["validador"];
        
            if(empty($selecionar) or empty($validador)){
                echo "Não podemos validar a requisição de nova senha!";
            } else{
                if(ctype_xdigit($selecionar) !== false && ctype_xdigit($validador) !== false) {
                 ?>       

                    <form class="formulario_logar" action="includes/criar_nova_senha.inc.php" method="POST">
                    
                    <input type="hidden" name="selecionar" value="<?php echo $selecionar; ?>">
                    <input type="hidden" name="validador" value="<?php echo $validador; ?>">

                    <input type="password" class="caixa-input" name="nova_senha" placeholder="Introduza sua nova senha...">
                    <input type="password" class="caixa-input" name="nova_senha_confirma" placeholder="Repita sua nova senha...">
                    
                    <button type="submit" class="loginbtn_index" name="criar_nova_senha_submit">Redefinir Senha</button>
                    <hr>
                    </form>

                <?php
                }
            }
        ?>

    </div>
</body>