<?php

session_start();

require_once('connection.php');

$errors = [];

if (!isset($_POST['idUsuarioInput']) || empty($_POST['idUsuarioInput'])) {
    $errors[] = 'Id requerido';
}


$id = $_POST['idInput'];

if (count($errors) > 0) {
    header('Location: /usuarioAdmin.php?id=' . $id . '&message=' . $errors[0]);
    exit();
}

$id = $_POST['idUsuarioInput'];
$email = $_POST['emailInput'];
$password = $_POST['passwordInput'];
$first_name = $_POST['first_nameInput'];
$last_name = $_POST['last_nameInput'];
$role = $_POST['roleInput'];

try {

    $sql = db()->prepare('
    UPDATE users SET email = ?, password = ?, first_name = ?, last_name = ?, role = ? WHERE id = ?
  ');
    $execute = $sql->execute([
        $email, $password, $first_name, $last_name, $role, $id
    ]);


    header('Location: /usuarioAdmin.php?id=' . $id . '&message=Información guardada correctamente');
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
