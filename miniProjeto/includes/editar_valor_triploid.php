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
    $id_tres = $_POST['id_tres'];
    $pagina = $_POST['pagina'];



   
    
    if ($pagina == "encomenda"){
        if($column == "quantidade_solicitacao"){ 


            $sql = "UPDATE solicitacao 
            SET quantidade_solicitacao = '$value' WHERE produto_fk = '$id_dois' AND encomenda_fk = '$id' AND fornecedor_fk ='$id_tres' LIMIT 1 ";
            $resultado = mysqli_query($ligacao,$sql);
            //área de armazanamento da quantidade atual
            $sql = "SELECT * FROM `solicitacao` WHERE produto_fk ='$id_dois' and encomenda_fk = '$id'";
            $resultado = mysqli_query($ligacao,$sql);
            $registo=mysqli_fetch_assoc($resultado);
            if($registo){
                $quantidade_solicitacao = $registo['quantidade_solicitacao'];
            }else{$erro='000';}
            //busca unidade de medida e custo pelo peso do produto fornecido
            $sql = "SELECT * FROM `catalogo_fornecedor` WHERE produto_fk ='$id_dois' and fornecedor_fk = '$id_tres'";
            $resultado = mysqli_query($ligacao,$sql);
            $registo=mysqli_fetch_assoc($resultado);
            if($registo){
                $custo_fornecedor=$registo['preco'];
                $unidade_medida_fornecedor=$registo['unidade_medida_fornecido'];
                $peso_fornecedor=$registo['peso_fornecedor'];
            }else{$erro='000';}
    
            $sql = "SELECT * FROM produto WHERE cod_barra ='$id_dois'";
            $resultado = mysqli_query($ligacao,$sql);
            $registo=mysqli_fetch_assoc($resultado);
            if($registo){
                $unidade_medida_produto=$registo['unidade_medida_produto'];
            }else{$erro='000';}


    
    
            if($unidade_medida_produto ==  $unidade_medida_fornecedor){
            $custo_fornecedor = ($custo_fornecedor * $quantidade_solicitacao) / $peso_fornecedor;
            }
             if($unidade_medida_produto == "kg" and $unidade_medida_fornecedor == "gr"){
                    $quantidade_solicitacao = $quantidade_solicitacao * 1000;
                    $custo_fornecedor = ($custo_fornecedor * $quantidade_solicitacao) / $peso_fornecedor ; 
                
            }
             if($unidade_medida_produto == "gr" and $unidade_medida_fornecedor == "kg"){
                $quantidade_solicitacao = $quantidade_solicitacao / 1000;
                $custo_fornecedor = ($custo_fornecedor * $quantidade_solicitacao) / $peso_fornecedor; 
            
            }
             if($unidade_medida_produto == "L" and $unidade_medida_fornecedor == "ml"){
                $quantidade_solicitacao = $quantidade_solicitacao * 1000;
                $custo_fornecedor = ($custo_fornecedor * $quantidade_solicitacao) / $peso_fornecedor ;  
            
            }
             if($unidade_medida_produto == "ml" and $unidade_medida_fornecedor == "L"){
                $quantidade_solicitacao = $quantidade_solicitacao / 1000;
                $custo_fornecedor = ($custo_fornecedor * $quantidade_solicitacao) / $peso_fornecedor; 
            
            }
            $sql = "UPDATE solicitacao 
            SET custo_solicitacao = '$custo_fornecedor' WHERE produto_fk = '$id_dois' AND encomenda_fk = '$id' AND fornecedor_fk ='$id_tres' LIMIT 1 ";
            $resultado = mysqli_query($ligacao,$sql);
                    echo "<br>";
                    echo $posicao . "---------" . $resposta;
                    echo "<br>";
                    echo $posicao . "---------" . $quantidade_solicitacao;
                    echo "<br>";
                    echo $posicao . "---------" . $preco_solicitacao_foreach;
                    echo "<br>";
    
       

        $sql = "UPDATE solicitacao
        set $column = '$value' WHERE produto_fk = '$id_dois' AND encomenda_fk = '$id' AND fornecedor_fk ='$id_tres' LIMIT 1";
$resultado = mysqli_query($ligacao,$sql);

 
        }else{
    $sql = "UPDATE solicitacao
            set $column = '$value' WHERE produto_fk = '$id_dois' AND encomenda_fk = '$id' AND fornecedor_fk ='$id_tres' LIMIT 1";
    $resultado = mysqli_query($ligacao,$sql);


    if($resultado){
        echo "<p style='color:green;text-align: center;font-size: 16px;'>Produto editado com sucesso!</p>";  
    }else{ echo "falha";}
}}

}
?>
<script>
$(function() {
    $('#Preco').maskMoney({ decimal: '.', thousands: '', precision: 2 });
    })
    </script>