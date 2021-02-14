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

$sql= "SELECT max(cod_barra) as 'idatual'
       from produto";
$resultado = mysqli_query($ligacao,$sql);
$registo=mysqli_fetch_assoc($resultado);
if($registo){
    $cod_barra_atual= $registo['idatual']+1;
}else{$cod_barra_atual=1;}
?>
<html>

<head>
<title>Cadastrar Produto</title>
    <meta charset = 'ISO-8859-1'>
    <link rel="stylesheet" href="includes/css/styleListar.css">
    <link rel="icon" href="includes/imgs/icon_pag.png">
</head>

<body>
    <nav class="nav.inc">
    <?php show_nav_cadastrar_produto(); ?>
    </nav>



    <?php show_cadastrar_produto($cod_barra_atual); ?>
</body>

</html>