<?php
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

    <?php
        include('header.php');
    ?>
    
    <main>
        <body>
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
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </p>
            </section>
            
            <section class="sobre-nos mt-5">
                <h2>Sobre Nós</h2>
                <hr>
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </p>
            </section>
        </div>
    </main>
</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        <?php
            include('footer.php');
        ?>
</body>
</html>
