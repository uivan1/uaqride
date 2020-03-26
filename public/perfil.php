<?php
session_start();
//echo var_dump($_SESSION);
if (!isset($_SESSION['id'])) {
    header("location: ../public/login.php");
    exit;
}
?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="css/perfil.css">
<meta charset="UTF-8">
<title>Perfil</title>
</head>
<body bgcolor=" #BADCE6">
	<nav>
		<div>
			<img src="img/logo.png">
		</div>
		<div class="nav">
			<a href="verViaje.php">
				<input type="button" value="Viajes Disponibles" class="botonNav">
			</a>
			<a href="verViajeReservado.php">
		<button class="botonNav">Viajes Reservados</button>
	</a>
			<a href="publicar.php">
				<input type="button" value="Publica tu viaje" class="botonNav activo">
			</a>
			<a href="verViajePub.php">
				<input type="button" value="Tus Viajes Publicados" class="botonNav">
			</a>
			<input id="im" type="image" name="enviar" src="img/perfil.png" class="btnPerfil"/>
			<!-- <div class="busqueda">
				<input type="text" placeholder="Buscar..." class="inputBuscar">
				<input type="image" name="enviar" src="img/buscar.png" class="btnBuscar"/>
			</div>	 -->
		</div>
		</div>
		<div>
			<hr>
		</div>
	</nav>
	<section>
		<div class="perfil">
			<form action="../functions/funciones.php" method="post" enctype="multipart/form-data" onsubmit="return send_form()">
				<img id="img" src="img/Foto.png" class="fotoPerfil">
				<input type="file" id="file" name="imagen" value="Cambiar Foto" class="btnFoto d" disabled accept="image/*"><br>
				<p>Nombre Completo: </p><br>
				<input id="nombre" name="nombre" type="text" placeholder="Nombre Completo" class="campoPerfil" readonly><br>
				<p>Nombre de Usuario: </p><br>
				<input id="usuario" name="usuario" type="text" placeholder="Nombre Usuario" class="campoPerfil" readonly><br>
				<p>Facultad: </p><br>
				<input id="facultad" name="facultad" type="text" placeholder="Facultad" class="campoPerfil" readonly><br>
				<p>Email: </p><br>
				<input id="correo" name="correo" type="email" placeholder="Email" class="campoPerfil" readonly><br><br>
				<p>Contraseña: </p><br>
				<input id="contraseña" name="pass" type="password" placeholder="********" class="campoPerfil" readonly><br>
				<p>Fecha de naciento</p>
				<input id="fechaNac" name="fechaNac" type="date" readonly>
				<p id="mensaje" class="warning">Mensaje</p>
				<div class="BotonesPerfil">
					<input id="mod" type="button" value="Modificar" class="btnMod">
					<input id="guardar" type="submit" name="bandera" value="Guardar" class="btnConf d" disabled>
					<input type="submit" name="bandera" value="cerrar sesion" class="btnMod">
				</div>
			</form>
		</div>
	</section>
</body>
<script src="js/perfil.js"></script>
<script src="js/imagen.js"></script>
</html>
<?php
include 'mensaje.php';
?>