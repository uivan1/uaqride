<?php 
require 'bd.php';
require 'constantes.php';
if(isset($_GET['bandera'])){
	$bandera=$_GET['bandera'];

	if($bandera=="'formArtista'"){

		echo "<h1 class='title is-3 cc'>Registro Artista</h1>
  <form class='form whi' method='GET' action='../functions/admin.php'>
    Nombre Completo del Artista
    <input class='input' type='text' placeholder='Nombre del artista' name='nombreC' required>
    Nombre Artistico
    <input class='input' type='text' placeholder='Nombre Artistico' name='nombreA' required>
    Fecha de Nacimiento del Artista
    <input class='input' type='date' placeholder='Nombre del artista' name='fechaNac' required>
    <br>
    <br>

    <div class='buttons'>
    <a href='admin.php'>
    <div class='button is-primary'>Regresar</div>
    </a>
    <input type='submit' name='bandera' value='Registrar' class='button'></div>
  </form>";
	}else if($bandera=='Registrar'){
		$nomC=$_GET['nombreC'];
		$nomA=$_GET['nombreA'];
		$fecha=$_GET['fechaNac'];
		if(existArtista($nomC,$nomA)){
			header('location: ../views/admin.php?f=1');
		}else{
			insertarArtista($nomC,$nomA,$fecha);
		}
		
	}else if($bandera=="'formAlbum'"){
		echo "<h1 class='title is-3 cc'>Registro Album</h1>
  <form class='form whi' method='GET' action='../functions/admin.php'>
    Nombre del Album
    <input class='input' type='text' placeholder='Nombre del album' name='nombreA' required>
    Genero
    <input class='input' type='text' placeholder='Genero del Album' name='genero' required>
    Fecha de Publicacion
    <input class='input' type='date' name='fechaPub' required>
    <br>
     <br>
    Artista
    <div class='select'>
      <select name='idArtista'>
    ";
    $queryimg="SELECT idArtista,nombreArtistico FROM artista";
    $res= consulta($queryimg);
   	while ($row = $res->fetch_assoc()) {
    		$idArtista=$row['idArtista'];
    		$nombre=$row['nombreArtistico'];
    		echo "<option value={$idArtista}>{$nombre}</option>";
	}
    echo"</select>
    </div>
    <br>
    <br>
    <div class='buttons'>
    <a href='admin.php'>
    <div class='button is-primary'>Regresar</div>
    </a>
    <input type='submit' name='bandera' value='RegistrarAlbum' class='button'></div>
  </form>";
	}else if($bandera=='RegistrarAlbum'){
		$nomA=$_GET['nombreA'];
		$nomG=$_GET['genero'];
		$fechaP=$_GET['fechaPub'];
		$idArtista=$_GET['idArtista'];
		//echo $nomA,$nomG,$fechaP,$idArtista;
		if(existAlbum($nomA)){
			header('location: ../views/admin.php?f=2');
		}else{
			insertarAlbum($nomA, $nomG, $fechaP,$idArtista);
		}
	}else if($bandera=="'formCancion'"){
		echo "<h1 class='title is-3 cc'>Registro Cancion</h1>
  <form enctype='multipart/form-data' class='form whi' method='POST' action='../functions/admin.php'>
    Titulo de la Cancion
    <input class='input' type='text' placeholder='Nombre de la cancion' name='titulo' required>
    Duración hh:mm:ss
    <input class='input' type='text' placeholder='hh:mm:ss' name='duracion' required>
    <br>
     <br>
    Selecciona el album al que pertenece
    <div class='select'>
      <select name='idAlbum'>
    ";
    $queryimg="SELECT idAlbum,nombreAlbum FROM album";
    $res= consulta($queryimg);
   	while ($row = $res->fetch_assoc()) {
    		$idAlbum=$row['idAlbum'];
    		$nombre=$row['nombreAlbum'];
    		echo "<option value={$idAlbum}>{$nombre}</option>";
	}
    echo"</select>
    </div>
    <br>
    <div class='file has-name'>
  <label class='file-label'>
    <input class='file-input' name='song' size='30' type='file'>
    <span class='file-cta'>
      <span class='file-icon'>
        <i class='fas fa-upload'></i>
      </span>
      <span class='file-label'>
        Selecciona Cancion
      </span>
    </span>
  </label>
</div>
    <br>
    <div class='buttons'>
    <a href='admin.php'>
    <div class='button is-primary'>Regresar</div>
    </a>
    <input type='submit' name='bandera' value='RegistrarCancion' class='button'></div>
  </form>";
	}else if($bandera=="'reporteG'"){
          echo "<table class='table is-bordered'>
                    <th>Total de usuarios registrados</th>
                    <th>Total de artistas dados de alta</th>
                    <th>Total de albumes</th>
                    <th>Total de canciones</th>
                    <th>Total de PlayListCreadas</th>
                    <tr>";
                    $queryimg="SELECT (SELECT COUNT(*) FROM usuario) total,(SELECT COUNT(*) FROM artista) artista,(SELECT COUNT(*) FROM album) album,(SELECT COUNT(*) FROM cancion) cancion,(SELECT COUNT(*) FROM playlist) playlist;";
                    $res= consulta($queryimg);
                    while ($row = $res->fetch_assoc()) {
                        echo "<td>{$row['total']}</td>";
                        echo "<td>{$row['artista']}</td>";
                        echo "<td>{$row['album']}</td>";
                        echo "<td>{$row['cancion']}</td>";
                        echo "<td>{$row['playlist']}</td>";
                        }
                    echo "
                    </tr>
                    <tr>
                    <a href='admin.php'>
                    <div class='button is-primary'>Regresar</div>
                    </a>
                    </tr>
                </table>";
    }else if($bandera=='s-artista'){
        echo "<h1 class='title is-3 cc'>Artista</h1>
    <div class='select'>
      <select id='idArtista' name='idArtista'>
    ";
    $queryimg="SELECT idArtista,nombreArtistico FROM artista";
    $res= consulta($queryimg);
    while ($row = $res->fetch_assoc()) {
            $idArtista=$row['idArtista'];
            $nombre=$row['nombreArtistico'];
            echo "<option value={$idArtista}>{$nombre}</option>";
    }
    echo"</select>
    </div>
    <button class='button is-warning' onclick='formUpdateArtista()'>Modificar</button>
    <button class='button is-danger' onclick='deleteArtista({$idArtista})''>Eliminar</button>
    <a href='admin.php'>
    <button class='button '>Cancelar</button>
    </a>
    ";
    }else if($bandera=="'formUpdateArtista'"){
        $idArtista=$_GET['idArtista'];
        $query="SELECT * FROM artista WHERE idArtista={$idArtista}";
        $res= consulta($query);
        while ($row = $res->fetch_assoc()) {
            $nombreC=$row['nombreCompleto'];
            $nombre=$row['nombreArtistico'];
            $fechaNac=$row['fechaNac'];
            //echo $nombreC,$nombre,$fechaNac;
        }
        echo "<div class='whi'>
        <h1 class='title is-3 cc'>Actualizar Artista</h1>
    Nombre Completo del Artista
    <input id='nc' class='input' type='text' placeholder='Nombre del artista' name='nombreC' required value='{$nombreC}'>
    Nombre Artistico
    <input id='na' class='input' type='text' placeholder='Nombre Artistico' name='nombreA' required value='{$nombre}'>
    Fecha de Nacimiento del Artista
    <input id='fn' class='input' type='date' placeholder='Nombre del artista' name='fechaNac' required value='{$fechaNac}'>
    <br>
    <br>

    <div class='buttons'>
    <a href='admin.php'>
    <div class='button is-primary'>Regresar</div>
    </a>
    <button class='button' onclick='updateArtista({$idArtista})'>Actualizar</button>
    </div>
    </div>
  ";
    }else if($bandera=="'updateArtista'"){
        $idArtista=$_GET['idArtista'];
        $nomC=$_GET['nombreCompleto'];
        $nomA=$_GET['nombreArtistico'];
        $fecha=$_GET['fechaNac'];
        $query2 = "UPDATE artista SET nombreCompleto = '$nomC',nombreArtistico='$nomA',fechaNac='$fecha' WHERE idArtista={$idArtista} ";
        $resultado2 = consulta($query2);
    }else if($bandera=="'deleteArtista'"){
        $idArtista=$_GET['idArtista'];
        $query="SELECT deleteArtista({$idArtista})";
        $res= consulta($query);
    }
}else{
	if(isset($_POST['bandera'])){
		$bandera=$_POST['bandera'];
		if($bandera=='RegistrarCancion'){
		$titulo=$_POST['titulo'];
		$duracion=$_POST['duracion'];
		$idAlbum=$_POST['idAlbum'];
		//$idArtista=$_GET['idArtista'];
		if(existCancion($titulo,$idAlbum)){
			header('location: ../views/admin.php?f=3');
		}else{
			insertarCancion($titulo,$duracion,$idAlbum);
		}
	}
}
}

// Funciones de artista
function existArtista($nombreC,$nombreA){
	$q = "SELECT count(*) as existe FROM artista WHERE nombreCompleto='{$nombreC}' OR nombreArtistico='{$nombreA}';";
	$res = consulta($q);
	while ($row = $res->fetch_assoc()) {
    $val=$row['existe'];
	}
	if($val>0){
		return True;
	}else{
		return False;
	}
}
//
function insertarArtista($nombre, $pseudonimo, $nacimiento){
	$q = "INSERT INTO artista(nombreCompleto, nombreArtistico, fechaNac) VALUES ('".$nombre."', '".$pseudonimo."', '".$nacimiento."');";
	
	consulta($q);
	header('location: ../views/admin.php?t=1');
}
//------------------------------funciones del Album
function existAlbum($nombreA){
	$q = "SELECT count(*) as existe FROM album WHERE nombreAlbum='{$nombreA}';";
	$res = consulta($q);
	while ($row = $res->fetch_assoc()) {
    $val=$row['existe'];
	}
	if($val>0){
		return True;
	}else{
		return False;
	}
}
//
function insertarAlbum($nombreA, $genero, $fechaP,$idArtista){
	$estructura = "../files/musica/{$nombreA}";
	$q = "INSERT INTO album(nombreAlbum, genero, fechaPublicacion,rutaImagen) VALUES ('".$nombreA."', '".$genero."', '".$fechaP."','".$estructura."');";
	$estructura=$estructura.'/';
	consulta($q);
	$query="SELECT MAX(idAlbum) as idAlbum FROM album";
	//echo $query;
    		$res= consulta($query);
    		while ($row = $res->fetch_assoc()) {
    			$idAlbum=$row['idAlbum'];
			}
	consulta($query);
	$qu = "INSERT INTO relalbum (idArtista,idAlbum) values ({$idArtista},{$idAlbum})";
	// Estructura de la carpeta deseada
	consulta($qu);

 //echo $estructura;
// Para crear una estructura anidada se debe especificar
// el parámetro $recursive en mkdir().
 
if(!mkdir($estructura, 0777, true)) {
    die('Fallo al crear las carpetas...');
}
	header('location: ../views/admin.php?t=2');
}
//cancion
function existCancion($titulo,$idAlbum){
	$q = "SELECT count(*) as existe FROM cancion WHERE titulo='{$titulo}' and idAlbum={$idAlbum};";
	$res = consulta($q);
	while ($row = $res->fetch_assoc()) {
    $val=$row['existe'];
	}
	if($val>0){
		return True;
	}else{
		return False;
	}
}
function insertarCancion($titulo, $duracion, $idAlbum){
	
	$q = "INSERT INTO cancion(titulo, duracion, idAlbum) VALUES ('".$titulo."', '".$duracion."', '".$idAlbum."');";
	consulta($q);
	$query="SELECT MAX(idCancion) as idCancion FROM cancion";
	$res= consulta($query);
    	while ($row = $res->fetch_assoc()) {
    		$idCancion=$row['idCancion'];
		}
	$query2="SELECT nombreAlbum FROM album WHERE idAlbum={$idAlbum}";

	$res2= consulta($query2);
    	while ($row2 = $res2->fetch_assoc()) {
    		$nombreAlbum=$row2['nombreAlbum'];
	}
		subirCancion($idCancion,$nombreAlbum);
	
}

function subirCancion($idCancion,$nombreAlbum){
    $nombre_song = $_FILES['song']['name'];
    $tipo = $_FILES['song']['type'];
    $tamano = $_FILES['song']['size'];
     
    //Si la song no existe
    if ($nombre_song == NULL) 
        exit(header("location: ../views/admin.php?f=3"));

    //Si existe la variable pero se pasa del tamaño permitido
    if ($_FILES['song']['size'] >= 200000000)
        exit(header("location: ../views/admin.php?f=3"));

    //Si la imagen no tiene el formato valido
    if (($tipo == "song/mp3") || ($tipo == "song/mp4")){
        exit(header("location: ../views/admin.php?f=3"));
    } 
       $path="/cuimusic/cuimusic/files/musica/$nombreAlbum/";
    // Ruta donde se guardarán las imágenes que subamos
    $directorio = $_SERVER['DOCUMENT_ROOT'].$path;

    // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
    move_uploaded_file($_FILES['song']['tmp_name'], $directorio.$nombre_song);
    $query2 = "UPDATE cancion SET rutaCancion = '$nombre_song' WHERE idCancion={$idCancion}";
    $resultado2 = consulta($query2);
    if ($resultado2 != 1){	
        exit(header("location: ../views/admin.php?f=3"));
    }else{
    	header('location: ../views/admin.php?t=3');
    }
}

?>
