<?php
include('protecao.php');

session_destroy(); 
echo '<h1>Sessão terminada com sucesso!';
echo '<script>
    setTimeout(function() {
        window.location.href = "login.php";
    }, 4000);
</script>';

?>