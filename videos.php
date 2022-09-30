<?php
    session_start();
	require 'secretInfo/conexion_BD.php';
	require 'secretInfo/funciones.php';

	if(!isset($_SESSION["id_usuario"])) {
		header("Location: auth/login.php");
	}
	$idUsuario = $_SESSION['id_usuario'];

    $sql = "SELECT id_tipo FROM usuarios WHERE id = ".$idUsuario." ";
    $result = $conexion->query($sql);
	$perfil_array = $result->fetch_assoc();
    foreach ($perfil_array as $perfil) {
        $perfil_actual = $perfil;
    }

    $idCarpeta = $_GET['id'];

    if (isset($_GET['month'])) {
        $month = $_GET['month'];    
    } else {
        $month = date('n');
    }

    if (isset($_GET['year'])) {
        $year = $_GET['year'];
    } else {
        $year = date('Y');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-size: 16px;
            font-family: 'Slabo 27px', serif;
            background: #232931;
            color:#fff;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Slabo 27px', serif;
            font-weight: normal;
        }

        a {
            text-decoration: none;
            color:#fff;
        }

        a:hover {
            text-decoration: underline;
        }

        .contenedor {
            max-width: 1300px;
            width: 90%;
            margin: auto;
        }

        .izquierda {
            float: left;
        }

        .derecha {
            float: right;
        }

        .btn-a {
            display: block;
        }

        /* --- Header ---*/

        header {
            margin: 40px 0;
            font-size: 20px;
            text-align: center;
        }

        /* --- FOTOS --- */
        .fotos .contenedor {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .thumb {
            width: 18%;
            margin-bottom: 30px;
            outline:5px solid rgba(255,255,255,0);
            -webkit-box-shadow: 2px 2px 3px rgba(0,0,0,.8);
            box-shadow: 2px 2px 3px rgba(0,0,0,.8);
            -webkit-transition: all .3s ease;
            -o-transition: all .3s ease;
            transition: all .3s ease;
            text-align: center
        }

        .thumb:hover {
            outline:5px solid rgba(255,255,255,1);
        }

        .thumb a {
            display: block;
        }

        .thumb img {
            vertical-align: top;
            width: 100%;
        }

        /* --- Single Foto --- */
        .foto {
            width: 100%;
            margin: auto;
            max-width: 500px;
            text-align: center;
        }

        .foto img {
            width: 100%;
            vertical-align: top;
            -webkit-box-shadow: 2px 2px 3px rgba(0,0,0,.8);
            box-shadow: 2px 2px 3px rgba(0,0,0,.8);
            margin-bottom: 30px;
        }

        .foto .texto {
            max-width: 500px;
            margin-bottom: 30px;
        }

        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 7px 14px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 6px 2px;
            cursor: pointer;
            border-radius: 2px;
        }

        /* CARPETAS DE FOTOS */
        ul { display: inline-block; width: 24%; }
        li { list-style: none; }

    </style>
</head>
<body>
    <header>
        <div class="contenedor">
            <h1 class="titulo"><a href="archivos.php?id=<?php echo $_REQUEST['id']; ?>">Mis imagenes</a> - <a href="videos.php?id=<?php echo $_REQUEST['id']; ?>">Ir a mis videos</a></h1>
        </div>
    </header>

    <section class="fotos">
        <div class="contenedor">

            <?php
                $id = $_REQUEST['id'];
                $path1 = 'clientes/'.date('Y').'/'.date('n').'/fotos/'.$id;
                $path2 = 'clientes/'.date('Y').'/'.date('n').'/videos/'.$id;
                
                $listado = scandir($path2);
                unset($listado[array_search('.', $listado, true)]);
                unset($listado[array_search('..', $listado, true)]);
                if (count($listado) < 1) {
                    echo 'la carpeta está vacía';

                } else {

                    $cont = 0;
                    
                    foreach ($listado as $elemento) {
                        $cont++;

                        if (!is_dir($path2.'/'.$elemento)) { // es archivo
                            echo '<div>';
                                echo '<center>';
                                    echo '<video width="320" height="240" controls><source src="'.$path2.'/'.$elemento.'" type="video/mp4"></video><br>';
                                    echo '<a class="btn-a" style="background-color: green;" href="'.$path2.'/'.$elemento.'">Descargar</a>';
                                    echo '<a class="btn-a" href="#" onclick="borrar_archivo(\''.$elemento.'\')" style="background-color: red;">Eliminar</a>';
                                echo '</center>';
                            echo '</div>';

                        }

                        if (is_dir($path2.'/'.$elemento)) { // es carpeta
                            echo '<div class="thumb">';
                                echo '<img src="carpeta.jpg" alt="">';
                                echo '<a class="btn-a" style="background-color: green;" href="'.$path1.'/'.$elemento.'">'.$elemento.'</a>';
                            echo '</div>';
                        }
                    }
                }

                if ($perfil_actual == 1) { // es administrador
                    echo '<form id="formulario" name="formulario" method="POST" enctype="multipart/form-data">';
                        echo '<input type="hidden" name="idUsuario" id="idUsuario" value="'.$idCarpeta.'" >';
                        echo '<input type="file" name="archivo" id="archivo" class="form-control" >';
                        echo '<button type="submit" class="btn btn-info bnt-md">Subir archivo</button>';
                    echo '</form>';
                    
                }
            ?>
        </div>
    </section>

    <br><br><br>

    <section>
        <div class="contenedor">
            <div class="scrollmenu">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            2022
                            </button>
                        </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="background:#656F7D">
                        <div class="card-body">
                            <ul>
                                <li><a href="videos.php?month=1&year=2022&id=<?= $id; ?>">Enero</a></li>
                                <li><a href="videos.php?month=2&year=2022&id=<?= $id; ?>">Febrero</a></li>
                                <li><a href="videos.php?month=3&year=2022&id=<?= $id; ?>">Marzo</a></li>
                            </ul>
                            <ul>
                                <li><a href="videos.php?month=4&year=2022&id=<?= $id; ?>">Abril</a></li>
                                <li><a href="videos.php?month=5&year=2022&id=<?= $id; ?>">Mayo</a></li>
                                <li><a href="videos.php?month=6&year=2022&id=<?= $id; ?>">Junio</a></li>
                            </ul>
                            <ul>
                                <li><a href="videos.php?month=7&year=2022&id=<?= $id; ?>">Julio</a></li>
                                <li><a href="videos.php?month=8&year=2022&id=<?= $id; ?>">Agosto</a></li>
                                <li><a href="videos.php?month=9&year=2022&id=<?= $id; ?>">Septiembre</a></li>
                            </ul>
                            <ul>
                                <li><a href="videos.php?month=10&year=2022&id=<?= $id; ?>">Octubre</a></li>
                                <li><a href="videos.php?month=11&year=2022&id=<?= $id; ?>">Noviembre</a></li>
                                <li><a href="videos.php?month=12&year=2022&id=<?= $id; ?>">Diciembre</a></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2023
                            </button>
                        </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion" style="background:#656F7D">
                        <div class="card-body">
                            <ul>
                                <li><a href="videos.php?month=1&year=2023&id=<?= $id; ?>">Enero</a></li>
                                <li><a href="videos.php?month=2&year=2023&id=<?= $id; ?>">Febrero</a></li>
                                <li><a href="videos.php?month=3&year=2023&id=<?= $id; ?>">Marzo</a></li>
                            </ul>
                            <ul>
                                <li><a href="videos.php?month=4&year=2023&id=<?= $id; ?>">Abril</a></li>
                                <li><a href="videos.php?month=5&year=2023&id=<?= $id; ?>">Mayo</a></li>
                                <li><a href="videos.php?month=6&year=2023&id=<?= $id; ?>">Junio</a></li>
                            </ul>
                            <ul>
                                <li><a href="videos.php?month=7&year=2023&id=<?= $id; ?>">Julio</a></li>
                                <li><a href="videos.php?month=8&year=2023&id=<?= $id; ?>">Agosto</a></li>
                                <li><a href="videos.php?month=9&year=2023&id=<?= $id; ?>">Septiembre</a></li>
                            </ul>
                            <ul>
                                <li><a href="videos.php?month=10&year=2023&id=<?= $id; ?>">Octubre</a></li>
                                <li><a href="videos.php?month=11&year=2023&id=<?= $id; ?>">Noviembre</a></li>
                                <li><a href="videos.php?month=12&year=2023&id=<?= $id; ?>">Diciembre</a></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section><br><br>
            
    <!-- JQUERY JS -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <!-- sweet alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- sweet alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function init() {
            $("#formulario").on("submit",function(e) {
                guardar_datos(e);	
            });
        }

        function guardar_datos(e) {
            e.preventDefault();
            var formData = new FormData($("#formulario")[0]);
            $.ajax({
                url: "secretInfo/funciones_clientes.php?accion=saveVideo",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos) {
                    if (datos == 1) {
                        Swal.fire({
                            icon: 'success',
                            text: 'El video se subió exitosamente',
                            showConfirmButton: true
                        }).then((resultSwal) => {
                            if (resultSwal.isConfirmed) {
                                location.href = "";
                            }
                        });
                    } else if (datos == 2) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Ha enviado un video con formato no compatible, por favor suba solo videos',
                            showConfirmButton: true
                        });
                    } else if (datos == 3) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Debe seleccionar un video para subir',
                            showConfirmButton: true
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: 'El video no se pudo subir al directorio, intente de nuevo',
                            showConfirmButton: true
                        });
                    }
                }
            });
        }

        function borrar_archivo(nombre) {
            Swal.fire({
                text: '¿Esta seguro de borrar este archivo?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar!',
                cancelButtonText:'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("secretInfo/funciones_clientes.php?accion=deleteVideo", { idUsuario: <?php echo $id; ?> , nombre: nombre }, function(datos) {
                        if (datos == 1) {
                            Swal.fire({
                                icon: 'success',
                                text: 'El archivo ha sido borrado',
                                showConfirmButton: true
                            }).then((resultSwal) => {
                                if (resultSwal.isConfirmed) {
                                    location.href = "";
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: 'Al archivo no se pudo borrar, intente de nuevo',
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        }

        init();
    </script>

</body>
</html>
