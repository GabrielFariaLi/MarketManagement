<?php
if(isset($_POST['registrar_enviar'])){

require 'sistema_login_bd.php';
//Armazena as variaveis(enviadas por:registrar.php) que serуo utilizadas na inserчуo da base de dados
$utilizador = $_POST['utilizador_id'];
$email = $_POST['email_utilizador_id'];
$palavrapasse = $_POST['palavrapasse_utilizador_id'];
$palavrapasse_repetir = $_POST['palavrapasse_utilizador_id-repetir'];

//Checa se os campos estуo vazios,retorna error e o input de username/email caso ja prenchido para a reposiчуo do dado
if(empty($utilizador) || empty($email) || empty($palavrapasse) || empty($palavrapasse_repetir)) {
    header("Location: ../registrar.php?error=campo_vazio&u_id=".$utilizador."&email=".$email);
    exit();

}//Checa se os campos estуo preenchidos da maneira correta aceita pelo codigo,retorna error
else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $utilizador)) {
    header("Location: ../registrar.php?error=email_username_invalido");
    exit();
}//Checa apenas email,retornando o username preenchido
else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../registrar.php?error=email_invalido&u_id=".$utilizador);
    exit();
}//Checa apenas username,retornando o email preenchido
else if(!preg_match("/^[a-zA-Z0-9]*$/", $utilizador)) {
    header("Location: ../registrar.php?error=username_invalido&email=".$email);
    exit();
}
//Checa se o utilizador repetiu corretamente a palavra passe
else if($palavrapasse !== $palavrapasse_repetir) {
    header("Location: ../registrar.php?error=verificacao_palavrapasse&u_id=".$utilizador."&email=".$email);
    exit();
}

else{       
    //Checa se o username escolhido ja existe na base de dados
    $sql = "SELECT ID_username FROM utilizador WHERE ID_username=?";
    $resultado = mysqli_stmt_init($ligacao);
    if(!mysqli_stmt_prepare($resultado,$sql)){
        header("Location: ../registrar.php?error=sqlerror");
        exit();

    }
    else{ //Metodo de tratamento com dados sensiveis
        mysqli_stmt_bind_param($resultado, "s", $utilizador);
        mysqli_stmt_execute($resultado);
        mysqli_stmt_store_result($resultado);
        $checkresultado = mysqli_stmt_num_rows($resultado);
        if ($checkresultado > 0){
            header("Location: ../registrar.php?error=username_existente");
            exit();

        }
        else{
            //Valida registraчуo e insere dados
            $sql = "INSERT INTO utilizador(ID_username,email_utilizador,palavrapasse_utilizador,permissao) VALUES (?,?,?,'Visitante')";
            $resultado = mysqli_stmt_init($ligacao);
            if(!mysqli_stmt_prepare($resultado,$sql)){
                header("Location: ../registrar.php?error=sqlerror");
                exit();
            }
            else {//Metodo de tratamento com dados sensiveis
                $criptografarpasse = password_hash($palavrapasse, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($resultado, "sss", $utilizador,$email,$criptografarpasse);
                mysqli_stmt_execute($resultado);
                header("Location: ../index.php?registrar=sucesso");
                exit();
            }
        }
    }

}
mysqli_stmt_close($resultado);
mysqli_close($ligacao);


}
else{
    header("Location: ../registrar.php");
    exit();
}
?>