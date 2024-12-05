<?php
include('conexao.php');

if (isset($_GET['tipo'])) {
    $tipo_reserva = $_GET['tipo'];

    // Preparar a consulta para buscar quartos com base no tipo
    $sql_quartos = "SELECT id_quarto, numero, tipo, preco_noite FROM Quartos WHERE tipo = ? AND status = 'Disponível'";
    $stmt = $mysqli->prepare($sql_quartos);
    $stmt->bind_param('s', $tipo_reserva);
    $stmt->execute();
    $result_quartos = $stmt->get_result();

    if ($result_quartos->num_rows > 0) {
        while ($row = $result_quartos->fetch_assoc()) {
            echo "<option value='" . $row['id_quarto'] . "'>Quarto Nº " . $row['numero'] . " - " . $row['tipo'] . " - R$ " . number_format($row['preco_noite'], 2, ',', '.') . "</option>";
        }
    } else {
        echo "<option value=''>Nenhum quarto disponível</option>";
    }

    $stmt->close();
} else {
    echo "<option value=''>Selecione o tipo de reserva</option>";
}

$mysqli->close();
?>