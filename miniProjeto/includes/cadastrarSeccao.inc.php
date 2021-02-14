<?php
session_start();
include("conexao.php");
date_default_timezone_set('Europe/Lisbon');
$seccao= $_POST['nome_seccao'];


echo $seccao;
echo "<br>";


$sql = "SELECT * 
        from seccao
        where seccao = '$seccao';";
$resultado = mysqli_query($ligacao,$sql);
if(!$resultado){
$sql = "INSERT INTO seccao(tipo) VALUES ('$seccao')";
        $resultado = mysqli_query($ligacao,$sql);
        header("location: ../listarSeccao.php");
}
else{
        $_SESSION['msg'] = "<p class='aviso_vermelho'  style='color:red;text-align: center;font-size: 16px;'><font size='6'>Secção ja cadastrada!</font></p>";
        header("location: ../CadastrarSeccao.php");
}

?>