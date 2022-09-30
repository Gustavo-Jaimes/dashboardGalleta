<?php
	session_start();
	require 'secretInfo/conexion_BD.php';
    require 'secretInfo/funciones.php';

    if(!isset($_SESSION["id_usuario"]))
	{
		header("Location: auth/login.php");
	}

	$idUsuario = $_SESSION['id_usuario'];
	$sql = "SELECT id, user, last_name, email, company, password, id_tipo FROM usuarios WHERE id = '$idUsuario'";
	$result = $conexion->query($sql);
	$rowUser = $result->fetch_assoc();

	$conn = new PDO("mysql:host=localhost; dbname=dbs778238", "root", "");

    $sql = "SELECT id FROM usuarios;";
	//$sql = "select title, description, transmission, image, mileage, price, updated_at, agencia from products inner join branches where branch_id = branch_id";
	$sentencia = $conn->prepare($sql);
	$sentencia->execute();
	$resultado = $sentencia->fetchAll();

	//var_dump ($resultado);
	$decena = 10;
    
	//contar articulos de bd
	$total = $sentencia->rowCount();
	//echo $total;
	$paginas = $total/10;
	$paginas = ceil($paginas);
    
    //la de prueba
	//$conn = new PDO("mysql:host=db5000973429.hosting-data.io; dbname=dbs846583", "dbu620410", "Galleta2020%");
    if (isset($_GET["pagina"]) > 0) {
        $pagina = $_GET["pagina"];
    } else {
        $pagina = 1;
    }

    echo '<script> console.log("pagina es igual a '.$pagina.'");</script>';
?>

<?php include "includes/head_clientes.php"  ?>

<body class="app sidebar-mini">

<!-- GLOBAL-LOADER -->
<div id="global-loader">
        <img src="assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">
            <?php include "includes/header.php" ?>

            <?php include "includes/sidebar.php" ?>

            <!--app-content open-->
            <div class="app-content">
                <div class="side-app">

                    <!-- PAGE-HEADER -->
                    <div class="page-header">
                        <div>
                            <h1 class="page-title">Campañas de Marketing</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->

                    <?php if (isset($_GET['passVacia'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                        <strong>¡Vaya!</strong> No se pudo guardar, por que dejaste los campos vacios.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
                        <strong>¡Vaya!</strong> Hubo un error desconocido, intenta de nuevo.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['errorNoCoinciden'])): ?>
                    <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
                        <strong>Upss!</strong> Las contraseñas no coinciden, intenta de nuevo.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['cambiosOk'])): ?>
                    <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                        <strong>¡Genial!</strong> Se actualizo la contraseña correctamente.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="text-center table table-hover table-bordered border-top-0 border-bottom-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope='col' style='width: 30%;'>Acciones</th>    
                                    <th scope='col' style='width: 5%;'>Id</th>
                                    <th scope="col" style="width: 20%;">Cliente</th>
                                    <th scope="col" style="width: 20%;">Correo</th>
                                    <th scope="col">Companía</th>
                                </tr>
                            </thead>

                            <?php
                                $iniciar = ($pagina-1)*$decena;
								$clientes = mysqli_query($conexion, "SELECT id, CONCAT(user,' ',last_name) AS nombre, company, email, last_session, activacion FROM usuarios ORDER BY last_session DESC LIMIT $iniciar, $decena;");
								if (mysqli_num_rows($clientes) != 0) {
									foreach ($clientes as $rowClientes) {
                                        $id = $rowClientes['id'];
							?>

                            <tr>
                                <td>
                                    <?php if ($rowClientes['activacion'] == "1"): ?>
                                        <a class='deletebtncliente btn btn-pill btn-danger-light' href='#' onclick='inactivar(<?php echo $id; ?>)'><i
                                            class="fas fa-trash-alt"></i> Inactivar</a>
                                        <a class='editbtncliente  btn btn-pill btn-success-light' href='#' onclick='editar(<?php echo $id; ?>)'><i
                                            class="fas fa-edit"></i> Editar</a>
                                        <a class='filesbtncliente btn btn-pill btn-primary' href='#' onclick='archivos(<?php echo $id; ?>)'><i
                                            class="fas fa-folder-open"></i> Archivos</a>
                                    <?php else: ?>
                                        <a class='enablebtncliente  btn btn-pill btn-warning-light' href='#' onclick='activar(<?php echo $id; ?>)'><i
                                            class="fas fa-edit"></i> Activar</a>
                                    <?php endif; ?>
                                </td> <!-- acciones -->
                                <td><?php echo $id; ?></td> <!-- id -->
                                <td><?php echo $rowClientes['nombre']; ?></td> <!-- cliente -->
                                <td><?php echo $rowClientes['email']; ?></td> <!-- correo -->
                                <td><?php echo $rowClientes['company']; ?></td> <!-- compania -->
                            </tr>
                            <?php
									}

								} else {
							?>
                            <p class="col-sm-12 h5">¡Vaya! Aun no tienes campañas para mostrar.</p>
                            <?php
								}
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>

        <div class="mx-auto">
            <nav class="center-block text-center" style="padding-bottom:15px;">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $pagina<=1? 'disabled':'' ?>">
                        <a class="page-link" href="clientes.php?pagina=<?php echo $pagina-1 ?>" tabindex="-1">
                            Anterior
                        </a>
                    </li>
                    <?php for($i=0; $i<$paginas; $i++): ?>

                    <li class="page-item <?php echo $pagina==$i+1 ? 'active' : ''?>">
                        <a class="page-link" href="clientes.php?pagina=<?php echo $i + 1; ?>">
                            <?php echo $i + 1; ?>
                        </a>
                    </li>
                    <?php endfor ?>

                    <li class="page-item <?php echo $pagina >= $paginas ? 'disabled':'' ?>">
                        <a class="page-link" href="clientes.php?pagina=<?php echo $pagina+1 ?>">
                            Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>

        <?php 
			include "includes/footer.php";
			include "includes/modals.php"; 
		?>

<div id="closeModal" style="position:fixed; color:#fff; top:4px; right:25px; display:none; z-index:9999; font-size:xx-large; cursor: pointer;" onclick="archivos()"><i class="fa fa-close"></i></div>
<div id="overlay" style="position:fixed; background-color:rgba(0,0,0,.75); width:100%; height:100%; top:0; left:0; display:none; z-index:9998;" onclick="archivos()"></div>
<iframe src="" name="iframeArchivos" id="iframeArchivos" style="position:fixed; background-color:#fff; width:95%; height:98%; top:5; left:5; display:none; z-index:9999; border:solid 3px #ccc; border-radius:25px;"></iframe>

<script>
    function inactivar(id) {
        Swal.fire({
            text: 'Realmente desea eliminar este usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("secretInfo/funciones_clientes.php?accion=disableUser", { id: id }, function(resultadoAjax) {
                    if (resultadoAjax == 1) {
                        Swal.fire({
                            icon: 'success',
                            text: 'Los datos se han recuperado',
                            showConfirmButton: true
                        }).then((resultSwal) => {
                            if (resultSwal.isConfirmed) {
                                location.href = "";
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: 'Los datos no se han podido eliminar',
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    }

    function activar(id) {
        Swal.fire({
            text: 'Realmente desea recuperar este usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, recuperar',
            cancelButtonText: 'No'
        }).then((resultSwal) => {
            if (resultSwal.isConfirmed) {
                $.post("secretInfo/funciones_clientes.php?accion=enableUser", { id: id }, function(resultadoAjax) {
                    if (resultadoAjax == 1) {
                        Swal.fire({
                            icon: 'success',
                            text: 'Los datos se han recuperado',
                            showConfirmButton: true
                        }).then((resultSwal) => {
                            if (resultSwal.isConfirmed) {
                                location.href = "";
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: 'Los datos no se han podido recuperar',
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    }

    function editar(id) {
        var nombre;
        var apellido;
        var email;
        var empresa;
        
        $.post("secretInfo/funciones_clientes.php?accion=showUser", { id: id }, function(resultadoAjax) {
            resultadoAjax = JSON.parse(resultadoAjax);

            nombre = resultadoAjax.user;
            apellido = resultadoAjax.last_name;
            email = resultadoAjax.email;
            empresa = resultadoAjax.company;
        }).done(function() {
            Swal.fire({
                title: 'Editar usuario',
                html:
                    '<form action="" method="POST" enctype="multipart/form-data" class="" id="formRegistoClientes">'+
                        '<div class="modal-body">'+
                            '<div class="row">'+
                                '<div class="col col-sm-12 py-2 card-body">'+

                                    '<div class="form-group icon-addon">'+
                                        '<label for="nombre">Nombre</label>'+
                                        '<input type="hidden" value="'+id+'"> '+
                                        '<input class="form-control" type="text" name="nombreCliente" id="nombreCliente2" value="'+nombre+'" placeholder="">'+
                                        '<i class="fas fa-user"></i>'+
                                        '<span id="nombreCliente_error" class="text-danger font-12px"></span>'+
                                    '</div>'+

                                    '<div class="form-group icon-addon">'+
                                        '<label for="apellido">Apellidos</label>'+
                                        '<input class="form-control" type="text" name="apellidoCliente" id="apellidoCliente2" value="'+apellido+'" placeholder="">'+
                                        '<i class="fas fa-user"></i>'+
                                        '<span id="apellidoCliente_error" class="text-danger font-12px"></span>'+
                                    '</div>'+

                                    '<div class="form-group icon-addon">'+
                                        '<label for="email">Correo Electrónico</label>'+
                                        '<input class="form-control" type="email" name="emailCliente" id="emailCliente2" value="'+email+'" placeholder="">'+
                                        '<i class="fas fa-envelope"></i>'+
                                        '<span id="emailCliente_error" class="text-danger font-12px"></span>'+
                                    '</div>'+

                                    '<div class="form-group icon-addon">'+
                                        '<label for="nombre_empresa">Nombre de la empresa</label>'+
                                        '<input class="form-control" type="text" name="empresaCliente" id="empresaCliente2" value="'+empresa+'" placeholder="">'+
                                        '<i class="fas fa-briefcase"></i>'+
                                        '<span id="empresaCliente_error" class="text-danger font-12px"></span>'+
                                    '</div>'+

                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</form>',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText:'Confirmar',
                cancelButtonText: 'Cancelar'

            }).then((resultSwal) => {
                if (resultSwal.isConfirmed) {

                    nombre = $("#nombreCliente2").val();
                    apellido = $("#apellidoCliente2").val();
                    empresa = $("#empresaCliente2").val();
                    email = $("#emailCliente2").val();
                    
                    $.post("secretInfo/funciones_clientes.php?accion=editUser", { nombreCliente: nombre, apellidoCliente: apellido, empresaCliente: empresa, emailCliente: email, id: id }, function(resultadoAjax) {
                        if (resultadoAjax == 1) {
                            Swal.fire({
                                icon: 'success',
                                text: 'Los datos se han modificado',
                                showConfirmButton: true
                            }).then((resultSwal) => {
                                if (resultSwal.isConfirmed) {
                                    location.href = "";
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: 'Los datos no se han podido modificar',
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        });
    }

    function archivos(id) {
        if ($('#iframeArchivos').is(':visible')) {
            $('#iframeArchivos').hide();
            $('#overlay').hide();
            $('#closeModal').hide();
        } else {
            $('#iframeArchivos').show();
            $('#overlay').show();
            $('#closeModal').show();
            window.open('archivos.php?id='+id, 'iframeArchivos');
        }
    }

</script>