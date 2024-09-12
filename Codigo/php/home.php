<?php
include('conexao.php');

$sql = "SELECT * FROM cliente"; 

$result = $mysqli->query($sql);

if ($result === false) {
    echo "Error: " . $mysqli->error;
    exit;
}

if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr>
    <th>Nº da Reserva</th>
    <th>Tipo de Reserva</th>
    <th>Nº de Pessoas</th>
    <th>CPF</th>
    <th>E-mail</th>
    <th>Nome Completo</th>
    <th>Telefone</th>
    <th>Pedido Especial</th>
    <th>Preço Total</th>
    </tr>'; 

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['n_reserva']) . '</td>';
        echo '<td>' . htmlspecialchars($row['tipo_reserva']) . '</td>';
        echo '<td>' . htmlspecialchars($row['n_pessoas']) . '</td>';
        echo '<td>' . htmlspecialchars($row['cpf']) . '</td>';
        echo '<td>' . htmlspecialchars($row['email']) . '</td>';
        echo '<td>' . htmlspecialchars($row['nome']) . '</td>';
        echo '<td>' . htmlspecialchars($row['telefone']) . '</td>';
        echo '<td>' . htmlspecialchars($row['pedido']) . '</td>';
        echo '<td>' . htmlspecialchars($row['preco']) . '</td>'; 
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "No records found.";
}

$mysqli->close();
?>