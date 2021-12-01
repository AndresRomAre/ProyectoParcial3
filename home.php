<?php

session_start();

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
      <div class="align-items-center d-flex flex-column h-100 justify-content-center">
        <div class="container justify-content-center d-flex" style="margin-bottom: -1em; margin-top: -2em;">
          <img src="assets/Imagenes/marcar.png" class="imagen" style="height: 12em; width: 12em;" alt="Dibujo mapa">
        </div>
        <div class="container justify-content-center d-flex">
          <button type="submit" class="btn btn-primary btn-azul">
            <span class="letra-botones">
              Navegar
            </span>
          </button>
        </div>
        <div class="container justify-content-center d-flex">
          <button type="submit" class="btn btn-primary btn-azul">
            <span class="letra-botones">
              Marcar
            </span>
          </button>
        </div>
        <div class="container justify-content-center d-flex" style="margin-top: 0em;">
          <img src="assets/Imagenes/Reportes.png" class="imagen" style="width: 7em; height: auto; margin-top: 2em;" alt="Dibujo reporte">
        </div>
        <div class="container justify-content-center d-flex">
          <button type="submit" class="btn btn-primary btn-azul">
            <span class="letra-botones">
              Reportes
            </span>
          </button>
        </div>
      </div>
    </div>
    <?php include("barraNavInf.php"); ?>
  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>