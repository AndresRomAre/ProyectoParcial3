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

if (isset($_GET['location'])) {
    $search = $_GET['location'];
    $query .= "WHERE m.location = ?";
}

$query .= 'ORDER BY inserted_at ASC';

$sql = db()->prepare($query);
if (isset($_GET['location'])) {
    $sql->execute([$search]);
} else {
    $sql->execute();
}

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
                        <a href="Reporte.php?id=<?= $row['markerid'] ?>" class="card mb-3 w-100" style="margin-top: 2em; text-decoration: none;">
                            <div class="row g-0">
                                <?php if ($row['image']) { ?>
                                    <div class="col-md-4">
                                        <img src="<?= 'assets/Img/' . $row['image'] ?>" class="img-fluid rounded-start">
                                    </div>
                                <?php }
                                ?>

                                <div class="col-md">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $row['type'] ?></h5>
                                        <p class="card-text"><?= $row['descripcion'] ?></p>
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