<?php

$usuario = 'root';
$senha = '';
$database = 'tcc';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}

// else {
//     echo "Conexão efetuada";
// }

return $mysqli;

?>