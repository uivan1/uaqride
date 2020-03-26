<?php

include 'bd.php';
// print_r($_POST);
if (!$_POST) {
    // header("location: registro.php");
    exit;
}

// print_r($_POST);
// exit;
if (isset($_POST['bandera'])) {

    if ($_POST['bandera'] == 'Registrarme') {

        if (!isset($_POST['nombre']) || !isset($_POST['facultad']) || !isset($_POST['correo']) || !isset($_POST['usuario']) || !isset($_POST['pass']) || !isset($_POST['fechaNac'])) {
            header("location: ../public/login.php?e=1");
            exit;
        }
        if (isset($_FILES['imagen'])) {
            $val = true;
        } else {
            $val = false;
        }
        // print_r($_FILES);
        // exit;
        $nombre   = $_POST['nombre'];
        $facultad = $_POST['facultad'];
        $correo   = $_POST['correo'];
        $usuario  = $_POST['usuario'];
        $pass     = $_POST['pass'];
        $fechaNac = $_POST['fechaNac'];

        if (!$nombre || !$facultad || !$correo || !$usuario || !$pass || !$fechaNac) {
            header("location: ../public/login.php?e=1");
            exit;
        }

        if (if_exist($usuario, $correo)) {
            header("location: ../public/login.php?e=2");
        } else {
            insert($nombre, $facultad, $correo, $usuario, $pass, $fechaNac);
        }
    }
    if ($_POST['bandera'] == 'Iniciar Sesión') {
        if (!isset($_POST['usuario']) || !isset($_POST['pass'])) {
            header("location: ../public/login.php?e=1");
            exit;
        }
        $usuario = $_POST['usuario'];
        $pass    = $_POST['pass'];
        if (!$usuario || !$pass) {
            header("location: ../public/login.php?e=1");
            exit;
        }
        login($usuario, $pass);
    }
    //crear

    if ($_POST['bandera'] == 'Publicar Viaje') {

        if (!isset($_POST['idayvuelta'])) {
            $_POST['idayvuelta'] = 0;
        }

        if (!isset($_POST['origen']) || !isset($_POST['destino']) || !isset($_POST['salida']) || !isset($_POST['lugares']) || !isset($_POST['precio'])) {
            echo "../public/Publicar.php?e=0";
            exit;
        }

        $o = $_POST['origen'];
        $d = $_POST['destino'];
        // $e = $_POST['escalas'];
        $s = $_POST['salida'];
        $i = $_POST['idayvuelta'];
        $l = $_POST['lugares'];
        $p = $_POST['precio'];
        // if (!$o || !$d || !$s || !$i || !$l || !$p) {
        //     echo "error";
        //     exit;
        // }

        if (isset($_POST['escalas'])) {
            $e = $_POST['escalas'];
        } else {
            $e = null;
        }
        crear_viaje($o, $d, $e, $s, $i, $l, $p);
    }
    if ($_POST['bandera'] == 'verViajes') {
        $array     = array();
        if($_POST['o']!="" OR $_POST['d']!="" OR $_POST['f']!="" OR $_POST['p']!=""){
            $o=$_POST['o'];
            $d=$_POST['d'];
            $f=$_POST['f'];
            $p=$_POST['p'];
            if($d!=""){
                $d=$d."%";
            }
            if($p=="no"){
                $p="";
            }
            $query     = "SELECT u.nombre,u.fechaNac,u.facultad,u.rutaFoto,v.* FROM viajes v,usuarios u WHERE u.idUsuario=v.idUsuario AND v.origen='{$o}' OR v.destino='{$d}' OR v.salida LIKE '{$f}' OR v.precio='{$p}' AND v.finalizado=0";

        }else{
            $query     = "SELECT u.nombre,u.fechaNac,u.facultad,u.rutaFoto,v.* FROM viajes v,usuarios u WHERE u.idUsuario=v.idUsuario AND v.finalizado=0";
        }
        // echo $query;
        // exit;
        $resultado = consulta($query);
        while ($row = $resultado->fetch_assoc()) {
            array_push($array, $row);
        }
        print_r(json_encode($array));
    }
    if ($_POST['bandera'] == 'verViajesPub') {
        $array     = array();
        session_start();
        $u = $_SESSION['id'];
        if($_POST['o']!="" OR $_POST['d']!="" OR $_POST['f']!="" OR $_POST['p']!=""){
            $o=$_POST['o'];
            $d=$_POST['d'];
            $f=$_POST['f'];
            $p=$_POST['p'];
            if($d!=""){
                $d=$d."%";
            }
            if($p=="no"){
                $p="";
            }
            $query     = "SELECT u.nombre,u.fechaNac,u.facultad,u.rutaFoto,v.* FROM viajes v,usuarios u WHERE u.idUsuario=v.idUsuario AND v.origen='{$o}' OR v.destino='{$d}' OR v.salida LIKE '{$f}' OR v.precio='{$p}' AND v.idUsuario={$u}";

        }else{
            $query     = "SELECT u.nombre,u.fechaNac,u.facultad,u.rutaFoto,v.* FROM viajes v,usuarios u WHERE u.idUsuario=v.idUsuario AND v.idUsuario={$u}";
        }
        // echo $query;
        // exit;
        $resultado = consulta($query);
        while ($row = $resultado->fetch_assoc()) {
            array_push($array, $row);
        }
        print_r(json_encode($array));
    }
    if ($_POST['bandera'] == 'verViajesRes') {
        $array     = array();
        session_start();
        $u = $_SESSION['id'];
        if($_POST['o']!="" OR $_POST['d']!="" OR $_POST['f']!="" OR $_POST['p']!=""){
            $o=$_POST['o'];
            $d=$_POST['d'];
            $f=$_POST['f'];
            $p=$_POST['p'];
            if($d!=""){
                $d=$d."%";
            }
            if($p=="no"){
                $p="";
            }
            $query     = "SELECT u.nombre,u.fechaNac,u.facultad,u.rutaFoto,v.* FROM viajes v,usuarios u,usuarios_viaje us WHERE us.idUsuario={$u} AND us.idViaje=v.idViaje AND v.idUsuario=u.idUsuario AND v.origen='{$o}' OR v.destino='{$d}' OR v.salida LIKE '{$f}' OR v.precio='{$p}'";

        }else{
            $query     = "SELECT u.nombre,u.fechaNac,u.facultad,u.rutaFoto,v.* FROM viajes v,usuarios u,usuarios_viaje us WHERE us.idUsuario={$u} AND us.idViaje=v.idViaje AND v.idUsuario=u.idUsuario;";
        }
        // echo $query;
        // exit;
        $resultado = consulta($query);
        while ($row = $resultado->fetch_assoc()) {
            array_push($array, $row);
        }
        print_r(json_encode($array));
    }
    if ($_POST['bandera'] == 'infoViaje') {
        $idViaje   = $_POST['idViaje'];
        $array     = array();
        $query     = "SELECT u.nombre,u.fechaNac,u.facultad,v.* FROM viajes v,usuarios u WHERE v.idViaje={$idViaje} AND u.idUsuario=v.idUsuario";
        $resultado = consulta($query);
        while ($row = $resultado->fetch_assoc()) {
            array_push($array, $row);
        }
        print_r(json_encode($array));
        //  print_r($_POST);
        // exit;
    }
    if ($_POST['bandera'] == 'Reservar') {
        $idViaje   = $_POST['idViaje'];
        $array     = array();
        $query     = "call infoViaje({$idViaje})";
        $resultado = consulta($query);
        while ($row = $resultado->fetch_assoc()) {
            array_push($array, $row);
        }
        print_r(json_encode($array));
        //  print_r($_POST);
        // exit;
    }
    if ($_POST['bandera'] == 'Reserva Aquí') {
        $idViaje   = $_POST['idViaje'];
        session_start();
        $u = $_SESSION['id'];
        $array     = array();
        $query     = "SELECT reserva({$idViaje},{$u}) as result;";
        $resultado = consulta($query);
        while ($row = $resultado->fetch_assoc()) {
            array_push($array, $row);
        }
        // print_r(json_encode($array));
        if($array[0]['result']==0){
            header("location: ../public/reservar.php?t=0");
        }else if($array[0]['result']==1){
            header("location: ../public/reservar.php?t=1");
        }else if($array[0]['result']==3){
            header("location: ../public/reservar.php?t=3");
        }else{
            header("location: ../public/reservar.php?t=2");
        }
        exit;
        //  print_r($_POST);
        // exit;
    }
    if ($_POST['bandera'] == 'infoPerfil') {
        session_start();
        print_r(json_encode($_SESSION));
        exit;
    }
    if ($_POST['bandera'] == 'Guardar') {
        session_start();
        $id = $_SESSION['id'];
        // print_r(json_encode($_POST));
        // print_r(json_encode($_FILES));
        if (isset($_POST['nombre'], $_POST['facultad'], $_POST['usuario'], $_POST['correo'], $_POST['fechaNac'])) {
            $nombre   = $_POST['nombre'];
            $facultad = $_POST['facultad'];
            $usuario  = $_POST['usuario'];
            $correo   = $_POST['correo'];
            $fechaNac = $_POST['fechaNac'];
            if (isset($_POST['pass'])) {
                $pass  = $_POST['pass'];
                $p     = md5($pass);
                $query = "UPDATE usuarios SET nombre='{$nombre}',facultad='{$facultad}',correo='{$correo}',username='{$usuario}',pass='{$p}',fechaNac='{$fechaNac}' WHERE idUsuario={$id}";
            } else {
                $query = "UPDATE usuarios SET nombre='{$nombre}',facultad='{$facultad}',correo='{$correo}',username='{$usuario}',fechaNac='{$fechaNac}' WHERE idUsuario={$id}";
            }
            $resultado = consulta($query);
            if ($resultado == 1) {
                if(isset($_FILES['imagen']) && $_FILES['imagen']['name']!="") {
                    print_r($_FILES['imagen']['name']);
                    updImgPerfil($id);
                }
                actualizarSesion();
                header("location: ../public/perfil.php?t=1");
                exit;
            } else {
                header("location: ../public/perfil.php?e=3");
                exit;
            }
        }
        exit;
    }
    if ($_POST['bandera'] == 'cerrar sesion') {
        session_start();
        session_destroy();
        header("location: ../public/login.php");
        exit;
    }
    if ($_POST['bandera'] == 'Modificar Viaje') {

        if (!isset($_POST['idayvuelta'])) {
            $_POST['idayvuelta'] = 0;
        }

        if (!isset($_POST['origen']) || !isset($_POST['destino']) || !isset($_POST['salida']) || !isset($_POST['lugares']) || !isset($_POST['precio'])) {
            echo "../public/PublicarEditar.php?e=0";
            exit;
        }

        $o = $_POST['origen'];
        $d = $_POST['destino'];
        // $e = $_POST['escalas'];
        $s = $_POST['salida'];
        $i = $_POST['idayvuelta'];
        $l = $_POST['lugares'];
        $p = $_POST['precio'];
        $idViaje = $_POST['idViaje'];
        // if (!$o || !$d || !$s || !$i || !$l || !$p) {
        //     echo "error";
        //     exit;
        // }

        if (isset($_POST['escalas'])) {
            $e = $_POST['escalas'];
        } else {
            $e = null;
        }
        modificar_viaje($o, $d, $e, $s, $i, $l, $p,$idViaje);
    }
    if ($_POST['bandera'] == 'eliminarViaje') {
        $idViaje=$_POST['idViaje'];
        $q = "DELETE FROM usuarios_viaje WHERE idViaje={$idViaje}";
                    $res = consulta($q);
                        $qu = "DELETE FROM viajes WHERE idViaje={$idViaje}";
                        $resp = consulta($qu);
                        if($resp==1){
                            echo "Si";
                        }else{
                            echo "No";
                        }
                    
        exit;
    }
    if ($_POST['bandera'] == 'finalizar') {
        $idViaje=$_POST['idViaje'];
        $q = "UPDATE viajes set finalizado=1 WHERE idViaje={$idViaje}";
        // echo $q;
        // exit;
        $res = consulta($q);
        if($res==1){
            echo "Si";
        }else{
            echo "No";
        }        
        exit;
    }

    if ($_POST['bandera'] == 'img') {
        session_start();
        echo $_SESSION['imagen'];
        exit;
    }
}
function insert($n, $fac, $co, $u, $p, $f)
{
    $p = md5($p);

    $query = "INSERT INTO usuarios (nombre,facultad,correo,username,pass,fechaNac) values('{$n}','{$fac}','{$co}','{$u}','{$p}','{$f}')";

    $resultado = consulta($query);
    if ($resultado == 1) {

        $queryimg = "SELECT MAX(idUsuario) as idUsuario FROM usuarios";
        $res      = consulta($queryimg);
        //echo $queryimg;
        while ($row = $res->fetch_assoc()) {
            $idUsuario = $row['idUsuario'];
        }
        if (isset($_FILES['imagen'])) {
            imagenPerfil($idUsuario);
        }
        actualizarSesion();
        header("location: ../public/login.php?t=1");
        exit;
    } else {
        header("location: ../public/login.php?e=3");
        exit;
    }
}
function if_exist($u, $co)
{
    $query = "SELECT count(*) as existe FROM usuarios WHERE username='{$u}' OR correo='{$co}'";
    $res   = consulta($query);
    // echo $query;
    // exit;
    while ($row = $res->fetch_assoc()) {
        $val = $row['existe'];
    }
    if ($val > 0) {
        return true;
    } else {
        return false;
    }
}
function login($u, $p)
{
    $p = md5($p);

    $query = "SELECT * FROM usuarios WHERE username='{$u}' AND pass='{$p}' OR correo='{$u}' AND pass='{$p}'";
    // echo $query;
    $resultado = consulta($query);
    if ($resultado->num_rows == 0) {
        header("location: ../public/login.php?e=8");
        exit;
    } else {
        session_start();
        while ($r = mysqli_fetch_array($resultado)) {
            $_SESSION['id']       = $r['idUsuario'];
            $_SESSION['nombre']   = $r['nombre'];
            $_SESSION['facultad'] = $r['facultad'];
            $_SESSION['correo']   = $r['correo'];
            $_SESSION['usuario']  = $r['username'];
            $_SESSION['fechaNac'] = $r['fechaNac'];
            if ($r['rutaFoto'] != null) {
                $_SESSION['imagen'] = $r['rutaFoto'];
            } else {
                $_SESSION['imagen'] = "user.png";
            }
        }
        //main principal
        //header("location: ../views/plataforma.php");
        // echo "echo";
        header("location: ../public/verViaje.php");
        exit;
    }
}

function imagenPerfil($idUsuario)
{

    $nombre_img = $_FILES['imagen']['name'];
    $tipo       = $_FILES['imagen']['type'];
    $tamano     = $_FILES['imagen']['size'];

    //Si la imagen no existe
    if ($nombre_img == null) {
        exit(header("location: ../public/login.php?e=7"));
    }

    //Si existe la variable pero se pasa del tamaño permitido
    if ($_FILES['imagen']['size'] >= 200000) {
        exit(header("location: ../public/login.php?e=4"));
    }

    //Si la imagen no tiene el formato valido
    // if (($tipo == "image/gif") || ($tipo == "image/jpeg") || ($tipo == "image/jpg") || ($tipo == "image/png")){
    //     exit(header("location: ../public/login.php?e=5"));
    // }

    // Ruta donde se guardarán las imágenes que subamos
    $directorio = $_SERVER['DOCUMENT_ROOT'] . '/uaqride/files/';

    // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
    move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $nombre_img);
    $query2     = "UPDATE usuarios SET rutaFoto = '$nombre_img' WHERE idUsuario={$idUsuario}";
    $resultado2 = consulta($query2);
    if ($resultado2 != 1) {
        exit(header("location: ../public/login.php?e=6"));
    }

}
function updImgPerfil($idUsuario)
{

    $nombre_img = $_FILES['imagen']['name'];
    $tipo       = $_FILES['imagen']['type'];
    $tamano     = $_FILES['imagen']['size'];

    //Si la imagen no existe
    if ($nombre_img == null) {
        exit(header("location: ../public/perfil.php?e=7"));
    }

    //Si existe la variable pero se pasa del tamaño permitido
    if ($_FILES['imagen']['size'] >= 200000) {
        exit(header("location: ../public/perfil.php?e=4"));
    }

    //Si la imagen no tiene el formato valido
    // if (($tipo == "image/gif") || ($tipo == "image/jpeg") || ($tipo == "image/jpg") || ($tipo == "image/png")){
    //     exit(header("location: ../public/perfil.php?e=5"));
    // }

    // Ruta donde se guardarán las imágenes que subamos
    $directorio = $_SERVER['DOCUMENT_ROOT'] . '/uaqride/files/';

    // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
    move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $nombre_img);
    $query2     = "UPDATE usuarios SET rutaFoto = '$nombre_img' WHERE idUsuario={$idUsuario}";
    $resultado2 = consulta($query2);
    if ($resultado2 != 1) {
        exit(header("location: ../public/perfil.php?e=6"));
    }

}
function crear_viaje($o, $d, $e, $s, $i, $l, $p)
{
    session_start();
    $u = $_SESSION['id'];
    $s = date('Y-m-d H:i:s', strtotime($s));

    $query = "INSERT INTO viajes (idUsuario,origen,destino,escalas,salida,idayvuelta,lugares,precio,finalizado) values({$u},'{$o}','{$d}','{$e}','{$s}',{$i},{$l},{$p},0)";
    //echo $query;
    $resultado = consulta($query);

    if ($resultado == 1) {
        exit(header("location: ../public/publicar.php?t=0"));

    } else {
        exit(header("location: ../public/publicar.php?e=0"));
    }
}
function modificar_viaje($o, $d, $e, $s, $i, $l, $p,$idViaje)
{
    session_start();
        $u = $_SESSION['id'];

    $s = date('Y-m-d H:i:s', strtotime($s));

    $query = "UPDATE viajes SET origen='{$o}',destino='{$d}',escalas='{$e}',salida='{$s}',idayvuelta={$i},lugares='{$l}',precio='{$p}' WHERE idUsuario={$u} AND idViaje={$idViaje}";
    // echo $query;
    // exit;
    $resultado = consulta($query);

    if ($resultado == 1) {
        exit(header("location: ../public/publicarEditar.php?t=0"));

    } else {
        exit(header("location: ../public/publicarEditar.php?e=0"));
    }
}

function actualizarSesion()
{
    session_start();
    $id        = $_SESSION['id'];
    $query     = "SELECT * FROM usuarios WHERE idUsuario={$id}";
    $resultado = consulta($query);
    while ($r = mysqli_fetch_array($resultado)) {
        $_SESSION['id']       = $r['idUsuario'];
        $_SESSION['nombre']   = $r['nombre'];
        $_SESSION['facultad'] = $r['facultad'];
        $_SESSION['correo']   = $r['correo'];
        $_SESSION['usuario']  = $r['username'];
        $_SESSION['fechaNac'] = $r['fechaNac'];
        if ($r['rutaFoto'] != null) {
            $_SESSION['imagen'] = $r['rutaFoto'];
        } else {
            $_SESSION['imagen'] = "user.png";
        }
    }

}
