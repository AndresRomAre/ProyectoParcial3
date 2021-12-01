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

$query = 'SELECT id, email, password, first_name, last_name, role ';
$query .= 'FROM users ';
$search = '';

if (isset($_GET['id'])) {
    $search = $_GET['id'];
    $query .= "WHERE id = ?";
}

$sql = db()->prepare($query);
if (isset($_GET['id'])) {
    $sql->execute([$search]);
} else {
    $sql->execute();
}

$result = $sql->fetch(PDO::FETCH_ASSOC);
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
                <div class="card" style="width: 23em; margin-top: 2%; margin-bottom: 2%;">
                    <div class="card-body">
                        <form action="usuarios-edit.php" enctype="multipart/form-data" method="POST">
                            <div class="mb-3">
                                <label>
                                    Id usuario*
                                </label>
                                <input id="idUsuarioInput" name="idUsuarioInput" type="text" class="form-control" readonly value="<?= $result['id'] ?>">
                            </div>

                            <div class="mb-3">
                                <label>
                                    Email*
                                </label>
                                <input id="emailInput" name="emailInput" type="text" class="form-control" value="<?= $result['email'] ?>">
                            </div>

                            <div class="mb-3">
                                <label>
                                    Contraseña*
                                </label>
                                <input id="passwordInput" name="passwordInput" type="password" class="form-control" value="<?= $result['password'] ?>">
                            </div>

                            <div class="mb-3">
                                <label>
                                    Primer nombre*
                                </label>
                                <input id="first_nameInput" name="first_nameInput" type="text" class="form-control" value="<?= $result['first_name'] ?>">
                            </div>

                            <div class="mb-3">
                                <label>
                                    Apellido*
                                </label>
                                <input id="last_nameInput" name="last_nameInput" type="text" class="form-control" value="<?= $result['last_name'] ?>">
                            </div>

                            <div class="mb-3">
                                <label>
                                    Rol*
                                </label>
                                <select name="roleInput" class="form-select">
                                    <option value="<?= $result['role'] ?>">
                                        <?= $result['role'] ?>
                                    </option>
                                    <option value="reportador">
                                        Reportador
                                    </option>
                                    <option value="administrador">
                                        Administrador
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include("barraNavInf.php"); ?>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>