<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes</title>
    <link rel="stylesheet" type="text/css" media='screen' href="../css/detalhes.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
$(document).ready(function() {
    $('#cpf').mask('000.000.000-00');

    $('#telefone').mask('(00) 00000-0000');

    $('#data').mask('00/00/0000');

    $('#preco').mask('#,##0.00', {reverse: true});

    $('#n_reserva').mask('000000000');
});
</script>

<body>

<?php
include('header.php');
include('protecao.php');
?>

<div class="det-maindiv">

    <div class="det-div1" id="det-div1">
        <div class="det-subdiv">
            <a href="dados_gerais.php"><img src="../img/seta.png" alt="Back"></a>
            <a href="#" id="cliente-data-link">
                <div class="det-optdiv">Dados do Cliente</div>
            </a>
            <a href="#" id="reserva-data-link">
                <div class="det-optdiv">Informações da Reserva</div>
            </a>
            <a href="#" id="pagamento-data-link">
                <div class="det-optdiv">Informações de Pagamento</div>
            </a>
            <hr>
            <button id="btn-mod">Modificar Informações</button>
            <button id="btn-del">Excluir Informações</button>
        </div>
    </div>

    <div class="det-div2">
        <h1 align="center" id="div2-title">SUA POUSADA</h1>
        <img src="../img/user.png" alt="User Image">
        
        <?php
        include('conexao.php');

        if (isset($_GET['id'])) {
            $id = $mysqli->real_escape_string($_GET['id']);

            // Consulta SQL para buscar dados das tabelas Reservas, Clientes, Quartos e Pagamentos
            $sql = "
                SELECT r.id_reserva, r.data_checkin, r.data_checkout, r.total, 
                       c.nome AS cliente_nome, c.cpf AS cliente_cpf, c.email AS cliente_email, c.telefone AS cliente_telefone, c.endereco AS cliente_endereco,
                       q.numero AS quarto_numero, q.tipo AS quarto_tipo, q.preco_noite AS quarto_preco_noite,
                       p.metodo AS pagamento_metodo, p.valor AS pagamento_valor, p.data_pagamento AS pagamento_data
                FROM Reservas r
                JOIN Clientes c ON r.id_cliente = c.id_cliente
                JOIN Quartos q ON r.id_quarto = q.id_quarto
                LEFT JOIN Pagamentos p ON r.id_reserva = p.id_reserva
                WHERE r.id_reserva = '$id'
            ";
            
            $result = $mysqli->query($sql);

            if ($result === false) {
                die("Error: " . $mysqli->error);
            }

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo '<div id="data-container">';

                // Dados do cliente
                echo '<div id="cliente-title-link" class="hidden"><h2>Dados do Cliente</h2><br></div>';
                    echo '<div id="cliente-data">';
                        echo '<h3>Nome Completo</h3>';
                        echo '<p>' . htmlspecialchars($row['cliente_nome']) . '</p>';
                        echo '<hr>';
                        echo '<h3>CPF</h3>';
                        echo '<p>' . htmlspecialchars($row['cliente_cpf']) . '</p>';
                        echo '<hr>';
                        echo '<h3>E-mail</h3>';
                        echo '<p>' . htmlspecialchars($row['cliente_email']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Telefone</h3>';
                        echo '<p>' . htmlspecialchars($row['cliente_telefone']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Endereço</h3>';
                        echo '<p>' . htmlspecialchars($row['cliente_endereco']) . '</p>';
                        echo '<hr>';
                    echo '</div>';

                    // Dados da reserva
                    echo '<div id="reserva-title-link" class="hidden"><h2>Informações da Reserva</h2><br></div>';
                    echo '<div id="reserva-data" class="hidden">';
                        echo '<h3>Nº da Reserva</h3>';
                        echo '<p>' . htmlspecialchars($row['id_reserva']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Tipo de Quarto</h3>';
                        echo '<p>' . htmlspecialchars($row['quarto_tipo']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Nº do Quarto</h3>';
                        echo '<p>' . htmlspecialchars($row['quarto_numero']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Data de Check-in</h3>';
                        echo '<p>' . htmlspecialchars($row['data_checkin']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Data de Check-out</h3>';
                        echo '<p>' . htmlspecialchars($row['data_checkout']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Preço Total</h3>';
                        echo '<p>' . htmlspecialchars($row['total']) . '</p>';
                        echo '<hr>';
                    echo '</div>';

                    // Dados de pagamento
                    echo '<div id="pagamento-title-link" class="hidden"><h2>Informações de Pagamento</h2><br></div>';
                    echo '<div id="pagamento-data" class="hidden">';
                        if ($row['pagamento_metodo']) {
                            echo '<h3>Método de Pagamento</h3>';
                            echo '<p>' . htmlspecialchars($row['pagamento_metodo']) . '</p>';
                            echo '<hr>';
                            echo '<h3>Valor Pago</h3>';
                            echo '<p>' . htmlspecialchars($row['pagamento_valor']) . '</p>';
                            echo '<hr>';
                            echo '<h3>Data do Pagamento</h3>';
                            echo '<p>' . htmlspecialchars($row['pagamento_data']) . '</p>';
                            echo '<hr>';
                        } else {
                            echo '<p>Não foi realizado pagamento para esta reserva ainda.</p>';
                        }
                    echo '</div>';

                echo '</div>';

                // Formulário para modificar as informações
                echo '<div id="form-container" class="hidden form-container">';
                echo '<form id="cliente-form" action="update.php" method="POST">';
                echo '<div class="cliente-form">';
                echo '<div class="sub-cliente-form">';
                echo '<div class="cliente-form-data">';
                    echo '<input type="hidden" name="id_reserva" value="' . htmlspecialchars($row['id_reserva']) . '">';
                    echo '<h1>Dados do Cliente</h1>';
                    echo '<h3>Nome Completo</h3>';
                    echo '<p><input type="text" id="nome" name="nome" value="' . htmlspecialchars($row['cliente_nome']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>CPF</h3>';
                    echo '<p><input type="text" id="cpf" name="cpf" value="' . htmlspecialchars($row['cliente_cpf']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>E-mail</h3>';
                    echo '<p><input type="email" id="email" name="email" value="' . htmlspecialchars($row['cliente_email']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>Telefone</h3>';
                    echo '<p><input type="text" id="telefone" name="telefone" value="' . htmlspecialchars($row['cliente_telefone']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>Endereço</h3>';
                    echo '<p><input type="text" id="endereco" name="endereco" value="' . htmlspecialchars($row['cliente_endereco']) . '"></p>';
                    echo '<hr>';
                echo '</div>';
                echo '<br>';
                echo '<br>';
                echo '<div class="reserva-form-data">';
                    echo '<h1>Informações da Reserva</h1>';
                    echo '<h3>Nº da Reserva</h3>';
                    echo '<p><input type="text" id="n_reserva" name="n_reserva" value="' . htmlspecialchars($row['id_reserva']) . '" disabled></p>';
                    echo '<hr>';
                    echo '<h3>Tipo de Quarto</h3>';
                    echo '<p><input type="text" id="tipo_quarto" name="tipo_quarto" value="' . htmlspecialchars($row['quarto_tipo']) . '" disabled></p>';
                    echo '<hr>';
                    echo '<h3>Nº do Quarto</h3>';
                    echo '<p><input type="text" id="numero_quarto" name="numero_quarto" value="' . htmlspecialchars($row['quarto_numero']) . '" disabled></p>';
                    echo '<hr>';
                    echo '<h3>Preço Total</h3>';
                    echo '<p><input type="text" id="preco" name="preco" value="' . htmlspecialchars($row['total']) . '"></p>';
                    echo '<hr>';
                echo '</div>';
                echo '</div>';
                    echo '<button id="btn-cmod" type="submit">Salvar Alterações</button>';
                    echo '<button id="back-btn" type="button">Voltar</button>';
                echo '</div>';
                echo '</form>';
                echo '</div>';

                echo '<form id="delete-form" action="delete.php" method="POST" class="hidden">';
                    echo '<input type="hidden" name="id_reserva" value="' . htmlspecialchars($row['id_reserva']) . '">';
                    echo '<div class="delete-confirmation">';
                    echo '<h2>Tem certeza de que deseja excluir esta reserva?</h2>';
                    echo '<button id="btn-cdel" type="submit">Excluir</button>';
                    echo '</div>';
                echo '</form>';

            } else {
                echo '<p>Reserva não encontrada.</p>';
            }
        }
        ?>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const clienteDataLink = document.getElementById('cliente-data-link');
    const reservaDataLink = document.getElementById('reserva-data-link');
    const pagamentoDataLink = document.getElementById('pagamento-data-link');
    const clienteTitleLink = document.getElementById('cliente-title-link');
    const reservaTitleLink = document.getElementById('reserva-title-link');
    const pagamentoTitleLink = document.getElementById('pagamento-title-link');
    const clienteDataDiv = document.getElementById('cliente-data');
    const reservaDataDiv = document.getElementById('reserva-data');
    const pagamentoDataDiv = document.getElementById('pagamento-data');
    const formContainer = document.getElementById('form-container');
    const dataContainer = document.getElementById('data-container');
    const deleteForm = document.getElementById('delete-form');

    clienteDataLink.addEventListener('click', function(event) {
        event.preventDefault();
        clienteDataDiv.classList.remove('hidden');
        reservaDataDiv.classList.add('hidden');
        pagamentoDataDiv.classList.add('hidden');
        clienteTitleLink.classList.remove('hidden');
        reservaTitleLink.classList.add('hidden');
        pagamentoTitleLink.classList.add('hidden');
        dataContainer.classList.remove('hidden');
        formContainer.classList.add('hidden');
        deleteForm.classList.add('hidden');
    });

    reservaDataLink.addEventListener('click', function(event) {
        event.preventDefault();
        reservaDataDiv.classList.remove('hidden');
        clienteDataDiv.classList.add('hidden');
        pagamentoDataDiv.classList.add('hidden');
        reservaTitleLink.classList.remove('hidden');
        clienteTitleLink.classList.add('hidden');
        pagamentoTitleLink.classList.add('hidden');
        dataContainer.classList.remove('hidden');
        formContainer.classList.add('hidden');
        deleteForm.classList.add('hidden');
    });

    pagamentoDataLink.addEventListener('click', function(event) {
        event.preventDefault();
        pagamentoDataDiv.classList.remove('hidden');
        clienteDataDiv.classList.add('hidden');
        reservaDataDiv.classList.add('hidden');
        pagamentoTitleLink.classList.remove('hidden');
        clienteTitleLink.classList.add('hidden');
        reservaTitleLink.classList.add('hidden');
        dataContainer.classList.remove('hidden');
        formContainer.classList.add('hidden');
        deleteForm.classList.add('hidden');
    });

    document.getElementById('btn-mod').addEventListener('click', function() {
        formContainer.classList.remove('hidden');
        dataContainer.classList.add('hidden');
        deleteForm.classList.add('hidden');
    });

    document.getElementById('btn-del').addEventListener('click', function() {
        deleteForm.classList.remove('hidden');
        dataContainer.classList.add('hidden');
        formContainer.classList.add('hidden');
    });

    document.querySelectorAll('#back-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            formContainer.classList.add('hidden');
            deleteForm.classList.add('hidden');
            dataContainer.classList.remove('hidden');
        });
    });

    clienteDataDiv.classList.remove('hidden');
    clienteTitleLink.classList.remove('hidden');
});
</script>

</body>
</html>