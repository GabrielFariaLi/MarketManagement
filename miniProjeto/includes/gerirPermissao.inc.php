<?php 

    include ("sistema_login_bd.php");
    $id_utilizador = $_POST["utilizadorid"];  
	$permissao = $_POST["tipos_permissao_form"];  

	$sql = "UPDATE utilizador SET permissao ='$permissao' WHERE ID_utilizador='$id_utilizador'";  
	if(mysqli_query($ligacao, $sql))  
	{  
        
        $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Permissão atribuidadom sucesso</p>";  
        header("Location: ../gerirPermissoes.php");

    }  
    ?>