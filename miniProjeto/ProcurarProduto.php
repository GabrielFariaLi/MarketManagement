<?php
    session_start();        //Resume a sessÃ¯Â¿Â½o atual
    include 'includes/funcoes.php'; 
    include ("includes/conexao.php");

       //Verifica se o utilizador não tem permissão para acessar o sistema.
       if(isset($_SESSION['permissao']) or !isset($_SESSION['utilizador_ID'])){
        if($_SESSION['permissao'] == "Visitante" or !isset($_SESSION['utilizador_ID'])){
            header("location:errorvisitante.php");
            exit;

        }
    }
	
	$pesquisar = $_POST['procurar'];

?>

<html>

    <head>
    <title>Resultado Procura</title>
        <meta charset = 'ISO-8859-1'>
        <link rel="stylesheet" href="includes/css/styleListar.css">
        <link rel="icon" href="includes/imgs/icon_pag.png">
    </head>

    <body>
        <?php if (isset($_POST['procurarseccao'])){ ?>

        <nav>
        <?php show_nav_cadastrar_seccao(); ?>
        </nav>
    
        <table class = "conteudo_tabela">
        <?php show_list_procurar_produto($pesquisar); ?>
        </table>

        <?php } ?>

        <?php if (isset($_POST['procurarcatalogo'])){ ?>
                <nav>
                    <?php show_nav_cadastrar_produto(); ?>
                </nav>

                <table class = "conteudo_tabela">
                    <?php show_list_procurar_produto_catalogo($pesquisar); ?>
                </table>
        <?php } ?>

        <?php if (isset($_POST['procurarencomenda'])){ ?>
                <nav>
                    <?php show_nav_cadastrar_encomenda(); ?>
                </nav>

                <table class = "conteudo_tabela">
                    <?php show_list_procurar_produto_encomenda($pesquisar); ?>
                </table>
        <?php } ?>

        <?php if (isset($_POST['procurarcompra'])){ ?>
                <nav>
                    <?php show_nav_cadastrar_compra(); ?>
                </nav>

                <table class = "conteudo_tabela">
                    <?php show_list_procurar_produto_compra($pesquisar); ?>
                </table>
        <?php } ?>

        <?php if (isset($_POST['procurarfornecedor'])){ ?>
                <nav>
                    <?php show_nav_cadastrar_fornecedor(); ?>
                </nav>

                <table class = "conteudo_tabela">
                    <?php show_list_procurar_produto_fornecedor($pesquisar); ?>
                </table>
        <?php } ?>

        <?php if (isset($_POST['procurardevolucao'])){ ?>
                <nav>
                    <?php show_nav_cadastrar_devolucao(); ?>
                </nav>

                <table class = "conteudo_tabela">
                    <?php show_list_procurar_produto_devolucao($pesquisar); ?>
                </table>
        <?php } ?>
    </body>

</html>