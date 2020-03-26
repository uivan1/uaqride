<?php
session_start();
//echo var_dump($_SESSION);
if (isset($_SESSION['id'])) {
    header("location: ../public/verViaje.php");
    exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/login.css">
<title>login</title>
</head>
<body bgcolor=" #BADCE6">
	<nav>
		<div>
			<img src="img/logo.png">
		</div>
		<!-- <div class="nav">
			<input type="button" value="Viajes Disponibles" class="botonNav">
			<input type="button" value="Publica tu viaje" class="botonNav">
			<div class="busqueda">
			<input type="text" placeholder="Buscar..." class="inputBuscar">
			<input type="image" name="enviar" src="img/buscar.png" class="btnBuscar"/>
		</div>
		</div> -->
		<div>
			<hr>
		</div>
	</nav>
	<section>
		<div class="registro">
			<h1>¿No tienes cuenta?</h1>
			<form id="myForm" action="../functions/funciones.php" method="post" onsubmit="return send_form()" enctype="multipart/form-data">
				<input name="nombre" id="nombre" type="text" placeholder="Nombre Completo" class="campo"><br>
				<input name="usuario" id="nombreU" type="text" placeholder="Nombre de usuario" class="campo"><br>
				<input name="facultad" id="facultad" type="text" placeholder="Facultad" class="campo"><br>
				<!-- <input name="expediente" id="expediente" type="number" placeholder="Expediente" class="campo"><br> -->
				<input name="correo" id="email" type="email" placeholder="Email" class="campo"><br>
				<input id="fechaNac" type="date" name="fechaNac" class="campo">
				<input name="pass" id="contra" type="password" placeholder="Contraseña" class="campo"><br>
				<input id="contra2" type="password" placeholder="Confirmar contraseña" class="campo"><br>
				Imagen de Perfil
				<br>
				<input name="imagen" size="30" type="file" accept="image/*" class="btnfile">
					<p id="mensaje" class="warning">Mensaje</p>
				<input name="bandera" id="reg" value="Registrarme" type="submit" class="boton">
				<br>
			</form>
		</div>
		<div class="login">
			<h1>¿Ya tienes cuenta?</h1>
			<form action="../functions/funciones.php" method="post" onsubmit="return send_form2()">
				<input id="u" name="usuario" type="text" placeholder="Nombre de usuario o correo" class="campo"><br>
				<input id="p" name="pass" type="password" placeholder="Contraseña" class="campo"><br>
				<p id="mensaje2" class="warning">Mensaje</p>
				<input name="bandera" type="submit" value="Iniciar Sesión" class="boton"><br>
			</form>
		</div>
	</section>
</body>
<!-- <script src="js/login.js"></script> -->
</html>
<?php
include 'mensaje.php';
?>