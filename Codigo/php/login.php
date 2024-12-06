<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Funcionário</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
<div class="container">
        <div class="login-box">
            <h2>Login de funcionário</h2>
            
<?php
    include('conexao.php');

    if( isset($_POST['registro_func']) || isset($_POST['senha'])) {
        if (strlen($_POST['registro_func']) == 0) {

            echo '<script>alert("Preencha seu registro!");</script>';


        } else if(strlen($_POST['senha']) == 0){

            echo '<script>alert("Preencha sua senha");</script>';

        } else {

            $registro_func = $mysqli->real_escape_string($_POST['registro_func']);
            $senha = $mysqli->real_escape_string($_POST['senha']);


            $sql_code = "SELECT * FROM usuario WHERE registro_func = '$registro_func' AND  senha = '$senha'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução    do código SQL: " . $mysqli->error);

            $quantidade = $sql_query->num_rows;

            if($quantidade == 1) {
                $usuario = $sql_query->fetch_assoc();

                session_start();

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['registro_func'] = $usuario['registro_func']; 
                $_SESSION['nome'] = $usuario['nome']; 
                $_SESSION['cargo'] = $usuario['cargo'];

                echo "<script>alert('Login bem sucedido!');</script>";
                echo '<script>window.location.href="dados_gerais.php";</script>';
            } else {
                echo "<script>alert('Falha ao logar! Registro ou senha incorretos');</script>";
            }
        }
    }

?>
            <form action="login.php" method="POST">
                <label for="numero-funcionario">Informe seu registro de funcionário (Nº F)</label>
                <input type="text" id="numero-funcionario" name="registro_func" required>
                
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
                
                <a href="#" class="forgot-password">Esqueceu a senha?</a>
                
                <a href="#" class="register-link">Não tem licença ainda?</a>
                <button type="submit" name="submit">Clique aqui!</button>
            </form>
        </div>
        <div class="right-box">
            <p>LaR DATABASE!</p>
        </div>
    </div>
</body>
</html>