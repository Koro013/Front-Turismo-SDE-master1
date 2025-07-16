<?php
require 'db.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;

$routeId = isset($_GET['route']) ? (int)$_GET['route'] : 1;

$destinosStmt = $pdo->prepare(
    "SELECT d.Nombre FROM destinos d
     JOIN rutas_lugares rl ON rl.IdLugar = d.IdLugar
     WHERE rl.IdRecorrido = :routeId LIMIT 3"
);
$destinosStmt->execute(['routeId' => $routeId]);
$destinos = $destinosStmt->fetchAll();

$rutaStmt = $pdo->prepare("SELECT Duracion, CostoDelRecorrido FROM rutas WHERE IdRecorrido = :routeId LIMIT 1");
$rutaStmt->execute(['routeId' => $routeId]);
$ruta = $rutaStmt->fetch();

$html = '<h1>Planificador</h1>';
$html .= '<ul>';
foreach ($destinos as $d) {
    $html .= '<li>'.htmlspecialchars($d['Nombre']).'</li>';
}
$html .= '</ul>';
$html .= '<p>Duración estimada: '.htmlspecialchars($ruta['Duracion']).' min</p>';
$html .= '<p>Costo total: $'.htmlspecialchars($ruta['CostoDelRecorrido']).'</p>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('planificador.pdf', ['Attachment' => false]);
?>

