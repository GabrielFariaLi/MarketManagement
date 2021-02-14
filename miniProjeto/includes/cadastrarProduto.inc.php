<?php
session_start();
include("conexao.php");
date_default_timezone_set('Europe/Lisbon');
$produto = $_POST['nome_produto'];
$preco_produto = $_POST['preco_produto'];
$peso_produto = $_POST['peso_produto'];
$unidade_medida = $_POST['unidade_medida_produto'];

echo $produto;
echo "<br>";
echo $peso_produto;
echo "<br>";
echo $unidade_medida;
echo "<br>";


$sql = "SELECT * 
        from produto
        where descricao = '$produto';";
$resultado = mysqli_query($ligacao,$sql);
$registo=mysqli_fetch_assoc($resultado);
if(!$registo){
$sql = "INSERT INTO produto(descricao,preco_unitario,peso,unidade_medida_produto) VALUES ('$produto','$preco_produto','$peso_produto','$unidade_medida')";
        $resultado = mysqli_query($ligacao,$sql);
        header("location: ../catalogo.php");
}
else{
        $_SESSION['msg'] = "<p class='aviso_vermelho'  style='color:red;text-align: center;font-size: 16px;'><font size='6'>Produto ja cadastrado!</font></p>";
        header("location: ../CadastrarProduto.php");
}

?>