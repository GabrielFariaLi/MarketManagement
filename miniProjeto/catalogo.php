<!DOCTYPE html>
<?php 
session_start();    
include("includes/conexao.php");
include 'includes/funcoes.php';

    //Verifica se o utilizador não tem permissão para acessar o sistema.
    if(isset($_SESSION['permissao']) or !isset($_SESSION['utilizador_ID'])){
        if($_SESSION['permissao'] == "Visitante" or !isset($_SESSION['utilizador_ID'])){
            header("location:errorvisitante.php");
            exit;

        }
    }
?>

<html>

    <head>
    <title>Cátalogo Hipermercado</title>
        <meta charset = 'ISO-8859-1'>
        <link rel="stylesheet" href="includes/css/styleListar.css">
        <link rel="stylesheet" href="includes/css/style.css">
        <link rel="icon" href="includes/imgs/icon_pag.png">
    </head>

    <body>
        <nav>
        <?php show_nav_catalog(); ?>
        </nav>

        <br> 
        <?php if($_SESSION['permissao'] == "Administrador" or $_SESSION['permissao'] == "Gerente"){ ?>
                <button id="btn_editar_explicacao" class="aviso_btn">
                    <i  class="far fa-edit"  ></i><i style="font-size: 14px;"class="fas fa-question"></i>
                </button>
                
                <br>
                <br>

            
                <div id="texto_editar" class="bolha_txt">
                <div class="aviso_editar" >
                
                <p style="margin-left: 10px; margin-top: 10px;">Todas as colunas do catálogo são editaveis ao selecionar e preencher os campos,os mesmos<br> quando deselecionados são armazenados na base de dados</p>
                </div>
                </div>
        <?php } ?>
        <?php show_list_catalog(); ?>
    </body>

</html>


