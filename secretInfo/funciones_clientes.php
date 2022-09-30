<?php
    require_once 'conexion_BD.php';

    $accion = $_REQUEST['accion'];

    switch ($accion) {
        case 'disableUser':
            $sql = "UPDATE usuarios SET activacion=0 WHERE id = ".$_REQUEST['id'];
            if ($conexion->query($sql) === TRUE) {
                echo 1;
            } else {
                echo 0;
            }
        break;
    
        case 'enableUser':
            $sql = "UPDATE usuarios SET activacion=1 WHERE id = ".$_REQUEST['id'];
            if ($conexion->query($sql) === TRUE) {
                echo 1;
            } else {
                echo 0;
            }
        break;

        case 'showUser':
            $sql = "SELECT id, user, last_name, company, email FROM usuarios WHERE id = ".$_REQUEST['id'];
            $query = $conexion->query($sql);
            $row = $query->fetch_assoc();
            echo json_encode($row);
        break;

        case 'editUser':
            $sql = "UPDATE usuarios SET user = '".$_REQUEST['nombreCliente']."', last_name = '".$_REQUEST['apellidoCliente']."', company = '".$_REQUEST['empresaCliente']."', email = '".$_REQUEST['emailCliente']."' WHERE id = ".$_REQUEST['id'];
            if ($conexion->query($sql) === TRUE) {
                echo 1;
            } else {
                echo 0;
            }
        break;

        case 'saveFile':
            $idUsuario = $_POST['idUsuario'];
            if (!file_exists($_FILES['archivo']['tmp_name']) || !is_uploaded_file($_FILES['archivo']['tmp_name'])) {
                echo 3;
            } else {
                $extension = explode('.', $_FILES['archivo']['name']);
                if ($_FILES['archivo']['type'] == 'image/jpg' || $_FILES['archivo']['type'] == 'image/jpeg' || $_FILES['archivo']['type'] == 'image/png') {
                    $archivo = round(microtime(true)).'.'.end($extension);
                    $path = "../clientes/".date('Y')."/".date('n')."/fotos/".$idUsuario."/";

                    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $path.$archivo)) {
                        echo 1;
                    } else {
                        echo 0;
                    };
                } else {
                    echo 2;
                }
            }

            
        break;

        case 'saveVideo':
            $idUsuario = $_POST['idUsuario'];
            if (!file_exists($_FILES['archivo']['tmp_name']) || !is_uploaded_file($_FILES['archivo']['tmp_name'])) {
                echo 3;
            } else {
                $extension = explode('.', $_FILES['archivo']['name']);
                if ($_FILES['archivo']['type'] == 'video/mp4') {
                    $archivo = round(microtime(true)).'.'.end($extension);
                    $path = "../clientes/".date('Y')."/".date('n')."/videos/".$idUsuario."/";

                    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $path.$archivo)) {
                        echo 1;
                    } else {
                        echo 0;
                    };
                } else {
                    echo 2;
                }
            }
        break;

        case 'deleteFile':
            $idUsuario = $_POST['idUsuario'];
            $nombre = $_POST['nombre'];

            $path = "../clientes/".date('Y')."/".date('n')."/fotos/".$idUsuario."/";
            if (unlink($path.$nombre)) {
                echo 1;
            } else {
                echo 0;
            }
        break;

        case 'deleteVideo':
            $idUsuario = $_POST['idUsuario'];
            $nombre = $_POST['nombre'];
            
            $path = "../clientes/".date('Y')."/".date('n')."/videos/".$idUsuario."/";
            
            if (unlink($path.$nombre)) {
                echo 1;
            } else {
                echo 0;
            }
        break;

        default:
            echo 0;
    }
?>