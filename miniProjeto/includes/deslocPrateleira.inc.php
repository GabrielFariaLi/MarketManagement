<?php
session_start();
include ("conexao.php");
include "funcoes.php";

$produto= $_GET['id_produto'];
$seccao= $_GET['id_seccao'];
$prateleira= $_GET['id_prateleira'];

$sql="UPDATE deslocacao
set prateleira = $prateleira
where produto_fk = '$produto' and seccao_fk = '$seccao'";
$resultado = mysqli_query($ligacao,$sql);
$_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Deslocação realizada com sucesso!</p>";  
header("location: ../listarSeccao.php");

?>