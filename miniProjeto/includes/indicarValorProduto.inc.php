<?php
session_start();
include("conexao.php");
date_default_timezone_set('Europe/Lisbon');
$descricao_produto= $_POST['descricao_produto'];

$sql = "SELECT *
        FROM produto
        WHERE descricao = '$descricao_produto'";
$resultado = mysqli_query($ligacao,$sql);
$registo=mysqli_fetch_assoc($resultado);
if($registo){
    $preco_produto=$registo['preco_unitario'];
    $peso_produto=$registo['peso'];
    $unidade_medida_produto=$registo['unidade_medida_produto'];
    
}

echo $preco_produto;
?>