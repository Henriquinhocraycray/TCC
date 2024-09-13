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
<body>

<?php
include('header.php');
?>

<div class="det-maindiv">

    <div class="det-div1">
        <div class="det-subdiv">
            <a href="home.php"><img src="../img/seta.png" alt="Back"></a>
            <a href="#" id="cliente-data-link">
                <div class="det-optdiv">Dados do Cliente</div>
            </a>
            <a href="#" id="reserva-data-link">
                <div class="det-optdiv">Informações da Reserva</div>
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

            $sql = "SELECT * FROM cliente WHERE id = '$id'";
            $result = $mysqli->query($sql);

            if ($result === false) {
                die("Error: " . $mysqli->error);
            }

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo '<div id="data-container">';
                echo '<div id="cliente-title-link" class="hidden"><h2>Dados do Cliente</h2><br></div>';
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
                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
                    echo '<h3>Nome Completo</h3>';
                    echo '<p><input type="text" name="nome" value="' . htmlspecialchars($row['nome']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>CPF</h3>';
                    echo '<p><input type="text" name="cpf" value="' . htmlspecialchars($row['cpf']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>E-mail</h3>';
                    echo '<p><input type="email" name="email" value="' . htmlspecialchars($row['email']) . '"></p>';
                    echo '<hr>';
                    echo '<h3>Telefone</h3>';
                    echo '<p><input type="text" name="telefone" value="' . htmlspecialchars($row['telefone']) . '"></p>';
                    echo '<hr>';
                    echo '<button id="back-btn" type="button">Voltar</button>';
                    echo '<button type="submit">Salvar Alterações</button>';
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
        });

        reservaDataLink.addEventListener('click', function(event) {
            event.preventDefault();
            reservaDataDiv.classList.remove('hidden');
            clienteDataDiv.classList.add('hidden');
            reservaTitleLink.classList.remove('hidden');
            clienteTitleLink.classList.add('hidden');
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