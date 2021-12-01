<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('connection.php');

$query = 'SELECT m.latitude, m.longitude, m.location, m.type, r.notes, r.image ';
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
$json = json_encode($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <link rel="stylesheet" href="assets/style.css?v=0.0.1">
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
  <title>Reporte</title>
</head>

<body>
  <div class="d-flex flex-column h-100">
    <nav id="navTop" class="navbar navbar-light bg-light shadow">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Reportes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </div>
    </nav>
    <?php if (isset($_GET['message'])) : ?>
      <div class="alert alert-info alert-dismissible fade show rounded-0 mb-0 shadow" role="alert">
        <?= $_GET['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <div class="bg-light p-2">
      <form action="reports.php">
        <div class="input-group">
          <select name="location" class="form-select">
            <?php if (isset($_GET['location'])) : ?>
              <option value="<?= $_GET['location'] ?>"><?= $_GET['location'] ?></option>
            <?php endif; ?>
            <option value="">Seleccionar alcaldía</option>
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
          <button class="btn btn-info">
            Buscar
          </button>
          <?php if (isset($_GET['location'])) : ?>
            <a href="reports.php" class="btn btn-danger">
              x
            </a>
          <?php endif; ?>
        </div>
      </form>
    </div>
    <!-- >> elemento con estilo height: 100% -->
    <div id="map"></div>
    <!-- elemento con estilo height: 100% << -->
    <div id="navTabs" class="d-flex align-items-center">
      <ul class="nav nav-fill w-100">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="report.php">Nuevo reporte</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reports.php">Reportes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Otro link</a>
        </li>
      </ul>
    </div>
  </div>
  <div id="reportModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">Datos de reporte</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="report-insert.php" enctype="multipart/form-data" method="POST">
            <div class="mb-3">
              <small>
                Latitud
              </small>
              <input id="latitudeInput" name="latitudeInput" type="text" class="form-control" readonly>
            </div>
            <div class="mb-3">
              <small>
                Longitud
              </small>
              <input id="longitudeInput" name="longitudeInput" type="text" class="form-control" readonly>
            </div>
            <div class="mb-3">
              <small>
                Tipo*
              </small>
              <select id="typeInput" name="typeInput" class="form-select" disabled>
                <option value="-1">
                  Seleccionar opción
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
              <select id="locationInput" name="locationInput" class="form-select" disabled>
                <option value="">Seleccionar opción</option>
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
              <small>
                Foto
              </small>
              <img id="imageReport" src="assets/img/image-placeholder.jpg" alt="" class="img-fluid">
            </div>
            <div class="mb-3">
              <small>
                Notas
              </small>
              <textarea id="notesInput" name="notesInput" class="form-control" rows="3" readonly></textarea>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    var markersJson = <?= $json ?>;
    var map = L.map('map').setView([19.3978, -99.1420], 11);
    var markers = L.layerGroup().addTo(map);
    var reportModalElement = document.getElementById('reportModal');
    var reportModal = new bootstrap.Modal(reportModalElement);
    var latitudeInput = document.getElementById('latitudeInput');
    var longitudeInput = document.getElementById('longitudeInput');
    var typeInput = document.getElementById('typeInput');
    var locationInput = document.getElementById('locationInput');
    var notesInput = document.getElementById('notesInput');
    var imageReport = document.getElementById('imageReport');

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
      maxZoom: 18
    }).addTo(map);

    markersJson.forEach(function(marker) {
      var notes = marker.notes || "No hay notas";
      L.marker([marker.latitude, marker.longitude])
        .addTo(markers)
        .bindPopup(notes)
        .on('contextmenu', function() {
          latitudeInput.value = marker.latitude;
          longitudeInput.value = marker.longitude;
          typeInput.value = marker.type;
          locationInput.value = marker.location;
          notesInput.value = notes;
          imageReport.src = 'assets/img/image-placeholder.jpg';
          if (marker.image) {
            imageReport.src = 'assets/img/' + marker.image;
          }
          reportModal.show();
        });
    })
  </script>
</body>

</html>