<?php

session_start();

if (!isset($_SESSION['userId']) && empty($_SESSION['userId'])) {
    header('Location: /index.php?message=Debes iniciar sesión');
    exit();
}

if (isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] !== 'administrador') {
    header('Location: /home.php');
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connection.php');

$sql = db()->prepare('
    SELECT id, email, first_name, last_name, role FROM users
  ');
$sql->execute(['']);

$result = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>HELPI</title>
    <link href="assets/style-page.css" rel="stylesheet" type="text/css" />
    <link href="https://www.dafontfree.net/embed/bXVzZW8tc2xhYi01MDAmZGF0YS80MS9tLzk1MTE2L011c2VvX1NsYWJfNTAwLm90Zg" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="d-flex flex-column h-100">
        <?php include("barraNavSup.php"); ?>
        <div id="contenido">
            <div class="align-items-center d-flex flex-column h-100">
                <?php
                if ($result) {
                    foreach ($result as $row) {
                ?>
                        <a href="usuarioAdmin.php?id=<?= $row['id'] ?>" class="card mb-3 w-100" style="margin-top: 2em; text-decoration: none;">
                            <div class="row g-0">
                                <div class="col-md">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $row['first_name'] ?> <?= $row['last_name'] ?></h5>
                                        <p class="card-text">Id: <?= $row['id'] ?></p>
                                        <p class="card-text">Email: <?= $row['email'] ?></p>
                                        <p class="card-text">Rol: <?= $row['role'] ?></p>
                                        <form action="usuario-eliminar.php" method="POST" style="padding-top: 2em;">
                                            <input type="hidden" name="markerId" value="<?= $row['id'] ?>">
                                            <button type="submit" class="btn btn-primary" style="background-color: #e77a58; border: #e77a58;">
                                                <span class="letra-botones">
                                                    Eliminar
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                } else {
                    ?>
                    <div class="col-12 text-center">
                        <p>No hay registros.</p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <?php include("barraNavInf.php"); ?>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>