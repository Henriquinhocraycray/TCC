<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta</title>
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
    
    $('#n_pessoas').mask('00');


});
</script>

<body>

<?php
include('header.php');
?>

<div class="det-maindiv">

    <div class="det-div1" id="det-div1">
        <div class="det-subdiv">
            <a href="home.php"><img src="../img/seta.png" alt="Back"></a>
            <a href="#" id="cliente-data-link">
                <div class="det-optdiv">Informações Pessoais</div>
            </a>
            <a href="#" id="reserva-data-link">
                <div class="det-optdiv">Informações da Empresa</div>
            </a>
            <hr>
            <button id="btn-mod">Modificar Informações</button>
            <button id="btn-del">Excluir Informações</button>
        </div>
    </div>

    <div class="det-div2">
        <h1 align="center" id="div2-title">SUA CONTA</h1>
        <img src="../img/user.png" alt="User Image">
        
        <?php
        include('conexao.php');

        if (isset($_GET['id'])) {
            $id = $mysqli->real_escape_string($_GET['id']);

            $sql = "SELECT * FROM usuario WHERE id = '$id'";
            $result = $mysqli->query($sql);

            if ($result === false) {
                die("Error: " . $mysqli->error);
            }

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo '<div id="data-container">';
                echo '<div id="cliente-title-link" class="hidden"><h2>Informações Pessoais</h2><br></div>';
                    echo '<div id="cliente-data">';
                        echo '<h3>Nome Completo</h3>';
                        echo '<p>' . htmlspecialchars($row['nome']) . '</p>';
                        echo '<hr>';
                        echo '<h3>CPF</h3>';
                        echo '<p>' . htmlspecialchars($row['cpf']) . '</p>';
                        echo '<hr>';
                        echo '<h3>E-mail</h3>';
                        echo '<p>' . htmlspecialchars($row['email']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Telefone</h3>';
                        echo '<p>' . htmlspecialchars($row['telefone']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Endereço</h3>';
                        echo '<p>' . htmlspecialchars($row['endereco']) . '</p>';
                        echo '<hr>';
                        echo '<h3>CEP</h3>';
                        echo '<p>' . htmlspecialchars($row['cep']) . '</p>';
                        echo '<hr>';
                        echo '<h3>RG</h3>';
                        echo '<p>' . htmlspecialchars($row['rg']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Registro do Funcionário</h3>';
                        echo '<p>' . htmlspecialchars($row['registro_func']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Data de Efetivaçãp</h3>';
                        echo '<p>' . htmlspecialchars($row['data_efetiv']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Status</h3>';
                        echo '<p>' . htmlspecialchars($row['func_status']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Data de Saída</h3>';
                        echo '<p>' . htmlspecialchars($row['data_saida']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Cargo</h3>';
                        echo '<p>' . htmlspecialchars($row['cargo']) . '</p>';
                        echo '<hr>';
                    echo '</div>';

                    echo '<div id="reserva-title-link" class="hidden"><h2>Informações da Reserva</h2><br></div>';
                    echo '<div id="reserva-data" class="hidden">';
                        echo '<h3>Nº da Reserva</h3>';
                        echo '<p>' . htmlspecialchars($row['n_reserva']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Tipo de Reserva</h3>';
                        echo '<p>' . htmlspecialchars($row['tipo_reserva']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Nº de Pessoas</h3>';
                        echo '<p>' . htmlspecialchars($row['n_pessoas']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Pedido Especial</h3>';
                        echo '<p>' . htmlspecialchars($row['pedido']) . '</p>';
                        echo '<hr>';
                        echo '<h3>Preço Total</h3>';
                        echo '<p>' . htmlspecialchars($row['preco']) . '</p>';
                        echo '<hr>';
                    echo '</div>';
                echo '</div>';

                echo '<div id="form-container" class="hidden form-container">';
                echo '<form id="cliente-form" action="update.php" method="POST">';
                echo '<div class="cliente-form">';
                echo '<div class="sub-cliente-form">';
                echo '<div class="cliente-form-data">';
                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<h1>Dados do Cliente</h1>';
                    echo '<h3>Nome Completo</h3>';
                    echo '<p><input type="text" id="nome" name="nome" value="' . htmlspecialchars($row['nome']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>CPF</h3>';
                    echo '<p><input type="text" id="cpf" name="cpf" value="' . htmlspecialchars($row['cpf']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>E-mail</h3>';
                    echo '<p><input type="email" id="email" name="email" value="' . htmlspecialchars($row['email']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>Telefone</h3>';
                    echo '<p><input type="text" id="telefone" name="telefone" value="' . htmlspecialchars($row['telefone']) . '"></p>';
                    echo '<hr>';
                echo '</div>';
                    echo '<br>';
                    echo '<br>';
                echo '<div class="reserva-form-data">';
                    echo '<h1>Informações da Reserva</h1>';
                    echo '<h3>Nº da Reserva</h3>';
                    echo '<p><input type="text" id="n_reserva" name="n_reserva" value="' . htmlspecialchars($row['n_reserva']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>Tipo de Reserva</h3>';
                    echo '<p><input type="text" id="tipo_reserva" name="tipo_reserva" value="' . htmlspecialchars($row['tipo_reserva']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>Nº de Pessoas</h3>';
                    echo '<p><input type="text" id="n_pessoas" name="n_pessoas" value="' . htmlspecialchars($row['n_pessoas']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>Pedido Especial</h3>';
                    echo '<p><input type="text" id="pedido" name="pedido" value="' . htmlspecialchars($row['pedido']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>Preço</h3>';
                    echo '<p><input type="text" id="preco" name="preco" value="' . htmlspecialchars($row['preco']) . '"></p>';
                    echo '<hr>';
                echo '</div>';
                echo '</div>';
                    echo '<button id="btn-cmod" type="submit">Salvar Alterações</button>';
                    echo '<button id="back-btn" type="button">Voltar</button>';
                echo '</div>';
                echo '</form>';

                echo '</div>';

                echo '<form id="delete-form" action="delete.php" method="POST" class="hidden">';
                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<div class="cdel-div">';
                    echo '<button id="btn-cdel" type="submit">Confirmar Exclusão</button>';
                    echo '<button id="back-btn" type="button">Voltar</button>';
                    echo '</div';
                echo '</form>';

            } else {
                echo '<p>No details found for this ID.</p>';
            }
        } else {
            echo '<p>No ID provided.</p>';
        }

        $mysqli->close();
        ?>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        const clienteDataLink = document.getElementById('cliente-data-link');
        const reservaDataLink = document.getElementById('reserva-data-link');
        const formContainer = document.getElementById('form-container');
        const dataContainer = document.getElementById('data-container');
        const clienteTitleLink = document.getElementById('cliente-title-link');
        const reservaTitleLink = document.getElementById('reserva-title-link');
        const clienteDataDiv = document.getElementById('cliente-data');
        const reservaDataDiv = document.getElementById('reserva-data');

        document.getElementById('btn-mod').addEventListener('click', function() {
            dataContainer.classList.add('hidden');
            formContainer.classList.remove('hidden');
            document.getElementById('delete-form').classList.add('hidden');
        });

        document.getElementById('btn-del').addEventListener('click', function() {
            dataContainer.classList.add('hidden');
            formContainer.classList.add('hidden');
            document.getElementById('delete-form').classList.remove('hidden');
        });

        clienteDataLink.addEventListener('click', function(event) {
            event.preventDefault();
            clienteDataDiv.classList.remove('hidden');
            reservaDataDiv.classList.add('hidden');
            clienteTitleLink.classList.remove('hidden');
            reservaTitleLink.classList.add('hidden');
            dataContainer.classList.remove('hidden');
            document.getElementById('delete-form').classList.add('hidden');
            formContainer.classList.add('hidden');
        });

        reservaDataLink.addEventListener('click', function(event) {
            event.preventDefault();
            reservaDataDiv.classList.remove('hidden');
            clienteDataDiv.classList.add('hidden');
            reservaTitleLink.classList.remove('hidden');
            clienteTitleLink.classList.add('hidden');
            dataContainer.classList.remove('hidden');
            document.getElementById('delete-form').classList.add('hidden');
            formContainer.classList.add('hidden');
        });

        document.querySelectorAll('#back-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                formContainer.classList.add('hidden');
                dataContainer.classList.remove('hidden');
                document.getElementById('delete-form').classList.add('hidden');
            }); 
        });

        clienteDataDiv.classList.remove('hidden');
        clienteTitleLink.classList.remove('hidden');
    });
</script>
</body>
</html>