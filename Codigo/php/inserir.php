<?php
include('conexao.php');
include('protecao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Coletando e escapando os dados do formulário para evitar SQL Injection
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $cpf = $mysqli->real_escape_string($_POST['cpf']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $telefone = $mysqli->real_escape_string($_POST['telefone']);
    $endereco = $mysqli->real_escape_string($_POST['endereco']);  // Novo campo
    $data_checkin = $mysqli->real_escape_string($_POST['data_checkin']);
    $data_checkout = $mysqli->real_escape_string($_POST['data_checkout']);
    $id_quarto = $mysqli->real_escape_string($_POST['id_quarto']);
    $metodo_pagamento = $mysqli->real_escape_string($_POST['metodo_pagamento']);
    $valor_pagamento = $mysqli->real_escape_string($_POST['valor_pagamento']);

    // Inserir o cliente na tabela Clientes
    $sql_cliente = "INSERT INTO Clientes (nome, cpf, email, telefone, endereco) 
                    VALUES ('$nome', '$cpf', '$email', '$telefone', '$endereco')";

    if ($mysqli->query($sql_cliente) === TRUE) {
        $id_cliente = $mysqli->insert_id;  // Captura o ID do cliente inserido

        // Inserir a reserva na tabela Reservas
        $sql_reserva = "INSERT INTO Reservas (id_cliente, id_quarto, data_checkin, data_checkout, total) 
                        VALUES ('$id_cliente', '$id_quarto', '$data_checkin', '$data_checkout', '$valor_pagamento')";

        if ($mysqli->query($sql_reserva) === TRUE) {
            $id_reserva = $mysqli->insert_id;  // Captura o ID da reserva inserida

            // Inserir o pagamento na tabela Pagamentos
            $sql_pagamento = "INSERT INTO Pagamentos (id_reserva, metodo, valor, data_pagamento) 
                              VALUES ('$id_reserva', '$metodo_pagamento', '$valor_pagamento', CURDATE())";

            if ($mysqli->query($sql_pagamento) === TRUE) {
                echo "Dados inseridos com sucesso!";
                header("Location: home.php");  // Redireciona após a inserção
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