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

        .container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: #421c88;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .form-container input {
            outline: none;
            border: 0;
            border-bottom: 1px solid #fff;
            border-radius: 0px;
            background: #421c88;
            width: 97%;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            color: #fff;
        }

        .form-container input:disabled {
            background-color: #e0e0e0;
            cursor: not-allowed;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button-container a {
            text-decoration: none;
            width: 40%;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            display: block;
        }

        .button-container a:first-child {
            background-color: #000;
            color: #fff;
        }
        .button-container a:first-child:hover{
            transition: 0.5s;
            background-color: #2c135a;
        }
        .button-container a:last-child {
            background-color: #b19cd9;
            color: #000;
        }
        .button-container a:last-child:hover{
            transition: 0.5s;
            background-color: #dedae6;
        }
    </style>
</head>
<body>

<?php
    include('header.php');
?>

<div class="container">
    <h1>Dados da Empresa</h1>
    <h2 class="h2">*Nome da Pousada*</h2>
    <div class="form-container">
        
        <input type="text" value="Razão Social" placeholder="Razão Social">
        <input type="text" value="Nome do Responsável" placeholder="Nome do Responsável">
        <input type="text" value="Nome da Pousada" placeholder="Nome da Pousada">
        <input type="text" value="Endereço" placeholder="Endereço">
        <input type="text" value="Número" placeholder="Número">
        <input type="text" value="Complemento" placeholder="Complemento">
        <input type="text" value="CEP" placeholder="CEP">
        <input type="email" value="E-mail" placeholder="E-mail">
        
        <!-- Links para as páginas -->
        <div class="button-container">
            <!-- Link para 'licenca.php' -->
            <a href="licenca.php" class="btn-licenca">Comprar uma licença</a>

            <!-- Link para 'dados_gerais.php' -->
            <a href="dados_gerais.php" class="btn-confirmar">Confirmar</a>
        </div>
    </div>
</div>

<?php
    include('footer.php');
?>

</body>
</html>
