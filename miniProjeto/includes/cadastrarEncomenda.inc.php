<?php
session_start();
include("conexao.php");
date_default_timezone_set('Europe/Lisbon');
$produto_solicitacao= $_POST['tipos_produtos_select'];
$quantidade_solicitacao= $_POST['quantidade_solicitacao'];
//$preco_solicitacao= $_POST['preco_solicitacao'];
$fornecedor_solicitacao= $_POST['tipos_fornecedores_select'];


echo $fornecedor_solicitacao;
echo "<br>";


$sql = "SELECT max(id_encomenda) AS max_id_encomenda FROM `encomenda` where 1";
$resultado = mysqli_query($ligacao,$sql);
$registo=mysqli_fetch_assoc($resultado);
if($registo){
    $prox_id_encomenda=$registo['max_id_encomenda']+1;
    $sql = "INSERT INTO encomenda values ()";
    $resultado = mysqli_query($ligacao,$sql);
}else{$prox_id_encomenda='1';}



foreach($produto_solicitacao as $posicao => $resposta){

        $sql = "SELECT * FROM `catalogo_fornecedor` WHERE produto_fk ='$resposta' and fornecedor_fk = '$fornecedor_solicitacao'";
        $resultado = mysqli_query($ligacao,$sql);
        $registo=mysqli_fetch_assoc($resultado);
        if($registo){
            $custo_fornecedor=$registo['preco'];
            $unidade_medida_fornecedor=$registo['unidade_medida_fornecido'];
            $peso_fornecedor=$registo['peso_fornecedor'];
        }else{$custo_fornecedor='000';}

        $sql = "SELECT * FROM produto WHERE cod_barra ='$resposta'";
        $resultado = mysqli_query($ligacao,$sql);
        $registo=mysqli_fetch_assoc($resultado);
        if($registo){
            
            $unidade_medida_produto=$registo['unidade_medida_produto'];
        }else{$unidade_medida_produto='000';}



        $quantidade_solicitacao_foreach = $quantidade_solicitacao[$posicao];

        if($unidade_medida_produto ==  $unidade_medida_fornecedor){
        $custo_fornecedor = ($custo_fornecedor * $quantidade_solicitacao_foreach) / $peso_fornecedor;
        }
        else if($unidade_medida_produto == "kg" and $unidade_medida_fornecedor == "gr"){
                $quantidade_solicitacao_foreach = $quantidade_solicitacao_foreach * 1000;
                $custo_fornecedor = ($custo_fornecedor * $quantidade_solicitacao_foreach) / $peso_fornecedor ; 
            
        }
        else if($unidade_medida_produto == "gr" and $unidade_medida_fornecedor == "kg"){
            $quantidade_solicitacao_foreach = $quantidade_solicitacao_foreach / 1000;
            $custo_fornecedor = ($custo_fornecedor * $quantidade_solicitacao_foreach) / $peso_fornecedor; 
        
        }
        else if($unidade_medida_produto == "L" and $unidade_medida_fornecedor == "ml"){
            $quantidade_solicitacao_foreach = $quantidade_solicitacao_foreach * 1000;
            $custo_fornecedor = ($custo_fornecedor * $quantidade_solicitacao_foreach) / $peso_fornecedor ;  
        
        }
        else if($unidade_medida_produto == "ml" and $unidade_medida_fornecedor == "L"){
            $quantidade_solicitacao_foreach = $quantidade_solicitacao_foreach / 1000;
            $custo_fornecedor = ($custo_fornecedor * $quantidade_solicitacao_foreach) / $peso_fornecedor; 
        
        }
                echo "<br>";
                echo $posicao . "---------" . $resposta;
                echo "<br>";
                echo $posicao . "---------" . $quantidade_solicitacao_foreach;
                echo "<br>";
                echo $posicao . "---------" . $preco_solicitacao_foreach;
                echo "<br>";

   mysqli_select_db($ligacao,$bd);
    $sql = "INSERT INTO solicitacao (encomenda_fk,produto_fk,fornecedor_fk,data_encomenda,quantidade_solicitacao,custo_solicitacao) values('$prox_id_encomenda','$resposta','$fornecedor_solicitacao',NOW(),'$quantidade_solicitacao[$posicao]','$custo_fornecedor')";
    $resultado = mysqli_query($ligacao,$sql); 
    $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Encomenda realizada com sucesso!</p>";                  
    header("location: ../listarEncomenda.php");   
}
?>