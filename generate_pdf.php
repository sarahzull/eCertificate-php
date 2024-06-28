<?php
require 'vendor/autoload.php';
require 'db.php';

use Dompdf\Dompdf;

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM certificates WHERE unique_number = ?');
$stmt->execute([$id]);
$certificate = $stmt->fetch();

if ($certificate) {
    $date = new DateTime($certificate['date_issued']);
    $formatted_date = $date->format('d F Y');

    $html = file_get_contents('templates/certificate_template.html');
    $html = str_replace('{{name}}', $certificate['name'], $html);
    $html = str_replace('{{date_issued}}', $formatted_date, $html);
    $html = str_replace('{{unique_number}}', $certificate['unique_number'], $html);

    $filename = $certificate['unique_number']. '.pdf';

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream($filename, ['Attachment' => false]);

} else {
    echo "Certificate not found.";
}
?>