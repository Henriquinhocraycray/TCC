<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Funcionário</title>
    <link rel="stylesheet" href="../css/login1.css">
</head>
<body>
<div class="container">
        <div class="login-box">
            <h2>Login de funcionário</h2>
            
<?php
    include('conexao.php');

    if( isset($_POST['credencial']) || isset($_POST['senha'])) {
        if (strlen($_POST['credencial']) == 0) {

            echo '<script>alert("Preencha suas credenciais");</script>';


        } else if(strlen($_POST['senha']) == 0){

            echo '<script>alert("Preencha sua senha");</script>';

        } else {

            $credencial = $mysqli->real_escape_string($_POST['credencial']);
            $senha = $mysqli->real_escape_string($_POST['senha']);


            $sql_code = "SELECT * FROM usuario WHERE credencial = '$credencial' AND  senha = '$senha'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução    do código SQL: " . $mysqli->error);

            $quantidade = $sql_query->num_rows;

            if($quantidade == 1) {

                $usuario = $sql_query->fetch_assoc();

                echo "<script>alert('Login bem sucedido!');</script>";
            } else {
                echo "<script>alert('Falha ao logar! Email ou senha     incorretos');</script>";
            }
        }
    }

?>

            <form action="login.php" method="POST">
                <label for="numero-funcionario">Informe suas credenciais (Nº F)</label>
                <input type="text" id="numero-funcionario" name="credencial" required>
                
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
                
                <a href="#" class="forgot-password">Esqueceu a senha?</a>
                
                <a href="#" class="register-link">Não tem licença ainda?</a>
                <button type="submit" name="submit">Clique aqui!</button>
            </form>
        </div>
        <div class="right-box">
            <p>MEU BANCO DE DADOS!</p>
        </div>
    </div>
</body>
</html>