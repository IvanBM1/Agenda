<?php require('../php/is_session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/spin.css">
	<link rel="stylesheet" href="../css/app.css">
</head>
<body class="background">

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand">Agenda en Linea</a>
			</div>
			<div class="navbar-right">
				<p class="navbar-text"><strong><?= $_SESSION['name'];?></strong></p>
				<a href="" id="close-session" class="btn btn-danger navbar-btn">Cerrar Sesión</a>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="row">
			
			<!-- Barra lateral lista de contactos -->
			<div class="col-md-5">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title  text-right">Contactos <a href="" id="btn_create" class="btn btn-info">Crear</a></h3>
					</div>
					<div class="panel-body">
						<div class="list-group">
							<?php require('../php/show_contacts.php'); ?>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Columna de separacion -->
			<div class="col-md-1"></div>

			<!-- Barra lateral jumbotron [crea, editar, mostrar] -->
			<div class="col-md-5">
				<div id="box" class="jumbotron" style="padding-top: 20px; margin-bottom: 0px; padding-bottom: 20px">
					<h2 id="title_box" class="text-center"></h2>
					
					<input id="id" type="hidden" value="">

					<label for="name">Nombre</label> <br>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">o</span>
						<input id="name" type="text" class="form-control" placeholder="Nombre del contacto" aria-describedby="basic-addon1">
					</div>
					<label for="telephone_local">Número local</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon2">o</span>
						<input id="telephone_local" type="text" class="form-control" placeholder="Telefono de casa" aria-describedby="basic-addon2">
					</div>
					<label for="telephone_mobile">Número movil</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon3">o</span>
						<input id="telephone_mobile" type="text" class="form-control" placeholder="Telefono celular" aria-describedby="basic-addon3">
					</div>
					<label for="email">Correo</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon4">o</span>
						<input id="email" type="text" class="form-control" placeholder="Correo electronico" aria-describedby="basic-addon4">
					</div>
					<label for="address">Dirección</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon5">o</span>
						<input id="address" type="text" class="form-control" placeholder="Dirección del contacto" aria-describedby="basic-addon5">
					</div>

					<input id="id_user" type="hidden" value = '<?=$_SESSION['id']?>' >
					<br>

					<div id="spin" class="sk-three-bounce" style="margin: 0px auto;">
						<div class="sk-child sk-bounce1"></div>
						<div class="sk-child sk-bounce2"></div>
						<div class="sk-child sk-bounce3"></div>
					</div>
					<div id="alert" class="alert alert-danger alert-dismissible" role="alert">
						<button id="btn_alert" class="close" type="button"><span aria-hidden="true">&times;</span></button>
						<strong class="message">Warning!</strong>
					</div>
					<div class="text-right">
						<a href="" id="btn_send_create" class="btn btn-info">Guardar</a>
						<a href="" id="btn_send_edit" class="btn btn-success">Editar</a>
					</div>

				</div>
			</div>
			
		</div>
	</div>

	<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/app.js"></script>
</body>
</html>