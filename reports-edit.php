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

$id = $_POST['idInput'];

if (count($errors) > 0) {
  header('Location: /reporteAdmin.php?id=' . $id . '&message=' . $errors[0]);
  exit();
}

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

if (isset($_POST['imageNameInput']) && !empty($_POST['imageNameInput'])) {
  $image = $_POST['imageNameInput'];
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
    header('Location: /reporteAdmin.php?id=' . $id . '&message=Archivo(s) no valido(s)');
    exit();
  }

  if (move_uploaded_file($_FILES['imageInput']['tmp_name'], $imagePath)) {
    $image = $hashName;
  }
}

try {

  $dbMarker = db();
  $sql = $dbMarker->prepare('
    UPDATE markers SET location = ?, latitude = ?, longitude = ? WHERE id = ?
  ');
  $execute = $sql->execute([
    $location, $latitud, $latitud, $id
  ]);

  $sql = db()->prepare('
      UPDATE reports SET notes = ?, image = ?, descripcion = ? WHERE id = ? 
    ');

  $execute = $sql->execute([
    $notes, $image, $descripcion, $userId
  ]);


  header('Location: /reporteAdmin.php?id=' . $id . '&message=Reporte guardado correctamente');
  exit();
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
}
