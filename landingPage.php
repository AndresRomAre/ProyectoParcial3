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
    <link href="assets/style-landing.css" rel="stylesheet" type="text/css" />
    <link href="https://www.dafontfree.net/embed/bXVzZW8tc2xhYi01MDAmZGF0YS80MS9tLzk1MTE2L011c2VvX1NsYWJfNTAwLm90Zg" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container">
        <h1 class="tipografia justify-content-center d-flex" id="textoAnimacion">
            HELPI
        </h1>
    </div>
    <div class="container justify-content-center d-flex">
        <img src="assets/Imagenes/logo2.png" class="logo" alt="Logo" id="logoAnimacion">
    </div>
    <div class="container">
        <div class="row" style="margin-bottom: 2em;">
            <div class="col-5">
                <img src="assets/Imagenes/Marcar.png" class="img-fluid rounded-start" style="width: 90%; height: auto;" id="mapaAnimacion">
            </div>


            <div class="col-7 letraGrande container justify-content-center d-flex">
                <p style="margin: auto;" id="navegaAnimacion">
                    Navega de forma segura por tu ciudad y marca lugares peligrosos
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-7 letraGrande container justify-content-center d-flex">
                <p style="margin: auto;" id="comparteAnimacion">
                    Comparte tus experiencias
                </p>
            </div>
            <div class="col-5">
                <img src="assets/Imagenes/Reportes.png" class="img-fluid rounded-start" style="width: 80%; height: auto;" id="reporteAnimacion">
            </div>



        </div>
        <div class="row" style="margin-top: 5em; margin-bottom: 2em;">
            <div class="container justify-content-center d-flex">
                <a href="index.php">
                    <div>
                        <button type="submit" class="btn btn-primary btn-ingresar" id="botonAnimacion">
                            <span class="letra-botones">
                                Ingresar
                            </span>
                        </button>
                    </div>
                </a>
            </div>

        </div>
    </div>






    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>