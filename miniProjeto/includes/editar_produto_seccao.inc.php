<?php 
    include "funcoes.php";
    include ("conexao.php");
    $id = $_POST["id"];  
	$text = $_POST["text"];  
    $column_name = $_POST["column_name"];  
    $id_sec = $_POST["id_sec"];
	$sql = "UPDATE deslocacao SET ".$column_name."='".$text."' WHERE produto_fk='".$id."' and seccao_fk='".$id_sec."'";  
	if(mysqli_query($connect, $sql))  
	{  
		echo 'Data Updated';  
    }  
    ?>