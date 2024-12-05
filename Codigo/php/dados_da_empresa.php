<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados da Empresa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .navbar a.active {
            background-color: #b19cd9;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #666;
        }

        .form-container {
            background-color: #5d2d91;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        .form-container button {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container button:first-child {
            background-color: #000;
            color: #fff;
        }

        .form-container button:last-child {
            background-color: #b19cd9;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#">Página Inicial</a>
        <a href="#" class="active">Dado da Pousada</a>
        <a href="#">Dados Gerais</a>
    </div>

    <div class="container">
        <h1>Dados da Empresa</h1>
        <h2>Pousada Tal</h2>
        <div class="form-container">
            <form action="processa_dados.php" method="POST">
                <input type="text" name="razao_social" placeholder="Razão Social" required>
                <input type="text" name="nome_responsavel" placeholder="Nome do Responsável" required>
                <input type="text" name="nome_pousada" placeholder="Nome da Pousada" required>
                <input type="text" name="endereco" placeholder="Endereço" required>
                <input type="text" name="numero" placeholder="Número" required>
                <input type="text" name="complemento" placeholder="Complemento">
                <input type="text" name="cep" placeholder="CEP" required>
                <input type="email" name="email" placeholder="E-mail" required>

                <div style="display: flex; justify-content: space-between;">
                    <button type="button" onclick="alert('Comprar uma licença em breve!')">Comprar uma licença</button>
                    <button type="submit">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
