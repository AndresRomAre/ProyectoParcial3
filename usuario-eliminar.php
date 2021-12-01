<?php

session_start();

require_once('connection.php');

$errors = [];

if (!isset($_POST['usuarioId']) || empty($_POST['usuarioId'])) {
    $errors[] = 'ID requerido';
}

if (count($errors) > 0) {
    header('Location: /usuariosAdmin.php?message=' . $errors[0]);
    exit();
}

$usuarioID = $_POST['usuarioId'];

try {

    $sql = db()->prepare('
    DELETE FROM users WHERE id = ?
  ');
    $execute = $sql->execute([
        $usuarioID
    ]);

    header('Location: /usuariosAdmin.php?message=Usuario eliminado correctamente');
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
