<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" media='screen' href="../css/home.css">
</head>
<?php
include('conexao.php');
include('header.php');

include('protecao.php');
?>

<br>
<br>
<h1 align="center">Pousada Tal</h1>

<a id="home-head" href="novo_cadastro.php">
<div class="home-head">
<h3>+ Novo Cadastro</h3>
</div>
</a>

<?php
$sql = "SELECT * FROM cliente"; 

$result = $mysqli->query($sql);

if ($result === false) {
    echo "Error: " . $mysqli->error;
    exit;
}

if ($result->num_rows > 0) {
    echo '<table class="main-table">';
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
        echo '<td><a href="detalhes.php?id=' . urlencode($row['id']) . '">Ver Detalhes</a></td>';

        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "No records found.";
}

include('footer.php');

$mysqli->close();
?>