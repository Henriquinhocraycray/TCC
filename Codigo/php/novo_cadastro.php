<?php
    include('conexao.php');
    include('header.php');
    include('protecao.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Reserva</title>
    <link rel="stylesheet" type="text/css" media='screen' href="../css/novo_cadastro.css">
</head>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
$(document).ready(function() {
    $('#cpf').mask('000.000.000-00');
    $('#telefone').mask('(00) 00000-0000');
    $('#preco').mask('#,##0.00', {reverse: true});
    $('#n_reserva').mask('0000');
    $('#n_pessoas').mask('0');
    
    // Função para atualizar os quartos no select com base no tipo de reserva
    function atualizarQuartos(tipoReserva) {
        $.ajax({
            url: 'get_quartos.php',
            method: 'GET',
            data: { tipo: tipoReserva },
            success: function(response) {
                $('#id_quarto').html(response);
            }
        });
    }

    $('#tipo_reserva').change(function() {
        var tipoReserva = $(this).val();
        atualizarQuartos(tipoReserva);

        // Configurações para o número de pessoas
        if (tipoReserva === 'solteiro') {
            $('#n_pessoas').val(1);
            $('#n_pessoas').attr('readonly', true);
        } else if (tipoReserva === 'casal') {
            $('#n_pessoas').val(2);
            $('#n_pessoas').attr('readonly', true);
        } else if (tipoReserva === 'familia') {
            $('#n_pessoas').val(1);
            $('#n_pessoas').attr('readonly', false);
            $('#n_pessoas').attr('max', 6);
        }
    });

    var tipoInicial = $('#tipo_reserva').val();
    atualizarQuartos(tipoInicial);
});
</script>
<body>

<?php
    $sql_quartos = "SELECT id_quarto, numero, tipo, preco_noite, status FROM Quartos WHERE status = 'Disponível'";
    $result_quartos = $mysqli->query($sql_quartos);
?>

<div class="novoc-maindiv">
    <h1>SUA POUSADA</h1>
    <h3>Novo Cadastro</h3>

    <form action="inserir.php" method="POST">
        <div class="novoc-subdiv">
            <div class="novoc-div">
                <h2 align="center">Dados do Cliente</h2>
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" required>

                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" required>
            </div>

            <div class="novoc-div">
                <h2 align="center">Dados da Reserva</h2>
                <label for="n_reserva">Nº da Reserva:</label>
                <input type="text" id="n_reserva" name="n_reserva" required>

                <label for="tipo_reserva">Tipo de Reserva:</label>
                <select id="tipo_reserva" name="tipo_reserva" required>
                    <option value="solteiro">Solteiro</option>
                    <option value="casal">Casal</option>
                    <option value="familia">Família</option>
                </select>

                <label for="n_pessoas">Nº de Pessoas:</label>
                <input type="number" id="n_pessoas" name="n_pessoas" required>

                <label for="data_checkin">Data de Check-in:</label>
                <input type="date" id="data_checkin" name="data_checkin" required>

                <label for="data_checkout">Data de Check-out:</label>
                <input type="date" id="data_checkout" name="data_checkout" required>

                <label for="pedido">Pedido Especial:</label>
                <input type="text" id="pedido" name="pedido">

                <label for="id_quarto">Escolha o Quarto:</label>
                <select id="id_quarto" name="id_quarto" required>
                    <?php
                    // Exibe os quartos disponíveis
                    if ($result_quartos->num_rows > 0) {
                        while ($row = $result_quartos->fetch_assoc()) {
                            echo "<option value='" . $row['id_quarto'] . "'>Quarto Nº " . $row['numero'] . " - " . $row['tipo'] . " - R$ " . number_format($row['preco_noite'], 2, ',', '.') . "</option>";
                        }
                    } else {
                        echo "<option value=''>Nenhum quarto disponível</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="novoc-btndiv">
            <a href="dados_gerais.php">
                <button id="btn-novoc-back" type="button">Voltar</button>
            </a>
            <button id="btn-novoc-c" type="submit">Confirmar</button>
        </div>
    </form>
</div>

</body>
</html>