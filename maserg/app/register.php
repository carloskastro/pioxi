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
	$msg=null;
	$color=null;

	if (isset($_POST['reg'])) {
		$reg=$conn->prepare('INSERT INTO aprendiz(nombre,apellido,email,tipodoc,documento,user,pass) VALUES(?,?,?,?,?,?,?)');
		$reg->bindparam(1,$_POST['nombre']);
		$reg->bindparam(2,$_POST['apellido']);
		$reg->bindparam(3,$_POST['email']);
		$reg->bindparam(4,$_POST['tipodoc']);
		$reg->bindparam(5,$_POST['documento']);
		$reg->bindparam(6,$_POST['user']);
		$pass=password_hash($_POST['pass'], PASSWORD_BCRYPT);
		$reg->bindparam(7,$pass);

		if ($reg->execute()) {
			$msg="Datos Registrados";
			$color="success";
		}else{
			$msg="Datos no registrados, revise información";
			$color="danger";
		}
	}
	?>
	<div class="container">
		<div class="pt-5 text-center">
			<?php 
			if ($msg!='' && $color!='') { ?>
				<div class="alert alert-<?php echo $color; ?> alert-dismissible">
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					<strong><?php echo $color; ?>!</strong> <?php echo $msg; ?>.
				</div>
			<?php
			}
			?>

			<div class="card" style="border-radius: 2.25rem;background-color: #ffffffdb;">
				<div class="card-body">
					<form action="" method="post" enctype="application/x-www-form-urlencoded">
						<h4>Registro de Usuario</h4>
						<div class="mb-3 mt-3">
							<input type="text" class="form-control" name="nombre" placeholder="Nombres" required="required">
						</div>
						<div class="mb-3 mt-3">
							<input type="text" class="form-control" name="apellido" placeholder="Apellidos" required="required">
						</div>
						<div class="mb-3 mt-3">
							<input type="email" class="form-control" name="email" placeholder="Email" required="required">
						</div>
						<div class="mb-3 mt-3">
							<select name="tipodoc" class="form-select" required="required">
								<option selected disabled>Tipo de documento</option>
								<option value="TI">TI</option>
								<option value="CC">CC</option>
							</select>
						</div>
						<div class="mb-3 mt-3">
							<input type="text" class="form-control" name="documento" placeholder="Documento" required="required" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
							</div>
							<div class="mb-3 mt-3">
								<input type="text" class="form-control" name="user" placeholder="Usuario" required="required">
							</div>
							<div class="mb-3 mt-3">
								<input type="password" class="form-control" name="pass" placeholder="Contraseña" required="required">
							</div>
							<!--<div class="mb-3 mt-3">
								<input type="password" class="form-control" name="confirm_password" placeholder="Confirma Contraseña" required="required">
							</div>-->
							<div class="mb-3 mt-3">
								<label class="form-check-label">
									<input type="checkbox" required="required"> Acepta
									<a href="#">Terminos, condiciones</a> &amp;
									<a href="#">Politica de Privacidad</a>
								</label>
							</div>
							<div class="mb-3 mt-3">
								<button type="submit" class="btn btn-success" name="reg">Regístrate</button>
							</div>
						</form>
						<div class="text-center">Ya tienes una cuenta?
							<a href="./">Iniciar sesión</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>