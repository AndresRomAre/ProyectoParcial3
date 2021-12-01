<?php

session_start();

require_once('connection.php');

$errors = [];

if (!isset($_POST['email']) || empty($_POST['email'])) {
    $errors[] = 'Correo requerido';
}

if (!isset($_POST['password']) || empty($_POST['password'])) {
    $errors[] = 'Contraseña requerida';
}

if (!isset($_POST['first_name']) || empty($_POST['first_name'])) {
    $errors[] = 'Nombre requerido';
}

if (!isset($_POST['last_name']) || empty($_POST['last_name'])) {
    $errors[] = 'Apellido requerido';
}

if (count($errors) > 0) {
    header('Location: /crearCuenta.php?message=' . $errors[0]);
    exit();
}

$email = $_POST['email'];
$pass = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];


try {

    $sql = db()->prepare('
    INSERT INTO users
    (email, password, first_name, last_name, role) 
    VALUES 
    (?,?,?,?,?)
  ');
    $sql->execute([
        $email, $pass, $first_name, $last_name, 'reportador'
    ]);

    header('Location: /index.php?message=Registro creado');
    exit();
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
