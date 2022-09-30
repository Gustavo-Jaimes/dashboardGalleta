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
    <title>Document</title>
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
                $path1 = 'clientes/'.$year.'/'.$month.'/fotos/'.$id;
                $path2 = 'clientes/'.$year.'/'.$month.'/videos/'.$id;
                
                $listado = scandir($path1);
                unset($listado[array_search('.', $listado, true)]);
                unset($listado[array_search('..', $listado, true)]);
                if (count($listado) < 1) {
                    echo 'la carpeta está vacía';

                } else {

                    $cont = 0;
                    
                    foreach ($listado as $elemento) {
                        $cont++;

                        if (!is_dir($path1.'/'.$elemento)) { // es archivo
                            echo '<div class="thumb">';
                                echo '<a href="#" >';
                                    echo '<img src="'.$path1.'/'.$elemento.'" alt="" onclick="visualizar(\''.$elemento.'\')">';
                                echo '</a>';
                                echo '<a href="'.$path1.'/'.$elemento.'" style="background-color: green;" download>Descargar</a>';
                                echo '<a href="#" onclick="borrar_archivo(\''.$elemento.'\')" style="background-color: red;">Eliminar</a>';
                            echo '</div>';

                        }

                        if (is_dir($path1.'/'.$elemento)) { // es carpeta
                            echo '<div class="thumb">';
                                echo '<img src="carpeta.jpg" alt="" onclick="visualizar(\''.$elemento.'\')">';
                                echo '<a style="background-color: green;" href="'.$path1.'/'.$elemento.'">'.$elemento.'</a>';
                            echo '</div>';
                        }
                    }

                    echo '<table style="width:95%">';
                        echo '<tr><td><img src="" style="max-width:50%; width:50%" id="vistaPrevia"></td></tr>';
                        echo '<tr><td><a id="descargaPrevia">Descargar</a></td></tr>';
                        echo '<tr><td><span>Hay '.$cont.' elementos en esta carpeta</span></td></tr>';
                    echo '</table>';
                }

                if ($perfil_actual == 1) { // es administrador
                    echo '<form id="formulario" name="formulario" method="POST" enctype="multipart/form-data">';
                        echo '<input type="hidden" name="idUsuario" id="idUsuario" value="'.$idCarpeta.'" >';
                        echo '<input type="file" name="archivo" id="archivo" class="form-control" >';
                        echo '<button type="submit" class="btn btn-info bnt-md mt-3 mb-3">Subir archivo</button>';
                    echo '</form>';
                    
                }
            ?>
        </div>
    </section>
            
    <section>
        <div class="contenedor">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        2022
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body bg-black">
                        <ul>
                                <li><a href="archivos.php?month=1&year=2022&id=<?= $id; ?>">Enero</a></li>
                                <li><a href="archivos.php?month=2&year=2022&id=<?= $id; ?>" onclick="">Febrero</a></li>
                                <li><a href="archivos.php?month=3&year=2022&id=<?= $id; ?>" onclick="">Marzo</a></li>
                            </ul>
                            <ul>
                                <li><a href="archivos.php?month=4&year=2022&id=<?= $id; ?>" onclick="">Abril</a></li>
                                <li><a href="archivos.php?month=5&year=2022&id=<?= $id; ?>" onclick="">Mayo</a></li>
                                <li><a href="archivos.php?month=6&year=2022&id=<?= $id; ?>" onclick="">Junio</a></li>
                            </ul>
                            <ul>
                                <li><a href="archivos.php?month=7&year=2022&id=<?= $id; ?>" onclick="">Julio</a></li>
                                <li><a href="archivos.php?month=8&year=2022&id=<?= $id; ?>" onclick="">Agosto</a></li>
                                <li><a href="archivos.php?month=9&year=2022&id=<?= $id; ?>" onclick="">Septiembre</a></li>
                            </ul>
                            <ul>
                                <li><a href="archivos.php?month=10&year=2022&id=<?= $id; ?>" onclick="">Octubre</a></li>
                                <li><a href="archivos.php?month=11&year=2022&id=<?= $id; ?>" onclick="">Noviembre</a></li>
                                <li><a href="archivos.php?month=12&year=2022&id=<?= $id; ?>" onclick="">Diciembre</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>  
        </div>    
    </section>        
         
    <!-- JQUERY JS -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <!-- sweet alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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
                url: "secretInfo/funciones_clientes.php?accion=saveFile",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (datos) {
                    if (datos == 1) {
                        Swal.fire({
                            icon: 'success',
                            text: 'El archivo se subió exitosamente',
                            showConfirmButton: true
                        }).then((resultSwal) => {
                            if (resultSwal.isConfirmed) {
                                location.href = "";
                            }
                        });
                    } else if (datos == 2) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Ha enviado un archivo con formato no compatible, por favor suba solo imágenes',
                            showConfirmButton: true
                        });
                    } else if (datos == 3) {
                        Swal.fire({
                            icon: 'error',
                            text: 'Debe seleccionar un archivo para subir',
                            showConfirmButton: true
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: 'Al archivo no se pudo subir al directorio, intente de nuevo',
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
                    $.post("secretInfo/funciones_clientes.php?accion=deleteFile", { idUsuario: <?php echo $id; ?> , nombre: nombre }, function(datos) {
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

        function visualizar(elemento) {
            document.querySelector('#vistaPrevia').src = '<?= $path1; ?>/'+elemento;
            document.querySelector('#descargaPrevia').href = '<?= $path1; ?>/'+elemento;
            document.querySelector('#descargaPrevia').style.display = "block";
        }

        init();
    </script>

</body>
</html>
