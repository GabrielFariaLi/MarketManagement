<?php
session_start();
include("conexao.php");
date_default_timezone_set('Europe/Lisbon');
$produto_venda= $_POST['tipos_produtos_venda_select'];
$quantidade_venda= $_POST['quantidade_venda'];
$tipo_pagamento = $_POST['tipo_pagamento_select'];




foreach($tipo_pagamento as $posicao => $valor){
$sql = "SELECT max(id_fatura) AS max_id_fatura FROM `fatura` where 1";
$resultado = mysqli_query($ligacao,$sql);
$registo=mysqli_fetch_assoc($resultado);
if($registo){
    $prox_id_fatura=$registo['max_id_fatura']+1;
    $sql = "INSERT INTO fatura(tipo_pagamento) values ('$valor')";
    $resultado = mysqli_query($ligacao,$sql);
}else{$prox_id_fatura='1';}
}

foreach($produto_venda as $posicao => $resposta){




        $sql = "SELECT peso,preco_unitario  FROM `produto` where cod_barra = '$resposta'"; 
        $resultado = mysqli_query($ligacao,$sql);
        $registo=mysqli_fetch_assoc($resultado);
        if($registo){
            $peso_venda= $registo['peso'];
            $preco_venda=$registo['preco_unitario'];
            $preco_venda_final = (($preco_venda * $quantidade_venda[$posicao]) / $peso_venda);
        }


                echo "<br>";
                echo $posicao . "---------" . $resposta;
                echo "<br>";

        $caixa = rand(1,4);
   mysqli_select_db($ligacao,$bd);
    $sql = "INSERT INTO compra (caixa_fk,fatura_fk,produto_fk,quantidade_compra,custo) values('$caixa','$prox_id_fatura','$resposta','$quantidade_venda[$posicao]','$preco_venda_final')";
    $resultado = mysqli_query($ligacao,$sql);


            $sql= "SELECT quantidade_total,cod_barra
            FROM compra
            inner join produto 
            on produto.cod_barra = compra.produto_fk 
            inner join fatura
            on fatura.id_fatura = compra.fatura_fk
            where fatura_fk = '$prox_id_fatura' and produto_fk = '$resposta'";
            $resultado = mysqli_query($ligacao,$sql);
            $registo=mysqli_fetch_assoc($resultado);
                if($registo){
                    $quantidade_total = $registo['quantidade_total'];
                    $produto_id = $registo['cod_barra'];
                    $quantidade_total -= $quantidade_venda[$posicao];
                    $sql="UPDATE produto 
                    set quantidade_total = $quantidade_total
                    where cod_barra = '$produto_id'";
                    $resultado = mysqli_query($ligacao,$sql);
                    
                } 
            
            $sql= "SELECT quantidade_deslocacao,cod_barra
            FROM deslocacao
            inner join produto 
            on produto.cod_barra = deslocacao.produto_fk 
            where produto_fk = '$resposta' and seccao_fk != 1";
            $resultado = mysqli_query($ligacao,$sql);
            $registo=mysqli_fetch_assoc($resultado);
                if($registo){
                    $quantidade_total_armazem = $registo['quantidade_deslocacao'];
                    $produto_id = $registo['cod_barra'];
                    $quantidade_total_armazem -= $quantidade_venda[$posicao];
                    $sql="UPDATE deslocacao 
                    set quantidade_deslocacao = $quantidade_total_armazem
                    where produto_fk = '$resposta' and seccao_fk != 1";
                    $resultado = mysqli_query($ligacao,$sql);
                } 
    $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Compra realizada com sucesso!</p>";           
       
}
header("location: ../listarCompra.php");
?>