
<?php
session_start();                //Resume a sess�oo atual
    include ("conexao.php");    //Inclui o ficheiro com os processos padr�es de conex�o a base de dados
 
    $id = $_GET['id_apagar'];
            $sql="SELECT produto_fk
                from compra
                where produto_fk = '$id'";
            $resultado = mysqli_query($ligacao,$sql);
            $registo=mysqli_fetch_assoc($resultado);
                if($registo){
                    $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px; '>Impossivel de apagar um produto que ja tenha sido feito parte de uma compra!</p>";      //id_apagar n�o foi atribuido
                    header("Location: ../catalogo.php");
                }
 
        if(!empty($id)){                                                          //se o id_apagarfoi atribuido


            $sql = "DELETE FROM produto WHERE cod_barra = '$id'";                    //Comando em SQL 
            $resultado = mysqli_query($ligacao,$sql) or die($ligacao->error);
            
            


 
                if(mysqli_affected_rows($ligacao)){             //Condi��o que verifica se a linha foi alterada
                    $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Produto apagado com sucesso</p>";        
                    header("Location: ../catalogo.php");          
                    $resultado = mysqli_query($ligacao,$sql) or die($ligacao->error);
 
                }else{
                    $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'>Produto n�o foi apagado com sucesso</p>";  //Se n�o foi alterada o sistema retorna uma mensagem de fracasso
                    header("Location: ../catalogo.php");
                }   
        }else{
            $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'>Necessario selecionar um produto</p>";      //id_apagar n�o foi atribuido
            header("Location: ../catalogo.php");
}
?>