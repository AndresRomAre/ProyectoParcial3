<?php

session_start();

if (!isset($_SESSION['userId']) && empty($_SESSION['userId'])) {
    header('Location: /index.php?message=Debes iniciar sesión');
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connection.php');

$query = 'SELECT m.id as markerid, m.latitude, m.longitude, m.location, m.type, r.descripcion, r.notes, r.image ';
$query .= 'FROM markers AS m ';
$query .= 'LEFT JOIN reports AS r ON r.marker_id = m.id ';
$search = '';

if (isset($_GET['id'])) {
    $search = $_GET['id'];
    $query .= "WHERE m.id = ?";
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
                    <?php if ($result['image']) { ?>
                        <img src="<?= 'assets/Img/' . $result['image'] ?>" class="img-fluid rounded-start">
                    <?php }
                    ?>
                    <div class="card-body">
                        <h1 class="card-title"><?= $result['type'] ?></h1>
                        <h6><?= $result['descripcion'] ?></h6>
                        <p class="card-text">
                            <?= $result['notes'] ?>
                        </p>
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