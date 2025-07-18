<?php
require 'db.php';
require 'vendor/autoload.php';
use Dompdf\Dompdf;

$ids = [];
if (!empty($_GET['ids'])) {
    foreach (explode(',', $_GET['ids']) as $id) {
        $ids[] = (int)$id;
    }
}
if (!$ids) {
    echo 'No se seleccionaron destinos';
    exit;
}
$in = implode(',', array_fill(0, count($ids), '?'));
$stmt = $pdo->prepare("SELECT nombre, costo, duracion FROM destinos WHERE id IN ($in)");
$stmt->execute($ids);
$destinos = $stmt->fetchAll();
$totalCosto = 0;
$totalDuracion = 0;
$html = '<h1>Planificador</h1><ul>';
foreach ($destinos as $d) {
    $html .= '<li>'.htmlspecialchars($d['nombre']).'</li>';
    $totalCosto += $d['costo'];
    $totalDuracion += $d['duracion'];
}
$html .= '</ul>';
$html .= '<p>Duraci\u00f3n total: '. $totalDuracion .' min</p>';
$html .= '<p>Costo total: $'. $totalCosto .'</p>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('planificador.pdf', ['Attachment' => false]);
