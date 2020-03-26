<?php
session_start();
//echo var_dump($_SESSION);
if (!isset($_SESSION['id'])) {
    header("location: ../public/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>VER VIAJES</title>
	<link rel="stylesheet" type="text/css" href="css/verViaje.css">
</head>
<body class="html">
	<div>
		<img src="img/logo.png" class="ll">
	</div>
	<a href="verViaje.php">
		<button class="botonNav">Viajes Disponibles</button>
	</a>
	<a href="verViajeReservado.php">
		<button class="botonNav activo">Viajes Reservados</button>
	</a>
	<a href="publicar.php">
		<button class="botonNav">Publica Tu Viaje</button>
	</a>
	<a href="verViajePub.php">
		<input type="button" value="Tus Viajes Publicados" class="botonNav">
	</a>
	<!-- <input type="text" name="search" placeholder="Buscar..." class="bv"><button class="lupa"><img src="img/lupa.png" class="lupa"></button><br> -->
	<!-- <button class="usuario"><img src="img/usuario.png" class="usuario"></button> -->
	<a href="perfil.php">
		<input id="im" type="image" name="enviar" src="img/perfil.png" class="btnPerfil"/>
	</a>
	<hr>
	<div class="div1">
		<div id="padre" style="height: 100%; overflow-y: auto;">
			<div class="d">
				<img src="img/persona1.png" class="persona">
				<p class="nameD">Nombre <br>Edad <br>Facultad</p>
				<hr width="1" color="gray" size="150" class="linea">
				<p class="nameI">Fecha <br>Origen - Destino <br>$00.00</p>
				<button class="b">ver</button>
			</div>
			<!-- <div class="d">
				<img src="img/persona2.png" class="persona">
				<p class="nameD">Nombre <br>Edad <br>Facultad</p>
				<hr width="1" color="gray" size="150" class="linea">
				<p class="nameI">Fecha <br>Origen - Destino <br>$00.00</p>
				<button class="b">ver</button>
			</div>
			<div class="d">
				<img src="img/persona3.png" class="persona">
				<p class="nameD">Nombre <br>Edad <br>Facultad</p>
				<hr width="1" color="gray" size="150" class="linea">
				<p class="nameI">Fecha <br>Origen - Destino <br>$00.00</p>
				<button class="b">ver</button>
			</div>
			<div class="d">
				<img src="img/persona3.png" class="persona">
				<p class="nameD">Nombre <br>Edad <br>Facultad</p>
				<hr width="1" color="gray" size="150" class="linea">
				<p class="nameI">Fecha <br>Origen - Destino <br>$00.00</p>
				<button class="b">ver</button>
			</div>
			<div class="d">
				<img src="img/persona3.png" class="persona">
				<p class="nameD">Nombre <br>Edad <br>Facultad</p>
				<hr width="1" color="gray" size="150" class="linea">
				<p class="nameI">Fecha <br>Origen - Destino <br>$00.00</p>
				<button class="b">ver</button>
			</div>
			<div class="d">
				<img src="img/persona3.png" class="persona">
				<p class="nameD">Nombre <br>Edad <br>Facultad</p>
				<hr width="1" color="gray" size="150" class="linea">
				<p class="nameI">Fecha <br>Origen - Destino <br>$00.00</p>
				<button class="b">ver</button>
			</div> -->
		</div>
	</div>
	<div class="divIzq">
		<h3 class="busqueda"><i> <hr/>FILTROS DE BUSQUEDA</i></h3>
		<input id="o" type="text" name="origen" class="origen" placeholder="Origen">
		<button id="flecha" class="flechas"><img src="img/flechas.png" class="flechas"></button>
		<input id="d" type="text" name="destino" class="destino" placeholder="Destino">
		<h2 class="fecha"><i><b>Fecha</b></i></h2>
		<input id="f" type="date" class="calendario"><br>
		<h2 class="precio"><i><b>Precio</b></i></h2><br>
		<p class="p" id="val">Rango de precio: $0 - $150</p>
		<input id="slider" type="range" name="precio" min="0" max="150" step="1" value="0" class="rango">
		<button onclick="ver()" class="buscar" style="position: fixed;
	right:60px;
	bottom: 315px;">Buscar</button>
		<!-- <h2 class="fecha2"><b><i>Fecha:</i></b></h2>
		<button class="calendar"><a href="calendario.html"><img src="img/calendar.png" class="calendar"></a></button>
		<h2 class="ubicacion"><b><i>Ubicacion:</i></b></h2>
		<button class="location"><img src="img/ubicacion.png" class="location"></button> -->
	</div>
	<!-- <div class="divIzq2">
		<center><h3>Vista Viajes Disponibles</h3></center>
		<center><p>Nombre UNO <br> Nombre DOS <br> Nombre TRES<br></p></center>
	</div> -->

</body>
<script src="js/imagen.js"></script>
<script src="js/verViajeReservado.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXehX75JTcGWUuZdBL_GWzRSguwQeTagg&libraries=places,directions&callback=initAutocomplete"
    async defer></script>

</html>
