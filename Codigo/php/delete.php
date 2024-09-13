<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $mysqli->real_escape_string($_POST['id']);

    $sql = "DELETE FROM cliente WHERE id = '$id'";
    
    if ($mysqli->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header('Location: home.php'); 
    } else {
        echo "Erro ao deletar dados: " . $mysqli->error;
    }

    $mysqli->close();
}
?>