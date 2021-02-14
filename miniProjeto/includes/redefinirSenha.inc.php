<?php

if(isset($_POST["redefinir_senha_enviar"])){


    //criação de um token encriptado
    $selecionar = bin2hex(random_bytes(8));


    //token que autentica o utilizador (checar se é o correto) precisa ser seguro
    $token = random_bytes(32);


    //link mandado ao utilizador
    $url = "http://localhost:90/miniProjeto/criar_nova_Senha.php?selecionar=" . $selecionar . "&validador=" . bin2hex($token); 

    $validade = date("U") + 1800;

    require 'sistema_login_bd.php';

    $email = $_POST['email_id'];

    //primeiro paso acessar a bd e eliminar qualquer token existente em relação ao email.
    $sql= "DELETE FROM redefinir_senha WHERE email_redefinir_senha=?;";
    $resultado = mysqli_stmt_init($ligacao);
    if(!mysqli_stmt_prepare($resultado,$sql)){
        echo "Um erro aconteceu!";
        exit();
    }else {
        mysqli_stmt_bind_param($resultado, "s", $email);
        mysqli_stmt_execute($resultado);

    }

    $sql = "INSERT INTO redefinir_senha(email_redefinir_senha,selecionar_redefinir_senha,token_redefinir_senha,validade_redefinir_senha) VALUES (?,?,?,?);";
    $resultado = mysqli_stmt_init($ligacao);
    if(!mysqli_stmt_prepare($resultado,$sql)){
        echo "Um erro aconteceu!";
        exit();
    }else {
        $token_hash = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($resultado, "ssss", $email,$selecionar,$token_hash,$validade);
        mysqli_stmt_execute($resultado);

    }

    mysqli_stmt_close($resultado);
    mysqli_close($ligacao);


    //email para utilizador
    $para = $email;

    $assunto = 'Redefinir Senha Market Management';
    
    $mensagem = '<p>Nos foi solicitada uma redefinição de senha por este email. O link para redefinir sua senha esta logo abaixo.
                Se você nao fez essa solicitação, ignore este email</p>';
    $mensagem .= '<p>Aqui está o link para redefinir sua senha: </br>';
    $mensagem .= '<a href="'. $url . '">' . $url . '</a></p>';

    //headers do email
    $cabecalho = "From: Marketmanagement.contacto@gmail.com\r\n";
    $cabecalho .= "Reply-to: MarketManagement.contacto@gmail.com\r\n";
    $cabecalho .= "Content-type: text/html\r\n";

    mail($para,$assunto,$mensagem, $cabecalho);


    header("Location: ../redefinirSenha.php?redefinir=sucesso");



}else{
    header("Location: ../redefinirSenha.php");
}






?>