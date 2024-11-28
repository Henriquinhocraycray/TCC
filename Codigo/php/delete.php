<?php
include('conexao.php');
include('protecao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reserva = $mysqli->real_escape_string($_POST['id_reserva']);

    $mysqli->begin_transaction();

    try {
        $sql_pagamento = "DELETE FROM Pagamentos WHERE id_reserva = '$id_reserva'";
        if ($mysqli->query($sql_pagamento) === FALSE) {
            throw new Exception("Erro ao excluir pagamento: " . $mysqli->error);
        }

        $sql_reserva = "DELETE FROM Reservas WHERE id_reserva = '$id_reserva'";
        if ($mysqli->query($sql_reserva) === FALSE) {
            throw new Exception("Erro ao excluir reserva: " . $mysqli->error);
        }

        $sql_cliente = "DELETE FROM Clientes WHERE id_cliente = (SELECT id_cliente FROM Reservas WHERE id_reserva = '$id_reserva')";
        if ($mysqli->query($sql_cliente) === FALSE) {
            throw new Exception("Erro ao excluir cliente: " . $mysqli->error);
        }

        $mysqli->commit();

        header('Location: home.php');
        exit;

    } catch (Exception $e) {
        $mysqli->rollback();
        echo "Erro ao excluir dados: " . $e->getMessage();
    }

    $mysqli->close();
}
?>