<?php
session_start();
include("conexao.php");
date_default_timezone_set('Europe/Lisbon');
$nome_fornecedor= $_POST['nome_fornecedor'];
$contacto_fornecedor= $_POST['contacto_fornecedor'];
$email_fornecedor= $_POST['email_fornecedor'];
$localidade_fornecedor= $_POST['localidade_fornecedor'];


echo $seccao;
echo "<br>";


$sql = "SELECT * 
        from fornecedor
        where email = '$email_fornecedor';";
$resultado = mysqli_query($ligacao,$sql);
$registo=mysqli_fetch_assoc($resultado);
if(!$registo){
$sql = "INSERT INTO fornecedor(nome_fornecedor,contacto,email,localidade) VALUES ('$nome_fornecedor','$contacto_fornecedor','$email_fornecedor','$localidade_fornecedor')";
        $resultado = mysqli_query($ligacao,$sql);
        header("location: ../listarFornecedor.php");
}
else{
        $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'><font size='6'>Secçãoo ja cadastrada!</font></p>";
        header("location: ../CadastrarFornecedor.php");
}

?>