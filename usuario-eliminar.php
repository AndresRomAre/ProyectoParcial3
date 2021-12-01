<?php

session_start();

require_once('connection.php');

$errors = [];

if (!isset($_POST['markerId']) || empty($_POST['markerId'])) {
    $errors[] = 'ID requerido';
}

if (count($errors) > 0) {
    header('Location: /usuariosAdmin.php?message=' . $errors[0]);
    exit();
}

$markerId = $_POST['markerId'];

try {

    $dbMarker = db();
    $sql = $dbMarker->prepare('
    DELETE FROM markers WHERE id = ?
  ');
    $execute = $sql->execute([
        $markerId
    ]);

    header('Location: /usuariosAdmin.php?message=Reporte eliminado correctamente');
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
