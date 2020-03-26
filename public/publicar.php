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
<meta charset="UTF-8">
<title>Publicar</title>
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/publicar.css">
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
				<input type="button" value="Publica Tu Viaje" class="botonNav activo">
			</a>
			<a href="verViajePub.php">
				<input type="button" value="Tus Viajes Publicados" class="botonNav">
			</a>
			<a href="perfil.php">
				<input id="im" type="image" name="enviar" src="img/perfil.png" class="btnPerfil"/>
			</a>
		<!-- 	<div class="busqueda">
				<input type="text" placeholder="Buscar..." class="inputBuscar">
				<input type="image" name="enviar" src="img/buscar.png" class="btnBuscar"/>
			</div>	 -->
		</div>
		<div>
			<hr>
		</div>
	</nav>
	<section>
		<div class="viaje">
			<div class="mapa" id="map">

			</div>
			<div class="vl"></div>
			<div class="descViaje">
				<form action="../functions/funciones.php" method="post" onsubmit="return validar()">
					<p class="campoViaje">Salida:</p>
					<input type="text" name="origen" class="inputViaje" id="pac-input" type="text" placeholder="Busca Aquí">
					<p class="campoViaje">Destino:</p>
					<input id="pac-input2" type="text" name="destino" placeholder="Busca Aquí" class="inputViaje">
					<p class="campoViaje">Paradas/Escalas:</p>
					<input id="pac-input3" type="text" name="escalas" placeholder="Busca Aquí" class="inputViaje">
					<p class="campoViaje">Fecha:</p>
					<input id="fecha" type="datetime-local" name="salida" class="inputViaje">

					<p class="campoViaje">Ida y vuelta:</p><input value="0" id="vuelta" type="checkbox" name="idayvuelta">

					<p class="campoViaje">Lugares disponibles:</p>
					<input id="lugares" type="number" max="4" min="1" name="lugares" class="inputLugar" value="1">
					<!-- <input type="button" name="sumarLugar" value="+" class="btnLugar">
					<input type="button" name="restarLugar" value="-" class="btnLugar"> -->

					<p class="campoViaje">Precio:</p>
					<input id="precio" type="text" name="precio" class="inputPrecio" value="50">
					<input class="slider" id="slider" type="range" min="1" max="100" value="50" class="slider"><br>
					<sup>*El precio establecido será por lugar</sup><br>
					<p id="mensaje" class="warning">Mensaje</p>
					<input type="submit" name="bandera" value="Publicar Viaje"

					class="btnPublicar">
				</form>
			</div>
		</div>
	</section>
	<!-- <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 15
        });
      }
    </script> -->
<script src="js/publicar.js"></script>
<script src="js/imagen.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXehX75JTcGWUuZdBL_GWzRSguwQeTagg&libraries=places,directions&callback=initAutocomplete"
    async defer></script>

</body>
</html>
<?php
if (isset($_GET['t'])) {
    if ($_GET['t'] == 0) {
        echo "<script language='javascript' type='text/javascript'>";
        echo "var mensaje=document.getElementById('mensaje');";
        echo "mensaje.innerHTML='Viaje Registrado exitosamente';";
        echo "mensaje.style.visibility = 'visible';
		</script>";
    }
}
?>