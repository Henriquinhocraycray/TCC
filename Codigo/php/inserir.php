<?php
include('conexao.php');
include('protecao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $mysqli->real_escape_string($_POST['nome']);
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $telefone = $mysqli->real_escape_string($_POST['telefone']);
    $endereco = $mysqli->real_escape_string($_POST['endereco']);
    $data_checkin = $mysqli->real_escape_string($_POST['data_checkin']);  // Captura a data de checkin
    $data_checkout = $mysqli->real_escape_string($_POST['data_checkout']);  // Captura a data de checkout
    $id_quarto = $mysqli->real_escape_string($_POST['id_quarto']);
    $metodo_pagamento = $mysqli->real_escape_string($_POST['metodo_pagamento']);
    $valor_pagamento = $mysqli->real_escape_string($_POST['valor_pagamento']);

    // Calcular o total da reserva com base na data de checkin e checkout
    $sql_preco = "SELECT preco_noite FROM Quartos WHERE id_quarto = '$id_quarto'";
    $result_preco = $mysqli->query($sql_preco);

    if ($result_preco->num_rows > 0) {
        $row = $result_preco->fetch_assoc();
        $preco_noite = $row['preco_noite'];

        // Calcular a quantidade de dias entre checkin e checkout
        $date_checkin = new DateTime($data_checkin);
        $date_checkout = new DateTime($data_checkout);
        $interval = $date_checkin->diff($date_checkout);
        $dias = $interval->days;

        // Calcular o total
        $total = $preco_noite * $dias;
    } else {
        $total = 0; // Caso não encontre o preço, define o total como 0
    }

    // 1. Insere o cliente no banco de dados
    $sql_cliente = "INSERT INTO Clientes (nome, cpf, email, telefone, endereco) 
                    VALUES ('$nome', '$cpf', '$email', '$telefone', '$endereco')";

    if ($mysqli->query($sql_cliente) === TRUE) {
        $id_cliente = $mysqli->insert_id;

        // 2. Insere a reserva
        $sql_reserva = "INSERT INTO Reservas (id_cliente, id_quarto, data_checkin, data_checkout, total) 
                        VALUES ('$id_cliente', '$id_quarto', '$data_checkin', '$data_checkout', '$total')";

        if ($mysqli->query($sql_reserva) === TRUE) {
            $id_reserva = $mysqli->insert_id;

            // 3. Insere o pagamento
            $sql_pagamento = "INSERT INTO Pagamentos (id_reserva, metodo, valor, data_pagamento) 
                              VALUES ('$id_reserva', '$metodo_pagamento', '$valor_pagamento', CURDATE())";

            if ($mysqli->query($sql_pagamento) === TRUE) {
                echo "Dados inseridos com sucesso!";
                header("Location: home.php");  // Redireciona após a confirmação
                exit();
            } else {
                echo "Erro ao registrar o pagamento: " . $mysqli->error;
            }
        } else {
            echo "Erro ao registrar a reserva: " . $mysqli->error;
        }
    } else {
        echo "Erro ao registrar o cliente: " . $mysqli->error;
    }
}

$mysqli->close();
?>