<?php
include('conexao.php');
include('protecao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reserva = $mysqli->real_escape_string($_POST['id_reserva']);

    $mysqli->begin_transaction();

    try {
        // 1. Buscar o id_quarto associado à reserva
        $sql_quarto = "SELECT id_quarto FROM Reservas WHERE id_reserva = '$id_reserva'";
        $result_quarto = $mysqli->query($sql_quarto);

        if ($result_quarto->num_rows > 0) {
            $row_quarto = $result_quarto->fetch_assoc();
            $id_quarto = $row_quarto['id_quarto'];

            // 2. Excluir o pagamento
            $sql_pagamento = "DELETE FROM Pagamentos WHERE id_reserva = '$id_reserva'";
            if ($mysqli->query($sql_pagamento) === FALSE) {
                throw new Exception("Erro ao excluir pagamento: " . $mysqli->error);
            }

            // 3. Excluir a reserva
            $sql_reserva = "DELETE FROM Reservas WHERE id_reserva = '$id_reserva'";
            if ($mysqli->query($sql_reserva) === FALSE) {
                throw new Exception("Erro ao excluir reserva: " . $mysqli->error);
            }

            // 4. Atualizar o status do quarto para "Livre"
            $sql_update_quarto = "UPDATE Quartos SET status = 'Livre' WHERE id_quarto = '$id_quarto'";
            if ($mysqli->query($sql_update_quarto) === FALSE) {
                throw new Exception("Erro ao atualizar status do quarto: " . $mysqli->error);
            }

            // 5. Verificar se o cliente ainda está associado a outras reservas
            $sql_cliente = "SELECT id_cliente FROM Reservas WHERE id_reserva = '$id_reserva'";
            $result_cliente = $mysqli->query($sql_cliente);

            if ($result_cliente->num_rows > 0) {
                $row_cliente = $result_cliente->fetch_assoc();
                $id_cliente = $row_cliente['id_cliente'];

                // 6. Verificar se o cliente ainda possui outras reservas
                $sql_check_cliente = "SELECT id_cliente FROM Reservas WHERE id_cliente = '$id_cliente'";
                $result_check_cliente = $mysqli->query($sql_check_cliente);

                if ($result_check_cliente->num_rows == 0) {
                    // Se o cliente não tiver mais reservas, excluir o cliente
                    $sql_cliente_delete = "DELETE FROM Clientes WHERE id_cliente = '$id_cliente'";
                    if ($mysqli->query($sql_cliente_delete) === FALSE) {
                        throw new Exception("Erro ao excluir cliente: " . $mysqli->error);
                    }
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