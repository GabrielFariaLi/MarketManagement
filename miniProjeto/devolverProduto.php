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

$produto = $_GET['idproduto'];
$fatura = $_GET['idfatura'];
$caixa = $_GET['idcaixa'];


$sql = "SELECT data_fatura,quantidade_compra,quantidade_total
        FROM `compra`
        inner join fatura
        on compra.fatura_fk = fatura.id_fatura
        inner join produto
        on compra.produto_fk = produto.cod_barra
        WHERE produto_fk = '$produto' and caixa_fk = '$caixa' and fatura_fk= '$fatura'";
$resultado = mysqli_query($ligacao,$sql);
$registo=mysqli_fetch_assoc($resultado);
if($registo){
    $horario_compra=$registo['data_fatura'];
    $quantidade_compra=$registo['quantidade_compra'];
    $quantidade_total = $registo['quantidade_total'];
}
?>
<html>

<head>
<title>Devolver Produto</title>
    <meta charset = 'ISO-8859-1'>
    <link rel="stylesheet" href="includes/css/styleListar.css">
    <link rel="icon" href="includes/imgs/icon_pag.png">
</head>

<body>
    <nav class="nav.inc">
    <?php show_nav_devolver_produto(); ?>
    </nav>



    <?php show_devolver_produto($horario_compra,$quantidade_compra,$produto,$fatura,$caixa,$quantidade_total); ?>
</body>

</html>