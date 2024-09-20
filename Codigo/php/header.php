<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamburger Menu</title>
    <link rel="stylesheet" type="text/css" media='screen' href="../css/header1.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div>
                <img class="logo_img" src="" alt="">
            </div>
            <div class="op">
                <a href="#">Página inicial</a>
            </div>
            <div class="op">
                <a href="#">Dados da empresa</a>
            </div>
            <div class="op">
                <a href="#">Dados gerais</a>
            </div>

            <div class="off-screen-menu">
                <div class="menu-list">
                    <ul style="list-style: none; padding:none;">
                    
                        <li href="#">Termos de condições de uso</li>
                        <br>
                        <br>
                        <li>Configurações da conta</li>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="uop">
                            <li>Sair</li>
                        </div>
                    </ul>
                </div>
            </div>

            <nav>
                <div class="ham-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>

        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hamMenu = document.querySelector('.ham-menu');
            const offScreenMenu = document.querySelector('.off-screen-menu');

            hamMenu.addEventListener('click', () => {
                hamMenu.classList.toggle('active');
                offScreenMenu.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
