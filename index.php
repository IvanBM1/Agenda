<?php 
	session_start();
	if( isset($_SESSION['id']) ) 
		header("Location: app/home.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/spin.css">
	<link rel="stylesheet" href="css/app.css">
</head>
<body class="background">

	<div class="container">
		<div class="row">

			<!-- Barra Izquierda [Imagen] -->
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 ">
				
				<div class="text-center">
					<img src="images/logo.png" class="img-responsive logo animated infinite  tada">
				</div>
			</div>

			<!-- Barra Derecha [Formulario de Sesion/Registro] -->
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">

				<!-- Formulario de Sesión -->
				<div id="form-session" class="jumbotron">
					
					<h2 class="text-center">Inicio de Sesión</h2> <br>
					
					<form id="form_session">
						<!-- Campo Nombre -->
						<div class="form-group">
							<label for="name-user">Nombre</label>
							<input id="name-user" name="name" type="text" class="form-control" placeholder="Nombre de Usuario">
						</div>
						<!-- Campo Password -->
						<div class="form-group">
							<label for="password-user">Password</label>
							<input id="password-user" name="password" type="password" class="form-control" placeholder="Password">
						</div>
						<!-- Link a el Formulario de Registro -->
						<div class="form-group text-right">
							<a id="btn-show-registry" class="text-right" style="cursor: pointer;">Registro</a>
						</div>
						<!-- Boton de Submit Sesión-->
						<div class="form-group">
							<input type="submit" class="btn btn-primary btn-block" value="Login">
						</div>
					</form>
					<div id="spin-session" class="sk-three-bounce" style="margin: 0px auto;">
						<div class="sk-child sk-bounce1"></div>
						<div class="sk-child sk-bounce2"></div>
						<div class="sk-child sk-bounce3"></div>
					</div>
					<div id="alert-session" class="alert alert-danger alert-dismissible" role="alert">
						<button id="alert-session-close" class="close" type="button"><span aria-hidden="true">&times;</span></button>
						<strong class="session-message">Warning!</strong>
					</div>
				</div>

				<!-- Formulario de Registro -->
				<div id="form-registry" class="jumbotron">
					<h2 class="text-center">Registro</h2> <br>
					<form id="form_registry">
						<!-- Nombre de usuario -->
						<div class="form-group">
							<label for="registry-name">Nombre de Usuario</label>
							<input id="registry-name" name="name" type="text" class="form-control" placeholder="Nombre de Usuario">
						</div>
						<!-- Password -->
						<div class="form-group">
							<label for="registry-password">Contraseña</label>
							<input id="registry-password" name="password" type="password" class="form-control" placeholder="Password">
						</div>
						<!-- Confirmar Password -->
						<div class="form-group">
							<label for="confirm-password">Confirma tu Contraseña</label>
							<input id="confirm-password" type="password" class="form-control" placeholder="Password">
						</div>
						
						<!-- Link a Formulario de Sesion -->
						<div class="form-group text-right">
							<a id="btn-show-session" class="text-right" style="cursor: pointer;">Iniciar Sesión</a>
						</div>

						<!-- Boton de Submit Registro -->
						<div class="form-group">
							<input type="submit" class="btn btn-success btn-block" value="Registrarme">
						</div>
					</form>
					<div id="sping-registry" class="sk-three-bounce" style="margin: 0px auto;">
						<div class="sk-child sk-bounce1"></div>
						<div class="sk-child sk-bounce2"></div>
						<div class="sk-child sk-bounce3"></div>
					</div>
					<div id="alert-registry" class="alert alert-danger alert-dismissible" role="alert">
						<button id="alert-registry-close" class="close" type="button"><span aria-hidden="true">&times;</span></button>
						<strong class="registry-message"></strong>
					</div>
				</div>
			</div>

		</div>
	</div>

	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/agenda.js"></script>
</body>
</html>