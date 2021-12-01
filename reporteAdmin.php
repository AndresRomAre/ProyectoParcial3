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
            <form action="reports-edit.php" enctype="multipart/form-data" method="POST">
              <div class="mb-3">
                <label>
                  Latitud
                </label>
                <input id="latitudeInput" name="latitudeInput" type="text" class="form-control" readonly>
              </div>
              <div class="mb-3">
                <label>
                  Longitud
                </label>
                <input id="longitudeInput" name="longitudeInput" type="text" class="form-control" readonly>
              </div>
              <div class="mb-3">
                <label>
                  Tipo*
                </label>
                <select name="typeInput" class="form-select">
                  <option value="<?= $result['type'] ?>">
                  <?= $result['type'] ?>
                  </option>
                  <option value="Asalto">
                    Asalto
                  </option>
                  <option value="Secuestro">
                    Secuestro
                  </option>
                </select>
              </div>
              <div class="mb-3">
                <label>
                  Alcaldía*
                </label>
                <select name="locationInput" class="form-select">
                  <option value="<?= $result['location'] ?>"><?= $result['location'] ?></option>
                  <option value="AZCAPOTZALCO">AZCAPOTZALCO</option>
                  <option value="COYOACÁN">COYOACÁN</option>
                  <option value="CUAJIMALPA DE MORELOS">CUAJIMALPA DE MORELOS</option>
                  <option value="GUSTAVO A. MADERO">GUSTAVO A. MADERO</option>
                  <option value="IZTACALCO">IZTACALCO</option>
                  <option value="IZTAPALAPA">IZTAPALAPA</option>
                  <option value="LA MAGDALENA CONTRERAS">LA MAGDALENA CONTRERAS</option>
                  <option value="MILPA ALTA">MILPA ALTA</option>
                  <option value="ÁLVARO OBREGÓN">ÁLVARO OBREGÓN</option>
                  <option value="TLAHUAC">TLAHUAC</option>
                  <option value="TLALPAN">TLALPAN</option>
                  <option value="XOCHIMILCO">XOCHIMILCO</option>
                  <option value="BENITO JUÁREZ">BENITO JUÁREZ</option>
                  <option value="CUAUHTEMOC">CUAUHTEMOC</option>
                  <option value="MIGUEL HIDALGO">MIGUEL HIDALGO</option>
                  <option value="VENUSTIANO CARRANZA">VENUSTIANO CARRANZA</option>
                </select>
              </div>
              <div class="mb-3">
                <label>
                  Descripcion breve
                </label>
                <textarea id="descripcionInput" name="descripcionInput" class="form-control" rows="3"><?= $result['descripcion'] ?></textarea>
              </div>
              <div class="mb-3">
                <label>
                  Foto
                </label>
                <input id="imageInput" name="imageInput" type="file" class="form-file" accept="images/*">
              </div>
              <div class="mb-3">
                <label>
                  Notas adicionales
                </label>
                <textarea id="notesInput" name="notesInput" class="form-control" rows="3"></textarea>
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