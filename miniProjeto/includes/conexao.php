<?php
//isolar isso em um ficheiro de codigo para utilizarmos o include
$servidor ="localhost"; // � sempre local host
$utilizador = "root"; // � sempre root
$senha = ""; // � a senha do utilizador
$bd = "hipermercado";      // nome da base de dados aonde vamos nos ligar

$ligacao = new mysqli($servidor, $utilizador, $senha, $bd); // estamos a criar um objeto liga��o com os parametros de observa��o mysql da base de dados

if($ligacao->connect_errno){                        //verifica se a liga��o foi feita
    echo "Falha na conex�o: (".$ligacao->connect_errno.") ".$ligacao->connect_error;
} 

if ($ligacao->connect_error) {
    die('Connect Error (' . $ligacao->connect_errno . ') '
            . $ligacao->connect_error);
}

?>  