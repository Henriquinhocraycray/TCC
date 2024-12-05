<a?php
// termos.php
$title = "home";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="../css/home.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body> <!-- Move a tag body para cá -->

    <?php
        include('header.php');
    ?>
    
    <main>
        <div id="carrosselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../Pousadas/pousada3.jpg" class="d-block w-100" alt="Imagem 1">
                </div>
                <div class="carousel-item">
                    <img src="../Pousadas/pousada2.jpg" class="d-block w-100" alt="Imagem 2">
                </div>
                <div class="carousel-item">
                    <img src="../Pousadas/pousada.jpg" class="d-block w-100" alt="Imagem 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carrosselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carrosselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        </div>

        <div class="container mt-5">
            <section class="nossos-planos">
                <h2>Nossos Planos</h2>
                <hr>
                <p>
                  A LaR Database oferece dois planos distintos para atender às necessidades de diferentes tipos de pousadas: o Plano Padrão e o Plano Completo. Cada plano foi desenvolvido com foco na simplicidade e eficiência para otimizar a gestão de dados e operações.

Plano Padrão
  O Plano Padrão é ideal para pousadas de pequeno a médio porte que buscam uma solução prática e acessível. Ele oferece funcionalidades essenciais para o gerenciamento de reservas, clientes e informações de pagamentos, com uma interface simples e fácil de usar. Além disso, os dados são armazenados com segurança, permitindo que os proprietários acessem informações críticas de forma rápida e eficiente. Este plano é perfeito para quem está começando ou para aqueles que não necessitam de recursos avançados, mas desejam um sistema robusto para organização e controle.<br>

Plano Completo
  O Plano Completo é voltado para pousadas de médio a grande porte ou para aquelas que necessitam de mais funcionalidades e personalização. Ele oferece todos os recursos do Plano Padrão, mas com benefícios adicionais como relatórios detalhados, integração com outros sistemas de gestão, personalização avançada e suporte prioritário. Este plano é ideal para empresas que buscam expandir suas operações e otimizar ainda mais seus processos, oferecendo uma solução mais integrada e com mais ferramentas para análise de dados e controle operacional.<br>

  
                  </p>
                  <a href="licenca.php">Ver Licenças</a>
            </section>
            
            <section class="sobre-nos mt-5">
                <h2>Sobre Nós</h2>
                <hr>
                <p>
                A LaR Database é uma empresa especializada no fornecimento de soluções de banco de dados para o setor de hospedagem de pousadas. Nosso objetivo é otimizar a gestão de informações, oferecendo plataformas seguras e eficientes para o armazenamento e organização de dados relacionados a reservas, clientes e operações diárias. Com um compromisso firme com a inovação, garantimos que pousadas de diferentes portes tenham acesso a tecnologias avançadas, simplificando processos e promovendo um atendimento mais ágil e personalizado para seus hóspedes.
                </p>
            </section>
        </div>
    </main>

    <?php
        include('footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body> <!-- Fechando a tag body -->
</html>
