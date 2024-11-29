<?php
include('conexao.php');
include('protecao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reserva = $mysqli->real_escape_string($_POST['id_reserva']);

    $mysqli->begin_transaction();

    try {
        // 1. Buscar o id_cliente e id_quarto associado à reserva
        $sql_reserva = "SELECT id_quarto, id_cliente FROM Reservas WHERE id_reserva = '$id_reserva'";
        $result_reserva = $mysqli->query($sql_reserva);

        if ($result_reserva->num_rows > 0) {
            $row_reserva = $result_reserva->fetch_assoc();
            $id_quarto = $row_reserva['id_quarto'];
            $id_cliente = $row_reserva['id_cliente'];

            // 2. Excluir o pagamento relacionado à reserva
            $sql_pagamento = "DELETE FROM Pagamentos WHERE id_reserva = '$id_reserva'";
            if ($mysqli->query($sql_pagamento) === FALSE) {
                throw new Exception("Erro ao excluir pagamento: " . $mysqli->error);
            }

            // 3. Excluir a reserva
            $sql_reserva_delete = "DELETE FROM Reservas WHERE id_reserva = '$id_reserva'";
            if ($mysqli->query($sql_reserva_delete) === FALSE) {
                throw new Exception("Erro ao excluir reserva: " . $mysqli->error);
            }

            // 4. Atualizar o status do quarto para "Livre"
            $sql_update_quarto = "UPDATE Quartos SET status = 'Disponível' WHERE id_quarto = '$id_quarto'";
            if ($mysqli->query($sql_update_quarto) === FALSE) {
                throw new Exception("Erro ao atualizar status do quarto: " . $mysqli->error);
            }

            // 5. Verificar se o cliente possui outras reservas
            $sql_check_cliente = "SELECT id_cliente FROM Reservas WHERE id_cliente = '$id_cliente' AND id_reserva != '$id_reserva'";
            $result_check_cliente = $mysqli->query($sql_check_cliente);

            // Se o cliente não tiver outras reservas, deletar o cliente
            if ($result_check_cliente->num_rows == 0) {
                // Excluir o cliente
                $sql_cliente_delete = "DELETE FROM Clientes WHERE id_cliente = '$id_cliente'";
                if ($mysqli->query($sql_cliente_delete) === FALSE) {
                    throw new Exception("Erro ao excluir cliente: " . $mysqli->error);
                }
            }

            // Se tudo ocorrer bem, comitar a transação
            $mysqli->commit();

            header('Location: home.php');
            exit;

        } else {
            throw new Exception("Reserva não encontrada ou quarto não associado.");
        }

    } catch (Exception $e) {
        // Em caso de erro, realizar rollback
        $mysqli->rollback();
        echo "Erro ao excluir dados: " . $e->getMessage();
    }

    $mysqli->close();
}
?>