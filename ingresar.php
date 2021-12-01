<?php

session_start();

require_once('connection.php');

$errors = [];

if (!isset($_POST['email']) || empty($_POST['email'])) {
  $errors[] = 'Correo requerido';
}

if (!isset($_POST['pass']) || empty($_POST['pass'])) {
  $errors[] = 'Contraseña requerida';
}

if (count($errors) > 0) {
  header('Location: /index.php?message=' . $errors[0]);
  exit();
}

$email = $_POST['email'];
$pass = $_POST['pass'];

try {

  $dbMarker = db();
  $sql = $dbMarker->prepare('
    SELECT id, role, email, password FROM users WHERE email = ? AND password = ?
  ');
  $sql->execute([
    $email, $pass
  ]);

  $result = $sql->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    $_SESSION['userId'] = $result['id'];
    $_SESSION['role'] = $result['role'];

    header('Location: /home.php');
    exit();
  } else {
    header('Location: /index.php?message=Credenciales incorrectas');
    exit();
  }
} catch (PDOException $e) {
  echo $e->getMessage();
  die();
}
