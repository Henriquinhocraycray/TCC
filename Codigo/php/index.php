<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Funcionário</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
        <div class="login-box">
            <h2>Login de funcionário</h2>
            
            <?php
            if (isset($_POST['submit'])) {
                $usuario = $_POST['numero-funcionario'];
                $senha = $_POST['senha'];
            
                // Simulação de verificação de login
                if ($usuario === 'admin' && $senha === '1234') {
                    echo "<p style='color:green;'>Login bem-sucedido!</p>";
                } else {
                    echo "<p style='color:red;'>Número de funcionário ou senha incorretos!</p>";
                }
            }
            ?>

            <form action="index.php" method="POST">
                <label for="numero-funcionario">Informe suas credenciais (Nº F)</label>
                <input type="text" id="numero-funcionario" name="numero-funcionario" required>
                
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