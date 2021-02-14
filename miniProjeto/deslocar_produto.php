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
$seccao_deslocar = $_GET['idseccao'];

$sql= "SELECT quantidade_deslocacao,seccao.tipo,unidade_medida_produto,produto.descricao
       from deslocacao
       inner join seccao
       on seccao.id_seccao = deslocacao.seccao_fk
       inner join produto
       on deslocacao.produto_fk = produto.cod_barra
       where produto_fk = '$produto' and seccao_fk = '$seccao_deslocar'";
$resultado = mysqli_query($ligacao,$sql);
$registo=mysqli_fetch_assoc($resultado);
if($registo){
    $quantidade_produto_total = $registo['quantidade_deslocacao'];
    $tipo_seccao = $registo['tipo'];
    $unidade_medida = $registo['unidade_medida_produto'];
    $descricao = $registo['descricao'];
}


?>
<html>

<head>
<title>Deslocar Produto</title>
    <meta charset = 'ISO-8859-1'>
    <link rel="stylesheet" href="includes/css/styleListar.css">
    <link rel="icon" href="includes/imgs/icon_pag.png">
</head>

<body>
    <nav class="nav.inc">
    <?php show_nav_deslocar_produto(); ?>
    </nav>

    <?php show_deslocar_produto($produto,$seccao_deslocar,$quantidade_produto_total,$unidade_medida,$tipo_seccao,$descricao); ?>
</body>

</html>