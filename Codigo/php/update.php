<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $mysqli->real_escape_string($_POST['id']);
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $telefone = $mysqli->real_escape_string($_POST['telefone']);

    $sql = "UPDATE cliente SET nome = '$nome', cpf = '$cpf', email = '$email', telefone = '$telefone' WHERE id = '$id'";
    
    if ($mysqli->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: home.php?id=' . $id);
    } else {
        echo "Erro ao atualizar dados: " . $mysqli->error;
    }

    $mysqli->close();
}
?>