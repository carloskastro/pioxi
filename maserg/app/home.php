<!DOCTYPE html>
<html lang="es-CO">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="MASE">
	<meta name="description" content="Aplicativo web para matriculas del Sena">
	<meta name="keywords" content="Sena, SENA, sena">
	<meta name="theme-color" content="#ff2e01">
	<meta name="MobileOptimized" content="width">
	<meta name="HandhledFriendly" content="true">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-traslucent">
	<title>&copy; mase</title>
	<!--Favicon-->
	<link rel="icon" type="image/x-icon" href="../assets/img/logosena.png">

	<!--Bootstrap 5-->
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<script type="text/javascript" src="../assets/js/bootstrap.bundle.js"></script>

	<!--
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins.js"></script>-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">	
</head>
<body>
	<?php
	require_once 'conn.php';
	session_start();

	if (isset($_SESSION['aprendiz'])) {
		
		$search=$conn->prepare('SELECT * FROM aprendiz WHERE idaprendiz=?');
		$search->bindparam(1,$_SESSION['aprendiz']);
		$search->execute();
		$data=$search->fetch(PDO::FETCH_ASSOC);

		$username=null;

		if (count($data)>0) {
			$username=$data;
		}

		if (!empty($username)) {
	?>

	<h2>Bienvenido<?php echo $username['nombre']; ?></h2>
	<a href="logout">Cerrar sesión</a>

	<?php 
	}
	}else{
		header('location: ./');
	}
	?>
</body>
</html>