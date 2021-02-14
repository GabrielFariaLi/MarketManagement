<?php
session_start();
include("conexao.php");
date_default_timezone_set('Europe/Lisbon');
$id_tabela = $_POST['idtabela'];
$data_chegada = $_POST['date_chegada'];
$seccao_chegada = $_POST['tipos_seccoes_form'];                                                      //$_POST['tipos_seccoes_form'];

echo $id_tabela;
echo "<br>";
echo date('Y-m-d H:i:s', strtotime($data_chegada));
echo "<br>";



$hora_um = date('Y-m-d H:i:s', strtotime($data_chegada));
$hora_dois = date("H:i:s");
$h =  strtotime($hora_um);
$h2 = strtotime($hora_dois);

$minutos = date("i", $h2);
$segundos = date("s", $h2);
$hora = date("H", $h2);

$temp = strtotime("+$minutos minutes", $h);
$temp = strtotime("+$segundos seconds", $temp);
$temp = strtotime("+$hora hours", $temp);
$nova_hora = date('Y-m-d H:i:s', $temp);

//horario de entrega encomenda
echo $nova_hora;

echo $seccao_chegada;
echo "<br>";




$sql = "UPDATE solicitacao
        SET data_chegada = '$nova_hora'
        WHERE encomenda_fk = '$id_tabela'";
        $resultado_update = mysqli_query($ligacao,$sql) or die($ligacao->error);

$sql = "SELECT solicitacao.produto_fk,solicitacao.quantidade_solicitacao,produto.unidade_medida_produto
        FROM encomenda 
        inner join solicitacao 
        on encomenda.ID_encomenda = solicitacao.encomenda_fk 
        inner join produto 
        on produto.cod_barra = solicitacao.produto_fk 
        inner join fornecedor 
        on fornecedor.ID_fornecedor = solicitacao.fornecedor_fk 
        where id_encomenda = '$id_tabela'";
$resultado = $ligacao->query($sql) or die($ligacao->error);
while($linha = $resultado->fetch_array()){

$produto[] = $linha['produto_fk'];
$quantidade[] = $linha['quantidade_solicitacao'];
$unidade_medida[] = $linha['unidade_medida_produto'];


}

foreach($quantidade as $posicao => $valor){
        
        //aréa que pega a quantidade_total do produto atualmente para incrementação
        $sql= "SELECT quantidade_total,cod_barra
        FROM encomenda 
        inner join solicitacao 
        on encomenda.ID_encomenda = solicitacao.encomenda_fk 
        inner join produto 
        on produto.cod_barra = solicitacao.produto_fk 
        inner join fornecedor 
        on fornecedor.ID_fornecedor = solicitacao.fornecedor_fk 
        where id_encomenda = '$id_tabela' and produto_fk = '$produto[$posicao]'";
        $resultado = mysqli_query($ligacao,$sql);
        $registo=mysqli_fetch_assoc($resultado);
        if($registo){
                $quantidade_total = $registo['quantidade_total'];
                $produto_id = $registo['cod_barra'];
                $quantidade_total += $valor;
                $sql="UPDATE produto 
                set quantidade_total = $quantidade_total
                where cod_barra = '$produto_id'";
                $resultado = mysqli_query($ligacao,$sql);
        }



}




foreach($produto as $posicao => $resposta){


        //aréa que pega a quantidade da encomenda
        $sql= "SELECT quantidade_solicitacao
        from solicitacao     
        where encomenda_fk = '$id_tabela' and produto_fk = '$resposta'";
        $resultado = mysqli_query($ligacao,$sql);
        $registo=mysqli_fetch_assoc($resultado);
        if($registo){
            $soma_quantidade_produto = $registo['quantidade_solicitacao'];
        }
        
        
        //aréa que determina se o produto ja existe ja secção a ser designada se ja existe a quantidade da encomenda é adicionada a quantidade ja armazenada  
        $sql = "SELECT * 
                from deslocacao
                where deslocacao.produto_fk = '$resposta' and deslocacao.seccao_fk = '$seccao_chegada'";

        $resultado = mysqli_query($ligacao,$sql);
        $registo=mysqli_fetch_assoc($resultado);
        if($registo){
            $soma_quantidade_produto += $registo['quantidade_deslocacao'];
            $sql = "UPDATE deslocacao
                    SET quantidade_deslocacao =  '$soma_quantidade_produto',data_deslocacao = '$nova_hora'
                    WHERE deslocacao.produto_fk = '$resposta' AND deslocacao.seccao_fk = '$seccao_chegada'";
                    $resultado_update = mysqli_query($ligacao,$sql) or die($ligacao->error);
                    $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Encomenda armazenada com sucesso!</p>";
                    header("Location: ../listarEncomenda.php");
        }// caso não exista este produto nesa secção
        else{   
                $sql="INSERT INTO deslocacao(produto_fk,seccao_fk,origem,quantidade_deslocacao) VALUES ('$resposta','$seccao_chegada','encomenda','$soma_quantidade_produto')";
                $resultado = mysqli_query($ligacao,$sql);
                $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Encomenda armazenada com sucesso!</p>";
                header("Location: ../listarEncomenda.php");
        }

        echo $posicao. "---------" . $resposta. "---------" . $soma_quantidade_produto . "<br>";


}
?>