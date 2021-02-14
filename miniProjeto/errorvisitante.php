<?php
    session_start();
    session_unset();  //checar
    session_destroy();
    header("Content-Type: text/html; charset=ISO-8859-1",true);
?>

<html>
    <head>
        <title>Uh oh!</title>
        <meta charset = 'ISO-8859-1'>
        <link rel="stylesheet" href="includes/css/style.css">
        
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        <link rel="icon" href="includes/imgs/icon_pag.png">
    </head>
        <body>
            <br>
            <br>
    
        <div class="avisovisitante"><div class="avisotext">Parece que você ainda não tem permissão para acessar nosso sistema. Aguarde a atitude de um administrador.


        Clique <a class="linklogin" href="index.php">aqui</a> para retornar ao login</div></div>
            
        </body>
</html>