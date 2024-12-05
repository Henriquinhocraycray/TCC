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
$sql = "
SELECT r.id_reserva, r.data_checkin, r.data_checkout, r.total, 
       c.nome AS cliente_nome, c.email AS cliente_email, 
       q.numero AS quarto_numero, q.tipo AS quarto_tipo, q.preco_noite AS preco_noite
FROM Reservas r
JOIN Clientes c ON r.id_cliente = c.id_cliente
JOIN Quartos q ON r.id_quarto = q.id_quarto
";

$result = $mysqli->query($sql);

if ($result === false) {
echo "Error: " . $mysqli->error;
exit;
}

if ($result->num_rows > 0) {
echo '<table class="main-table">';
echo '<tr>
<th>Nº da Reserva</th>
<th>Nome do Cliente</th>
<th>Quarto Nº</th>
<th>Tipo de Quarto</th>
<th>Data de Check-in</th>
<th>Data de Check-out</th>
<th>Preço Total</th>
<th>Ver Detalhes</th>
</tr>'; 

while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['id_reserva']) . '</td>';
    echo '<td>' . htmlspecialchars($row['cliente_nome']) . '</td>';
    echo '<td>' . htmlspecialchars($row['quarto_numero']) . '</td>';
    echo '<td>' . htmlspecialchars($row['quarto_tipo']) . '</td>';
    echo '<td>' . htmlspecialchars($row['data_checkin']) . '</td>';
    echo '<td>' . htmlspecialchars($row['data_checkout']) . '</td>';
    echo '<td>' . htmlspecialchars($row['total']) . '</td>';
    echo '<td><a href="detalhes.php?id=' . urlencode($row['id_reserva']) . '">Ver Detalhes</a></td>';
    echo '</tr>';
}

echo '</table>';
} else {
echo "No records found.";
}

include('footer.php');

$mysqli->close();
?>