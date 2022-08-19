<!DOCTYPE html>
<html lang="es-CO" class="h-100">
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

	<!--Datatables Styles-->
	<link rel="stylesheet" type="text/css" href="../assets/datatables/css/dataTables.bootstrap5.min.css">
	<!--Datatables Responsive-->
	<link rel="stylesheet" type="text/css" href="../assets/datatables/css/responsive.dataTables.min.css">

	<!--Datatables Scripts-->
	<script type="text/javascript" src="../assets/datatables/js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="../assets/datatables/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../assets/datatables/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" src="../assets/datatables/js/dataTables.bootstrap5.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function () {
    		$('#table').DataTable({
    			responsive: true,
    			language: {url: '../assets/datatables/es-ES.json'},
    		});
		});
	</script>

	<!--
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins.js"></script>-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">	
</head>
<body class="bg-light d-flex flex-column h-100">

	<?php
	require_once 'conn.php';
	session_start();

	if (isset($_SESSION['aprendiz'])) {
		$search=$conn->prepare('SELECT * FROM aprendiz WHERE idaprendiz=?');
		$search->bindparam(1,$_SESSION['aprendiz']);
		$search->execute();

		$data=$search->fetch(PDO::FETCH_ASSOC);

		$user=null;

		if (count($data)>0) {
			$user=$data;
		}

	if (!empty($user)) { //comprobar que la variable $user contega información
		?>

		<!--Navbar-->
		<header>
			<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
				<div class="container-fluid">
					<a class="navbar-brand" href="#"><img src="../assets/img/logosena.png" style="width: 40px;"></a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="collapsibleNavbar">

						<ul class="nav navbar-nav me-auto" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-bs-toggle="tab" href="#home">Inicio</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#ficha">Ficha</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#compromiso">Compromiso</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#tratamiento">Tratamiento</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="home2">Home2</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="tabla">Tabla</a>
							</li>
						</ul>

						<span class="badge bg-warning">Hola <?php echo $user['nombre']; ?></span>
						<div class="navbar-brand dropdown">
							<button type="button" class="navbar-brand btn btn-link dropdown-toggle" data-bs-toggle="dropdown">
								<img src="../assets/img/img_avatar.png" alt="Logo" style="width:40px;" class="rounded-pill">
							</button>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="#">Datos</a></li>
								<li><a class="dropdown-item" href="logout">Salir</a></li>
							</ul>
						</div>	
					</div>
				</div>
			</nav>
		</header>
		<!--Navbar-->
		<main class="mt-5 pt-5 container">
			<h2 class="text-center pt-3 pb-3">Listado de Aprendices</h2>

			<table class="table table-striped table-bordered table-hover" id="table" style="width:100%;">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Correo</th>
							<th>Documento</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$res=$conn->prepare('SELECT * FROM aprendiz');
						$res->execute();
						while ($view= $res->fetch(PDO::FETCH_ASSOC)) {
					
						?>
						<tr>
							<td><?php echo $view['nombre']; ?></td>
							<td><?php echo $view['apellido']; ?></td>
							<td><?php echo $view['email']; ?></td>
							<td><?php echo $view['documento']; ?></td>
						</tr>
						<?php } ?>					
					</tbody>
				</table>
		</main>
		<!--Footer-->
		<footer class="footer mt-auto py-3 bg-dark">
			<div class="container text-center">
				<span class="text-muted">&copy; Copyright ASEM.</span>
			</div>
		</footer>
		<!--Footer-->
		
		<?php
	}
}else{
	header('location: ./');
}
?>

</body>
</html>