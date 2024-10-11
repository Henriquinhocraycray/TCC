<?php
include('conexao.php');
include('protecao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $mysqli->real_escape_string($_POST['id']);
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $telefone = $mysqli->real_escape_string($_POST['telefone']);
    $n_reserva = $mysqli->real_escape_string($_POST['n_reserva']);
    $tipo_reserva = $mysqli->real_escape_string($_POST['tipo_reserva']);
    $n_pessoas = $mysqli->real_escape_string($_POST['n_pessoas']);
    $pedido = $mysqli->real_escape_string($_POST['pedido']);
    $preco = $mysqli->real_escape_string($_POST['preco']);


    $sql = "UPDATE cliente SET n_reserva = '$n_reserva', tipo_reserva = '$tipo_reserva', n_pessoas = '$n_pessoas', pedido = '$pedido', preco = '$preco', nome = '$nome', cpf = '$cpf', email = '$email', telefone = '$telefone' WHERE id = '$id'";
    
    if ($mysqli->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: detalhes.php?id=' . $id);
    } else {
        echo "Erro ao atualizar dados: " . $mysqli->error;
    }

    $mysqli->close();
}
?>