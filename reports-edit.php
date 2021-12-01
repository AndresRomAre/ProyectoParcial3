<?php

session_start();

require_once('connection.php');

$errors = [];

if (!isset($_POST['typeInput']) || empty($_POST['typeInput'])) {
  $errors[] = 'Tipo requerido';
}

if (!isset($_POST['locationInput']) || empty($_POST['locationInput'])) {
  $errors[] = 'Alcaldía requerida';
}

if (count($errors) > 0) {
  header('Location: /report.php?message=' . $errors[0]);
  exit();
}

$id = $_POST['idInput'];
$type = $_POST['typeInput'];
$location = $_POST['locationInput'];
$notes = null;
$image = null;
$descripcion = null;
$userId = $_POST['idUsuarioInput'];
$latitud = $_POST['latitudeInput'];
$longitud = $_POST['longitudeInput'];


if (isset($_POST['notesInput']) && !empty($_POST['notesInput'])) {
  $notes = $_POST['notesInput'];
}

if (isset($_POST['descripcionInput']) && !empty($_POST['descripcionInput'])) {
  $descripcion = $_POST['descripcionInput'];
}

if (!empty($_FILES['imageInput']['tmp_name'])) {

  $hashName = null;
  $folder = 'assets/img/';
  $extension = strtolower(pathinfo($_FILES['imageInput']['name'], PATHINFO_EXTENSION));
  $hashName = hash('sha512', microtime(true)) . '.' . $extension;
  $imagePath = $folder . $hashName;
  $allowedExt = [
    'png',
    'jpg',
    'jpeg'
  ];

  if (!in_array($extension, $allowedExt)) {
    header('Location: /report.php?message=Archivo(s) no valido(s)');
    exit();
  }

  if (move_uploaded_file($_FILES['imageInput']['tmp_name'], $imagePath)) {
    $image = $hashName;
  }
}

try {

  $dbMarker = db();
  $sql = $dbMarker->prepare('
    UPDATE markers SET location = ? WHERE id = ?
  ');
  $execute = $sql->execute([
    $location, $userId
  ]);

  $sql = db()->prepare('
      UPDATE reports SET notes = ?, image = ?, descripcion = ?, latitude = ?, longitude = ?, WHERE id = ? 
    ');

  $execute = $sql->execute([
    $notes, $image, $descripcion, $latitud, $longitud, $id
  ]);


  header('Location: /report.php?message=Reporte guardado correctamente');
  exit();
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
}
