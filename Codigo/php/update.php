<?php
include('conexao.php');
include('protecao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Recuperando os dados do formulário
    $id_reserva = $mysqli->real_escape_string($_POST['id_reserva']);
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $telefone = $mysqli->real_escape_string($_POST['telefone']);
    $endereco = $mysqli->real_escape_string($_POST['endereco']);
    $preco = $mysqli->real_escape_string($_POST['preco']);  // Preço da reserva

    // Atualizando as informações da tabela de Clientes
    $sql_cliente = "UPDATE Clientes SET nome = '$nome', cpf = '$cpf', email = '$email', telefone = '$telefone', endereco = '$endereco' WHERE id_cliente = (SELECT id_cliente FROM Reservas WHERE id_reserva = '$id_reserva')";

    // Atualizando as informações da tabela de Reservas (preço da reserva)
    $sql_reserva = "UPDATE Reservas SET total = '$preco' WHERE id_reserva = '$id_reserva'";

    // Executando as consultas
    $mysqli->begin_transaction();
    try {
        if ($mysqli->query($sql_cliente) === FALSE) {
            throw new Exception("Erro ao atualizar cliente: " . $mysqli->error);
        }

        if ($mysqli->query($sql_reserva) === FALSE) {
            throw new Exception("Erro ao atualizar reserva: " . $mysqli->error);
        }

        // Caso tenha uma consulta para atualizar o pagamento (se aplicável)
        // if ($mysqli->query($sql_pagamento) === FALSE) {
        //     throw new Exception("Erro ao atualizar pagamento: " . $mysqli->error);
        // }

        $mysqli->commit();
        echo "Dados atualizados com sucesso!";
        header('Location: detalhes.php?id=' . $id_reserva);
        exit;

    } catch (Exception $e) {
        $mysqli->rollback();
        echo "Erro ao atualizar os dados: " . $e->getMessage();
    }

    $mysqli->close();
}
?>