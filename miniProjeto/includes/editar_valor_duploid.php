<?php 

session_start();
include ("conexao.php");
sleep(1.5);
include "funcoes.php";
header("Content-Type: text/html; charset=ISO-8859-1",true);
if(isset($_POST['id'])){
    $value = $_POST['value'];
    $column = $_POST['column'];
    $id = $_POST['id'];
    $id_dois = $_POST['id_dois'];
    $pagina = $_POST['pagina'];

    
    if ($pagina == "encomenda"){

    $sql = "UPDATE solicitacao
            set $column = '$value' WHERE produto_fk = '$id_dois' AND encomenda_fk = '$id' LIMIT 1";
    $resultado = mysqli_query($ligacao,$sql);


    if($resultado){
        echo "<p style='color:green;text-align: center;font-size: 16px;'>Produto editado com sucesso!</p>";  
    }else{ echo "falha";}
}

if ($pagina == "fornecedor"){
    $sql = "UPDATE catalogo_fornecedor
            set $column = '$value' WHERE produto_fk = $id_dois AND fornecedor_fk = $id LIMIT 1";
    $resultado = mysqli_query($ligacao,$sql);


    if($resultado){
        echo "<p style='color:green;text-align: center;font-size: 16px;'>Produto editado com sucesso!</p>";  
    }else{ echo "falha";}
}
}
?>