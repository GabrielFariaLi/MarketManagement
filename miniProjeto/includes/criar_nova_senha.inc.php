<?php 

    if(isset($_POST["criar_nova_senha_submit"])){

        $selecionar = $_POST["selecionar"];
        $validador = $_POST["validador"];
        $senha = $_POST["nova_senha"];
        $senha_confirmar = $_POST["nova_senha_confirma"];

        if(empty($senha) || empty($senha_confirmar)){
            header("Location: ../criar_nova_senha.php?novasenha=vazia");
            exit();
        } else if($senha != $senha_confirmar){
            header("Location: ../criar_nova_senha.php?novasenha=senhasdiferentes");
            exit();
        }

        $hora_atual = date("U");

        require 'sistema_login_bd.php';

        $sql= "SELECT * FROM redefinir_senha WHERE selecionar_redefinir_senha=? and validade_redefinir_senha >=?";
        $resultado = mysqli_stmt_init($ligacao);
        if(!mysqli_stmt_prepare($resultado,$sql)){
            echo "Um erro aconteceu!";
            exit();
        }else {
            mysqli_stmt_bind_param($resultado, "ss", $selecionar,$hora_atual);
            mysqli_stmt_execute($resultado);

            $resultado_get = mysqli_stmt_get_result($resultado);
            if(!$linha = mysqli_fetch_assoc($resultado_get)){
                echo "Reenvio de redefiniчуo de senha necessario!";
                exit();
            } else {
                $tokenBin = hex2bin($validador);
                $checar_token = password_verify($tokenBin,$linha["token_redefinir_senha"]);

                if($checar_token === FALSE){
                    echo "Reenvio de redefiniчуo de senha necessario!";
                    exit();
                }else if($checar_token === TRUE){
                    $email_token = $linha['email_redefinir_senha'];

                    $sql = "SELECT * FROM utilizador where email_utilizador=?;";
                    $resultado = mysqli_stmt_init($ligacao);
                    if(!mysqli_stmt_prepare($resultado,$sql)){
                        echo "Um erro aconteceu!";
                        exit();
                    }else {
                        mysqli_stmt_bind_param($resultado,"s",$email_token);
                        mysqli_stmt_execute($resultado);
                        $resultado_get = mysqli_stmt_get_result($resultado);
                        if(!$linha = mysqli_fetch_assoc($resultado_get)){
                            echo "Um erro aconteceu!";
                            exit();
                        } else {
                            $sql = "UPDATE utilizador set palavrapasse_utilizador=? WHERE email_utilizador=?";
                            $resultado = mysqli_stmt_init($ligacao);
                            if(!mysqli_stmt_prepare($resultado,$sql)){
                                echo "Um erro aconteceu!";
                                exit();
                            }else {
                                $nova_senha = password_hash($senha,PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($resultado,"ss",$nova_senha,$email_token);
                                mysqli_stmt_execute($resultado);

                                $sql= "DELETE FROM redefinir_senha WHERE email_redefinir_senha=?;";
                                $resultado = mysqli_stmt_init($ligacao);
                                if(!mysqli_stmt_prepare($resultado,$sql)){
                                    echo "Um erro aconteceu!";
                                    exit();
                                }else {
                                    mysqli_stmt_bind_param($resultado, "s", $email_token);
                                    mysqli_stmt_execute($resultado);
                                    header("Location: ../index.php?novasenha=senhaatualizada");
                            
                                }
                            }
                        }
                    }
                }
            }
    
        }


    }else{
        header("Location: ../redefinirSenha.php?redefinir=sucesso");
    }
?>