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
        echo '<p>Nº da Reserva: ' . htmlspecialchars($row['n_reserva']) . '</p>';
        echo '<p>Tipo de Reserva: ' . htmlspecialchars($row['tipo_reserva']) . '</p>';
        echo '<p>Nº de Pessoas: ' . htmlspecialchars($row['n_pessoas']) . '</p>';
        echo '<p>CPF: ' . htmlspecialchars($row['cpf']) . '</p>';
        echo '<p>E-mail: ' . htmlspecialchars($row['email']) . '</p>';
        echo '<p>Nome Completo: ' . htmlspecialchars($row['nome']) . '</p>';
        echo '<p>Telefone: ' . htmlspecialchars($row['telefone']) . '</p>';
        echo '<p>Pedido Especial: ' . htmlspecialchars($row['pedido']) . '</p>';
        echo '<p>Preço Total: ' . htmlspecialchars($row['preco']) . '</p>';
    } else {
        echo '<p>No details found for this ID.</p>';
    }
} else {
    echo '<p>No ID provided.</p>';
}

// Close the database connection
$mysqli->close();
?>