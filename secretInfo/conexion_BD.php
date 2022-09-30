<?php
	// Activar modal mantenimiento
	$mantenimiento = true;

	$host_name = 'localhost';
	$database = 'dbs778238';
	$user_name = 'root';
	$password = '';
	$conexion = new mysqli($host_name, $user_name, $password, $database);

	$conexion->set_charset("utf8");

	if(mysqli_connect_errno())
	{
		echo 'Conexion Fallida: ', mysqli_connect_error();
		exit();
	}

?>