<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo '<h1>Você não está logado!</h1>';
    echo '<h2>Redirecionando para o login...</h2>';
    echo '<script>
    setTimeout(function() {
        window.location.href = "login.php";
    }, 4000);
    </script>';
    exit();
}
?>