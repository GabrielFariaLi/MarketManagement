<?php

if (isset($_POST['login-enviar'])){
    require 'sistema_login_bd.php';

    $email_utilizador = $_POST['email_id'];
    $palavrapasse = $_POST['senha_id'];
    //Checa se os campos estão vazios,retorna error
    if ( empty($email_utilizador) || empty($palavrapasse) ) {
        header("Location: ../index.php?error=camposvazios");
        exit();
    }
    else {
        $sql = "SELECT * FROM utilizador WHERE ID_username=? OR email_utilizador=?;";      //Comando SQL
        $resultado = mysqli_stmt_init($ligacao);
        if(!mysqli_stmt_prepare($resultado,$sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{   //Metodo de tratamento com dados sensiveis
            mysqli_stmt_bind_param($resultado, 'ss', $email_utilizador, $email_utilizador);
            mysqli_stmt_execute($resultado);
            $checar = mysqli_stmt_get_result($resultado);
            //Checa se o email ou username do usuario confere com o guardado na base de dados
            if ($linha = mysqli_fetch_assoc($checar) ) {    
                //Checa se a palavra passe confere com a palavra passe codificada armazenada
                $palavrapasse_check = password_verify($palavrapasse,$linha['palavrapasse_utilizador']);
                if ($palavrapasse_check == false){
                    header("Location: ../index.php?error=palavrapasse_incorreta");
                    exit();
                }   
                else if ($palavrapasse_check == true){
                    session_start();
                    $_SESSION['utilizador_ID'] = $linha['ID_utilizador'];
                    $_SESSION['username_utlizador'] = $linha['ID_username'];
                    $_SESSION['permissao'] = $linha['permissao'];

                    header("Location: ../home.php?login=sucesso");
                    exit();
                }
                else{
                    header("Location: ../index.php?error=palavrapasse_invalida");
                    exit();
                }
            }
            else{
                header("Location: ../index.php?error=usuario_inexistente");
                exit();
            }
        }
    }
}
else{
    header("Location: ../index.php");
    exit();
}
?>