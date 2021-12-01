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
    <link href="assets/style-miCuenta.css" rel="stylesheet" type="text/css" />
    <link href="https://www.dafontfree.net/embed/bXVzZW8tc2xhYi01MDAmZGF0YS80MS9tLzk1MTE2L011c2VvX1NsYWJfNTAwLm90Zg" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="d-flex flex-column h-100">
        <?php include("barraNavSup.php"); ?>
        <div id="contenido">
            <div class="align-items-center d-flex flex-column h-100 justify-content-center">
                <div class="container" style="margin-top: -8em;">
                    <h1 class="tipografia justify-content-center d-flex" style="font-size: 3em;">
                        Mi Cuenta
                    </h1>
                </div>
                <div class="container justify-content-center d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="6em" height="auto" fill="#1B1F2D" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    </svg>
                </div>
                <div class="container justify-content-center d-flex">
                    <form style="padding-top: 0.5em;">
                        <div class="row align-items-center d-flex justify-content-center">
                            <div class="mb-3 col-md-6">
                                <input readonly type="email" class="form-control input-ingreso" id="Email-crear" placeholder="Email">
                            </div>
                            <div class="mb-3 col-md-6">
                                <input readonly type="password" class="form-control input-ingreso" id="contrasenia-crear" placeholder="Contraseña">
                            </div>
                        </div>

                        <div class="row align-items-center d-flex justify-content-center">
                            <div class="mb-3 col-md-6">
                                <input readonly type="text" class="form-control input-ingreso" id="nombre" placeholder="Nombre">
                            </div>
                            <div class="mb-3 col-md-6">
                                <input readonly type="text" class="form-control input-ingreso" id="apellido" placeholder="Apellido">
                            </div>
                        </div>


                        <div>
                            <a class="btn btn-primary btn-azul" onclick="window.location.href='miCuentaEditar.php'">
                                <span class="letra-botones">
                                    Editar
                                </span>
                            </a>

                        </div>
                        <div>
                            <a type="submit" class="btn btn-primary btn-naranja">
                                <span class="letra-botones">
                                    Salir
                                </span>
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <?php include("barraNavInf.php"); ?>
    </div>






    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>