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
<body class="bg-login">

	<?php
	require_once 'conn.php';
	session_start();

	if (isset($_POST['sesion'])) {
		
		$result=$conn->prepare('SELECT * FROM aprendiz WHERE user=?');
		$result->bindparam(1,$_POST['user']);
		$result->execute();
		$data=$result->fetch(PDO::FETCH_ASSOC);

		if ($data['user']==$_POST['user']) {

			if (password_verify($_POST['pass'], $data['pass'])) {

				$_SESSION['aprendiz']= $data['idaprendiz'];
				header('location:home');
			}else{
				echo "Contraseña incorrecta";
			}
		}else{
			echo "Usuario incorrecto";
		}
	}
	?>

	<div class="container login">
		<div class="card" style="border-radius: 2.25rem;background-color: #ffffffdb;">
			<div class="card-header text-center pt-2 pb-2">
				<div class="clearfix pt-3">
					<span class="float-start">
						<h4>Inicio de Sesión</h4>
					</span>
					<span class="float-end">
						<a href="../"><i class="fa fa-xmark fa-2x text-danger"></i></a>
					</span>
				</div>
			</div>
			<div class="card-body">
				<form action="" class="was-validated" method="post">
					<div class="mb-3 mt-3">
						<label for="uname" class="form-label">Usuario:</label>
						<input type="text" class="form-control" placeholder="Ingrese su usuario" name="user" required>
						<div class="valid-feedback">Validado.</div>
						<div class="invalid-feedback">Campo vacio</div>
					</div>
					<div class="mb-3 mt-3">
						<label for="pwd" class="form-label">Contraseña:</label>
						<input type="password" class="form-control" placeholder="Ingrese su Contraseña" name="pass" required>
						<div class="valid-feedback">Validado.</div>
						<div class="invalid-feedback">Campo vacio</div>
					</div>
					<div class="clearfix pt-3 pb-3">
						<span class="float-start">
							<button type="submit" class="btn btn-success" name="sesion">Ingresar</button>
						</span>
						<span class="float-end">
							<a href="register" class="btn btn-link">Regístrate</a>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>