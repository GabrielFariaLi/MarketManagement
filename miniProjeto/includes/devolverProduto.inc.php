<?php
    session_start();
    include ("conexao.php");    //Inclui o ficheiro com os processos padrões de conexão a base de dados
    include "funcoes.php";

    $unidade_medida = $_POST ['idunidademedida'];
    $quantidade_devolucao = $_POST ['quantidade_devolucao'];
    $motivo_devolucao =  $_POST['motivo_devolucao'];
    $produto = $_POST['idproduto'];
    $caixa = $_POST['idcaixa'];
    $fatura = $_POST['idfatura'];
    $quantidade_compra = $_POST['idquantidadecompra'];
    $quantidade_total = $_POST['idquantidadetotal'];
    $quantidade_total_final = $quantidade_total + $quantidade_devolucao;
    $quantidade_final = $quantidade_compra - $quantidade_devolucao;
    $data_devolucao = date("Y-m-d H:i:s");
  
    

        if(!empty($quantidade_devolucao)){  

            $sql="  SELECT *
                    from devolucao
                    where produto_fk = '$produto' and fatura_fk = '$fatura'";
                    $resultado = mysqli_query($ligacao,$sql);
                    $registo=mysqli_fetch_assoc($resultado);
                    if($registo){
                        $quantidade_devolucao_jaefetuada = $registo['quantidade_devolucao'];
                        $quantidade_total_devolucao = $quantidade_devolucao_jaefetuada + $quantidade_devolucao;
                        $sql="UPDATE devolucao 
                        SET quantidade_devolucao = '$quantidade_total_devolucao'
                        WHERE produto_fk = '$produto' AND fatura_fk ='$fatura'";
                        $resultado = mysqli_query($ligacao,$sql);
                        $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Produto devolvido com sucesso!</p>
                                            <a href='listarDevolucao.php'> Clique aqui para conferir!</a>";        
                        header("Location: ../listarCompra.php");  
                    }else{

                        $sql="INSERT INTO devolucao(produto_fk,fatura_fk,data_devolucao,quantidade_devolucao,satisfacao) VALUES ('$produto','$fatura','$data_devolucao','$quantidade_devolucao','$motivo_devolucao')";
                        $resultado = mysqli_query($ligacao,$sql);
                    }
            $sql="UPDATE produto 
            set quantidade_total = $quantidade_total_final
            where cod_barra = '$produto'";
            $resultado = mysqli_query($ligacao,$sql);

            //Atualiza quantidade atual na secção.
    $sql = "UPDATE compra
            SET quantidade_compra = '$quantidade_final'
            where compra.produto_fk = '$produto' and compra.fatura_fk = '$fatura' and compra.caixa_fk = '$caixa'";
            $resultado = mysqli_query($ligacao,$sql);



            //aréa que determina se ja existe um produto no armazem
        $sql = "SELECT * 
            from deslocacao
            where deslocacao.produto_fk = '$produto' and deslocacao.seccao_fk = 1";
            $resultado = mysqli_query($ligacao,$sql);
            $registo=mysqli_fetch_assoc($resultado);
            if($registo){
                $quantidade_final_armazem = $registo['quantidade_deslocacao'] + $quantidade_devolucao;
                $sql = "UPDATE deslocacao
                        SET quantidade_deslocacao =  '$quantidade_final_armazem'
                        WHERE deslocacao.produto_fk = '$produto' AND deslocacao.seccao_fk = 1";
                        $resultado = mysqli_query($ligacao,$sql);
                        $_SESSION['msg'] = "<p style='color:green;'>Produto Devolvido com sucesso!</p>
                                            <a href='listarSeccao.php'> Clique aqui para conferir!</a>";
                        header("Location: ../listarCompra.php");
                }// caso não exista este produto nessa secção
        else{   
                $sql="INSERT INTO deslocacao(produto_fk,seccao_fk,origem,quantidade_deslocacao,unidade_medida) VALUES ('$produto',1,'devolução','$quantidade_devolucao','$unidade_medida')";
                $resultado = mysqli_query($ligacao,$sql);
                $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Produto devolvido com sucesso!</p>
                                    <a href='listarDevolucao.php'> Clique aqui para conferir!</a>";
                header("Location: ../listarCompra.php");
        }          
 
                if(mysqli_affected_rows($ligacao)){             //Condição que verifica se a linha foi alterada
                    $_SESSION['msg'] = "<p style='color:green;text-align: center;font-size: 16px;'>Produto devolvido com sucesso!</p>";        
                    header("Location: ../listarCompra.php");          
 
                }else{
                    $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'>Produto não foi devolvido com sucesso</p>";  //Se não foi alterada o sistema retorna uma mensagem de fracasso
                    header("Location: ../listarCompra.php");
                }   
        }else{
            $_SESSION['msg'] = "<p style='color:red;text-align: center;font-size: 16px;'>Necessario selecionar uma quantidade</p>";      //id_apagar não foi atribuido
            header("Location: ../listarCompra.php");
         } ?>