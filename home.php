<?php

session_start();

if (!isset($_SESSION['userId']) && empty($_SESSION['userId'])) {
  header('Location: /index.php?message=Debes iniciar sesión');
  exit();
}

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

    <?php if (isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] !== 'administrador') { ?>
      <div id="contenido">
        <div class="align-items-center d-flex flex-column h-100 justify-content-center">
          <div class="container justify-content-center d-flex" style="margin-bottom: -1em; margin-top: -2em;">
            <img src="assets/Imagenes/marcar.png" class="imagen" style="height: 12em; width: 12em;" alt="Dibujo mapa">
          </div>
          <div class="container justify-content-center d-flex">
            <a href="reports.php">
              <button type="submit" class="btn btn-primary btn-azul">
                <span class="letra-botones">
                  Navegar
                </span>
              </button>
            </a>
          </div>
          <div class="container justify-content-center d-flex">
            <a href="report.php">
              <button type="submit" class="btn btn-primary btn-azul">
                <span class="letra-botones">
                  Marcar
                </span>
              </button>
            </a>

          </div>
          <div class="container justify-content-center d-flex" style="margin-top: 0em;">
            <img src="assets/Imagenes/Reportes.png" class="imagen" style="width: 7em; height: auto; margin-top: 2em;" alt="Dibujo reporte">
          </div>
          <div class="container justify-content-center d-flex">
            <a href="tableroReportes.php">
              <button type="submit" class="btn btn-primary btn-azul">
                <span class="letra-botones">
                  Reportes
                </span>
              </button>
            </a>
          </div>
        </div>
      </div>
    <?php } else { ?>
      <div id="contenido">
        <div class="align-items-center d-flex flex-column h-100 justify-content-center">
          <div class="container justify-content-center d-flex" style="margin-bottom: -1em; margin-top: -2em;">
            <svg xmlns="http://www.w3.org/2000/svg" width="6em" height="auto" fill="#1B1F2D" class="bi bi-person-fill" viewBox="0 0 16 16">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            </svg>
          </div>
          <div class="container justify-content-center d-flex">
            <a href="usuariosAdmin.php">
              <button type="submit" class="btn btn-primary btn-azul">
                <span class="letra-botones">
                  Editar usuarios
                </span>
              </button>
            </a>
          </div>
          <div class="container justify-content-center d-flex" style="margin-top: 0em;">
            <img src="assets/Imagenes/Reportes.png" class="imagen" style="width: 7em; height: auto; margin-top: 2em;" alt="Dibujo reporte">
          </div>
          <div class="container justify-content-center d-flex">
            <a href="tableroReportesAdmin.php">
              <button type="submit" class="btn btn-primary btn-azul">
                <span class="letra-botones">
                  Editar reportes
                </span>
              </button>
            </a>
          </div>
        </div>
      </div>
    <?php }
    ?>


    <?php include("barraNavInf.php"); ?>
  </div>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>

</html>