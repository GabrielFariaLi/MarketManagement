<?php
//� copy paste vamos isolar isso em um ficheiro de codigo para utilizarmos o include
$servidor ="localhost"; // � sempre local host
$utilizador = "root"; // � sempre root pq � o numero do nosso utilizador
$senha = ""; // � a senha do utilizador
$bd = "sistema_login";      // nome da base de dados aonde vamos nos ligar

$ligacao = new mysqli($servidor, $utilizador, $senha, $bd); // estamos a criar um objeto liga��o com os parametros de observa��o mysql da base de dados


if($ligacao->connect_errno)                         //verifica se a liga��o foi verificada se nao ela morre
    echo "Falha na conex�o: (".$ligacao->connect_errno.") ".$ligacao->connect_error;

?>  