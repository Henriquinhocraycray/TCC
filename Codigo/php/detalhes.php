<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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
        <a href="home.php"><img src="../img//seta.png"></a>
        <a href="#" id="cliente-data-link">Dados do Cliente</a>
        <a href="#" id="reserva-data-link">Informações da Reserva</a>
        <hr>
        <button id="btn-mod">Modificar Informações</button>
        <button id="btn-del">Excluir Informações</button>
        </div>
    </div>

    <div class="det-div2">
        <h1>SUA POUSADA</h1>
        <img src="">
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

            echo '<h1>Detalhes da Reserva</h1>';

            echo '<div id="cliente-data" class="hidden">';
            echo '<p>CPF: ' . htmlspecialchars($row['cpf']) . '</p>';
            echo '<p>E-mail: ' . htmlspecialchars($row['email']) . '</p>';
            echo '<p>Nome Completo: ' . htmlspecialchars($row['nome']) . '</p>';
            echo '<p>Telefone: ' . htmlspecialchars($row['telefone']) . '</p>';
            echo '</div>';

            echo '<div id="reserva-data" class="hidden">';
            echo '<p>Nº da Reserva: ' . htmlspecialchars($row['n_reserva']) . '</p>';
            echo '<p>Tipo de Reserva: ' . htmlspecialchars($row['tipo_reserva']) . '</p>';
            echo '<p>Nº de Pessoas: ' . htmlspecialchars($row['n_pessoas']) . '</p>';
            echo '<p>Pedido Especial: ' . htmlspecialchars($row['pedido']) . '</p>';
            echo '<p>Preço Total: ' . htmlspecialchars($row['preco']) . '</p>';
            echo '</div>';
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
        const clienteDataDiv = document.getElementById('cliente-data');
        const reservaDataDiv = document.getElementById('reserva-data');

        clienteDataLink.addEventListener('click', function(event) {
            event.preventDefault();
            clienteDataDiv.classList.remove('hidden');
            reservaDataDiv.classList.add('hidden');
        });

        reservaDataLink.addEventListener('click', function(event) {
            event.preventDefault();
            reservaDataDiv.classList.remove('hidden');
            clienteDataDiv.classList.add('hidden');
        });

        // Optionally show one section by default
        clienteDataDiv.classList.remove('hidden');
    });
</script>

</body>
</html>