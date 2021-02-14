<?php 

session_start();
include ("conexao.php");
include "funcoes.php";
header("Content-Type: text/html; charset=ISO-8859-1",true);
if(isset($_POST['nome_produto'])){
    $nome_produto = $_POST['nome_produto'];
    $preco_produto = $_POST['preco_produto'];
    $peso_produto = $_POST['peso_produto'];
    $id_fornecedor = $_POST['id_fornecedor'];
    $unidade_medida_fornecedor = $_POST['unidade_medida_fornecedor'];

    $sql = "SELECT cod_barra 
            FROM produto
            where descricao = '$nome_produto'";
           
    $resultado = mysqli_query($ligacao,$sql);
    $registo=mysqli_fetch_assoc($resultado);
    if($registo){
        $cod_barra=$registo['cod_barra'];
    }else{
        
    }

    $sql = "INSERT INTO catalogo_fornecedor(produto_fk,fornecedor_fk,preco,peso_fornecedor,unidade_medida_fornecido) VALUES('$cod_barra','$id_fornecedor','$preco_produto','$peso_produto','$unidade_medida_fornecedor')";
    $resultado = mysqli_query($ligacao,$sql);


    if($resultado){
        echo "<p style='color:green;text-align: center;font-size: 16px;'>Produto adicionado com sucesso!</p>";  
    }else{ echo "falha";}


}
?>