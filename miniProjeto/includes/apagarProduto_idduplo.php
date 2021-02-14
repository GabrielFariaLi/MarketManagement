
<?php
    session_start();                //Resume a sess�o atual
    include ("conexao.php");    //Inclui o ficheiro com os processos padr�es de conex�o a base de dados

    $id = $_GET['id_apagar'];
    $id_produto = $_GET['id_produto'];
    $pagina = $_GET['pagina'];

        if(!empty($id)){                                                          //se o id_apagar foi atribuido

            if($pagina == "encomenda"){
            $sql = "DELETE FROM solicitacao WHERE produto_fk = '$id_produto' and encomenda_fk = '$id'";                    //Comando em SQL 
            $resultado = mysqli_query($ligacao,$sql) or die($ligacao->error);
            
                if(mysqli_affected_rows($ligacao)){             //Condi��o que verifica se a linha foi alterada
                    $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Produto apagado com sucesso</p>";        
                    header("Location: ../listarEncomenda.php");          
                    $resultado = mysqli_query($ligacao,$sql) or die($ligacao->error);
 
                }else{
                    $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'>Produto n�o foi apagado com sucesso</p>";  //Se n�o foi alterada o sistema retorna uma mensagem de fracasso
                    header("Location: ../listarEncomenda.php");
                }   
        }



        if($pagina == "fornecedor"){
            $sql = "DELETE FROM catalogo_fornecedor WHERE produto_fk = '$id_produto' and fornecedor_fk = '$id'";                    //Comando em SQL 
            $resultado = mysqli_query($ligacao,$sql) or die($ligacao->error);
            
                if(mysqli_affected_rows($ligacao)){             //Condi��o que verifica se a linha foi alterada
                    $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Produto apagado com sucesso</p>";        
                    header("Location: ../listarFornecedor.php");          
                    $resultado = mysqli_query($ligacao,$sql) or die($ligacao->error);
 
                }else{
                    $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'>Produto n�o foi apagado com sucesso</p>";  //Se n�o foi alterada o sistema retorna uma mensagem de fracasso
                    header("Location: ../listarFornecedor.php");
                }   
        }

     
}else{
            $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'>Necessario selecionar um produto</p>";      //id_apagar n�o foi atribuido
            
        } 
?>