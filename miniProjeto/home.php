<?php
    session_start();
    include 'includes/funcoes.php';

    //Verifica se o utilizador não tem permissão para acessar o sistema.
    if(isset($_SESSION['permissao']) or !isset($_SESSION['utilizador_ID'])){
        if($_SESSION['permissao'] == "Visitante" or !isset($_SESSION['utilizador_ID'])){
            header("location:errorvisitante.php");
            exit;

        }
    }
    //Carrega a pagina, se o usuario estiver autenticado
    if (isset($_SESSION['utilizador_ID'])){
        

        $nome_usuario = $_SESSION['username_utlizador'];
?>

<html>
    <head>
        <title>HomePage Hipermercado</title>
        <meta charset = 'ISO-8859-1'>
        <link rel="stylesheet" href="includes/css/style.css">
        <link rel="icon" href="includes/imgs/icon_pag.png">
        
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
        
    </head>
        <body>
            
            <nav>
            <?php 
            show_nav_home(); 
            ?>      
            </nav>

        <?php   //Condição que retorna a mensagem de sucesso ao login
                if(isset($_GET["login"])){
                    if ($_GET["login"] == "sucesso"){
                        echo '<br><br><p class="sucesso_registrar">O login foi realizado com sucesso!</p>';
                    } 
                }
        show_marketmanagement_card($nome_usuario);
        show_card_menu(); 
        ?>

            <script src="app.js"></script>
            
        </body>
</html>
<?php
}else{
    header("location:errorvisitante.php");
    exit;
}
?>