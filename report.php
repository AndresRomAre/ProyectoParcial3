<?php

session_start();

if (!isset($_SESSION['userId']) && empty($_SESSION['userId'])) {
  header('Location: /index.php?message=Debes iniciar sesión');
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <link rel="stylesheet" href="assets/style.css">
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
  <title>Reporte</title>
</head>

<body>
  <div class="d-flex flex-column h-100">
    <?php include("barraNavSup.php"); ?>
    <?php if (isset($_GET['message'])) : ?>
      <div class="alert alert-info alert-dismissible fade show rounded-0 mb-0 shadow" role="alert">
        <?= $_GET['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <!-- >> elemento con estilo height: 100% -->
    <div id="map"></div>
    <!-- elemento con estilo height: 100% << -->
    <?php include("barraNavInf.php"); ?>
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
                <option value="">
                  Seleccionar opción
                </option>
                <option value="Asalto">
                  Asalto
                </option>
                <option value="Secuestro">
                  Secuestro
                </option>
                <option value="Agresion sexual">
                  Agresión sexual
                </option>
                <option value="Poco mantenimiento">
                  Poco mantenimiento
                </option>
                <option value="Agresion fisica">
                  Agresión física
                </option>
              </select>
            </div>
            <div class="mb-3">
              <label>
                Alcaldía*
              </label>
              <select name="locationInput" class="form-select">
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
              <label>
                Descripcion breve
              </label>
              <textarea id="descripcionInput" name="descripcionInput" class="form-control" rows="3"></textarea>
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cambiar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    var map = L.map('map').setView([19.3978, -99.1420], 11);
    var markers = L.layerGroup().addTo(map);
    var reportModalElement = document.getElementById('reportModal');
    var reportModal = new bootstrap.Modal(reportModalElement);
    var latitudeInput = document.getElementById('latitudeInput');
    var longitudeInput = document.getElementById('longitudeInput');

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
      maxZoom: 18
    }).addTo(map);

    map.on('contextmenu', function(e) {
      var latitude = e.latlng.lat;
      var longitude = e.latlng.lng;

      markers.clearLayers();
      L.marker([latitude, longitude]).addTo(markers);

      latitudeInput.value = latitude;
      longitudeInput.value = longitude;
      reportModal.show();
    });
  </script>
</body>

</html>