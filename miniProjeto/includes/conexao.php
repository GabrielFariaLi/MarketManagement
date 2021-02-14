<?php
//isolar isso em um ficheiro de codigo para utilizarmos o include
$servidor ="localhost"; // é sempre local host
$utilizador = "root"; // é sempre root
$senha = ""; // é a senha do utilizador
$bd = "hipermercado";      // nome da base de dados aonde vamos nos ligar

$ligacao = new mysqli($servidor, $utilizador, $senha, $bd); // estamos a criar um objeto ligação com os parametros de observação mysql da base de dados

if($ligacao->connect_errno){                        //verifica se a ligação foi feita
    echo "Falha na conexão: (".$ligacao->connect_errno.") ".$ligacao->connect_error;
} 

if ($ligacao->connect_error) {
    die('Connect Error (' . $ligacao->connect_errno . ') '
            . $ligacao->connect_error);
}

?>  