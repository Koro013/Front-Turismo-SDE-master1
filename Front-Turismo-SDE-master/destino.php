<?php
require 'db.php';
$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare('SELECT * FROM destinos WHERE id = ?');
$stmt->execute([$id]);
$dest = $stmt->fetch();
if (!$dest) {
    die('Destino no encontrado');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($dest['nombre']) ?> - Turismo</title>
  <link rel="icon" href="./img/favico/favico.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="./css/destino-style.css">
</head>
<body class="bg-body bebas-neue-regular">
<header>
  <nav class="navbar bg-dark border-body navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand text-light ms-3" href="index.html"><img id="navLogo" class="img-fluid" src="./img/santiago-logo.png" alt="Logo"></a>
    </div>
  </nav>
</header>
<main class="container pt-5">
  <div class="row mb-4">
    <div class="col-md-6">
      <img src="<?= $dest['imagen'] ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($dest['nombre']) ?>">
    </div>
    <div class="col-md-6">
      <h1 class="mb-3" style="font-size:3em;"><?= htmlspecialchars($dest['nombre']) ?></h1>
      <p><?= htmlspecialchars($dest['descripcion']) ?></p>
      <p><strong>Categoría:</strong> <?= htmlspecialchars($dest['categoria']) ?></p>
      <p><strong>Horario:</strong> <?= htmlspecialchars($dest['horario']) ?></p>
      <p><strong>Duración:</strong> <?= (int)$dest['duracion'] ?> min</p>
      <p><strong>Costo:</strong> $<?= number_format($dest['costo'],2) ?></p>
    </div>
  </div>
  <div id="map" style="height:400px"></div>
</main>
<footer class="container-fluid separacion-texto mt-4">
  <div class="row align-items-end">
    <div class="col card-footer text-center text-light bg-dark p-4">
      &copy; Turismo - Santiago del Estero
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const map = L.map('map').setView([<?= $dest['latitud'] ?>, <?= $dest['longitud'] ?>], 15);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap contributors' }).addTo(map);
L.marker([<?= $dest['latitud'] ?>, <?= $dest['longitud'] ?>]).addTo(map);
</script>
</body>
</html>
