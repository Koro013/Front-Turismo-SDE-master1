<?php
require 'db.php';
$categoria = $_GET['categoria'] ?? '';
$sql = 'SELECT r.id, r.nombre, r.descripcion,
               MIN(d.categoria) AS categoria,
               SUM(d.duracion) AS duracion,
               SUM(d.costo) AS costo
        FROM recorridos r
        JOIN recorrido_destinos rd ON r.id = rd.recorrido_id
        JOIN destinos d ON d.id = rd.destino_id';
$params = [];
if ($categoria) {
    $sql .= ' WHERE d.categoria = ?';
    $params[] = $categoria;
}
$sql .= ' GROUP BY r.id';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$recorridos = $stmt->fetchAll();
$catStmt = $pdo->query('SELECT DISTINCT categoria FROM destinos');
$categorias = $catStmt->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recorridos - Turismo - Santiago del Estero</title>
  <link rel="icon" href="./img/favico/favico.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/recorridos-style.css">
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
    <form method="get" class="row mb-4">
      <div class="col-auto">
        <select name="categoria" class="form-select">
          <option value="">Todas las categorías</option>
          <?php foreach ($categorias as $c): ?>
          <option value="<?= htmlspecialchars($c) ?>" <?= $c == $categoria ? 'selected' : '' ?>><?= htmlspecialchars($c) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary">Filtrar</button>
      </div>
    </form>
    <section class="row justify-content-evenly ms-1 me-1">
      <?php foreach ($recorridos as $r): ?>
      <a href="recorrido.php?id=<?= $r['id'] ?>" class="text-decoration-none text-dark col-lg-3 p-0 me-lg-3 mb-lg-3 mb-3 col-md-12">
        <div class="card btn btn-light h-100 tarjeta-recorrido">
          <img src="./img/pelota.svg" class="card-img-top p-5 tarjeta-imagen" alt="Icono">
          <div class="card-body">
            <p class="card-text fs-2 mb-1"><?= htmlspecialchars($r['nombre']) ?></p>
            <div class="roboto-300">
              <p class="card-text text-start fs-5"><strong>Duración:</strong> <?= (int)$r['duracion'] ?> min</p>
              <p class="card-text text-start fs-5"><strong>Costo:</strong> $<?= number_format($r['costo'],2) ?></p>
              <p class="card-text text-start fs-5"><?= htmlspecialchars($r['descripcion']) ?></p>
            </div>
          </div>
        </div>
      </a>
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
