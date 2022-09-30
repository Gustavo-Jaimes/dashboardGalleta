<?php session_start();
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

	$sql = "SELECT * FROM campanas WHERE admin_usuario LIKE '%;".$rowUser['id'].";%' ORDER BY id_campana DESC";
	$sentencia = $conn->prepare($sql);
	$sentencia->execute();
	$resultado = $sentencia->fetchAll();
	
	//cuenta el total de item en la pagina
	$autos_x_pagina = 10;

	//contar articulos de bd
	$total = $sentencia->rowCount();
	//echo $total;
	$paginas = $total/10;
	$paginas = ceil($paginas);



//echo $paginas;

?>

<?php include "includes/head.php"  ?>

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
                                <li class="breadcrumb-item active" aria-current="page">Campañas</li>
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
                                    <!-- <th scope='col' style='width: 5%;'>Id</th> -->
                                    <th scope="col" style="width: 40%;">Acciones</th>
                                    <th scope="col" style="width: 30%;">Cliente</th>
                                    <!-- <th scope='col' style='width: 30%;'>Presupuesto</th> -->
                                    <th scope="col" style="width: 30%;">Mes y Año</th>
                                </tr>
                            </thead>

                            <?php
								
								$iniciar = ($_GET['pagina']-1)*$autos_x_pagina;
								//'%".$rowUser['id']."; %'
								// $campanas = mysqli_query($conexion, "SELECT * FROM campanas WHERE admin_usuario LIKE '%;".$rowUser['id'].";%' ORDER BY id_campana ASC LIMIT $iniciar, $autos_x_pagina ");

								$campanas = mysqli_query($conexion, "SELECT * FROM campanas WHERE admin_usuario LIKE '%;".$rowUser['id'].";%' ORDER BY ultima_actualizacion_camp DESC LIMIT $iniciar, $autos_x_pagina ");
								
								if (mysqli_num_rows($campanas) != 0) {
									foreach ($campanas as $rowCampa) {
							?>

                            <tr>
                                <td style="display:none;"><?php echo $rowCampa['id_campana']; ?></td>
                                <td>
                                    <?php if ($rowUser['id_tipo'] == "1"): ?>
                                    <button class='deletebtncliente btn btn-pill btn-danger-light' href='#'><i
                                            class="fas fa-trash-alt"></i> Eliminar</button>
                                    <button class='editbtncliente  btn btn-pill btn-success-light' href='#'><i
                                            class="fas fa-edit"></i> Editar</button>
                                    <?php else: ?>

                                    <?php endif; ?>
                                    <button class='btn btn-pill btn-info-light'
                                        onclick="window.location='cliente.php?id=<?php echo $rowCampa['id_campana']; ?>&company=<?php echo $rowCampa['nom_empresa']; ?>&month=<?php echo $rowCampa['mes']; ?>&year=<?php echo $rowCampa['anio']; ?>';"
                                        style="cursor:pointer"><i class="fas fa-folder-open"></i> Administrar</button>
                                </td>
                                <td><?php echo $rowCampa['nom_empresa']; ?></td>
                                <td style="display:none;"><?php echo $rowCampa['presu_general']; ?></td>
                                <td><?php echo $rowCampa['mes'].' '.$rowCampa['anio'];  ?></td>
                                <td style="display:none;"><?php echo $rowCampa['id_cliente']; ?></td>
                            </tr>


                            <?php
									}

								} 
								else {
							?>
                            <p class="col-sm-12 h5">¡Vaya! Aun no tienes campañas para mostrar.</p>
                            <?php
								}
								?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto">
            <nav class="center-block text-center" style="padding-bottom:15px;">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $_GET['pagina']<=1? 'disabled':'' ?>">
                        <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina']-1 ?>" tabindex="-1">
                            Anterior
                        </a>
                    </li>
                    <?php for($i=0; $i<$paginas; $i++): ?>

                    <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : ''?>">
                        <a class="page-link" href="index.php?pagina=<?php echo $i + 1; ?>">
                            <?php echo $i + 1; ?>
                        </a>
                    </li>
                    <?php endfor ?>

                    <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled':'' ?>">
                        <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina']+1 ?>">
                            Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>

		


        <?php 
			include "includes/footer.php";
			include "includes/modals.php"; 
		?>

        <script>
        $(document).ready(function() {
            $('.editbtncliente').on('click', function() {
                $('#editmodalcliente').modal('show');
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id_cliente').val(data[0]);
                $('#presuClienteEdit').val(data[3]);
                $('#mesClienteEdit').val(data[4]);
                $('#pass_id_cliente').val(data[5]);
            });
        });


        $(document).ready(function() {
            $('.deletebtncliente').on('click', function() {
                $('#deletemodalcliente').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id_cliente').val(data[0]);

            });
        });
        </script>