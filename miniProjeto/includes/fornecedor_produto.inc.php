<?php

include('conexao.php');
$id_fornecedor= $_POST['fornecedor_id'];
header("Content-Type: text/html; charset=ISO-8859-1",true);
if(isset($_POST["fornecedor_id"]) && !empty($_POST["fornecedor_id"])){
    //pega valor de produtos
    $query = $ligacao->query("SELECT * 
     FROM catalogo_fornecedor
     inner join produto
     on catalogo_fornecedor.produto_fk = produto.cod_barra
     WHERE fornecedor_fk = '$id_fornecedor'
     ORDER BY produto.descricao ASC");
    
    //conta numero total de linhas da query
    $rowCount = $query->num_rows;
    
    //Mostra os produtos associados ao fornecedor
    if($rowCount > 0){
        echo '<option class="option_chegada" value="">Selecione o Produto</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option class="option_chegada" value="'.$row['produto_fk'].'">'.$row['descricao'].'</option>';
        }
    }else{
        echo '<option value="">Produto não disponivel</option>';
    }
}

?>