<?php
require 'db.php';
require 'helper_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $date_issued = $_POST['date_issued'];
  $unique_number = str_random(20);

  $stmt = $pdo->prepare('INSERT INTO certificates (name, date_issued, unique_number, created_at) VALUES (?, ?, ?, NOW())');
  $stmt->execute([$name, $date_issued, $unique_number]);

  $id = $unique_number;
  header("Location: generate_pdf.php?id=$id");
}
