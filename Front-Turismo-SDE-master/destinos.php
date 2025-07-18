<?php
require 'db.php';
$stmt = $pdo->query('SELECT * FROM destinos');
$destinos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destinos - Turismo - Santiago del Estero</title>
  <link rel="icon" href="./img/favico/favico.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/destinos-style.css">
</head>
<body class="bg-body bebas-neue-regular">
  <header>
    <nav class="navbar bg-dark border-body navbar-expand-lg" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand text-light ms-3" href="#"><img id="navLogo" class="img-fluid" src="./img/santiago-logo.png" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link text-light pe-5 me-5 fs-3" href="index.html">Inicio</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main class="container pt-5">
    <section class="row justify-content-start ms-1 me-1">
      <?php foreach ($destinos as $d): ?>
      <div class="card btn btn-light col-lg-3 p-0 me-lg-3 mb-lg-3 mb-3 col-md-12 tarjeta-destinos">
        <img src="<?= $d['imagen'] ?>" class="card-img-top tarjeta-imagen" alt="<?= htmlspecialchars($d['nombre']) ?>">
        <div class="card-body">
          <p class="card-text fs-3"><?= htmlspecialchars($d['nombre']) ?></p>
          <p class="roboto-300">Duración: <?= (int)$d['duracion'] ?> min<br>Costo: $<?= number_format($d['costo'],2) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </section>
  </main>

  <footer class="container-fluid separacion-texto mt-4">
    <div class="row align-items-end">
      <div class="col card-footer text-center text-light bg-dark p-4">
        &copy; Turismo - Santiago del Estero
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
