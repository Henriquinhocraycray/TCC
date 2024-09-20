<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $mysqli->real_escape_string($_POST['nome']);
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $telefone = $mysqli->real_escape_string($_POST['telefone']);
    $tipo_reserva = $mysqli->real_escape_string($_POST['tipo_reserva']);
    $n_pessoas = $mysqli->real_escape_string($_POST['n_pessoas']);
    $preco = $mysqli->real_escape_string($_POST['preco']);
    $pedido = $mysqli->real_escape_string($_POST['pedido']);
    $n_reserva = $mysqli->real_escape_string($_POST['n_reserva']);

    $sql = "INSERT INTO cliente (nome, cpf, email, telefone, tipo_reserva, n_pessoas, preco, pedido, n_reserva) 
            VALUES ('$nome', '$cpf', '$email', '$telefone', '$tipo_reserva', '$n_pessoas', '$preco', '$pedido', '$n_reserva')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Dados inseridos com sucesso!";
        header("Location: home.php");
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $mysqli->error;
    }
}

$mysqli->close();
?>