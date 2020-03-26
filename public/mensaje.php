<?php
if (isset($_GET['t'])) {
    if ($_GET['t'] == 1) {
        echo "<script language='javascript' type='text/javascript'>";
        echo "var mensaje=document.getElementById('mensaje');";
        echo "mensaje.innerHTML='Usuario Modificado Exitosamente';";
        echo "mensaje.style.visibility = 'visible';
		</script>";
    }
}
if (isset($_GET['e'])) {
    switch ($_GET['e']) {
        case 1:
            echo "<script language='javascript' type='text/javascript'>";
            echo "var mensaje=document.getElementById('mensaje');";
            echo "mensaje.innerHTML='Debes llenar todos los campos';";
            echo "mensaje.style.visibility = 'visible';
		</script>";
            break;
        case 2:
            echo "<script language='javascript' type='text/javascript'>";
            echo "var mensaje=document.getElementById('mensaje');";
            echo "mensaje.innerHTML='Ese nombre de usuario o correo ya esta en uso';";
            echo "mensaje.style.visibility = 'visible';
			</script>";
            break;
        case 3:
            echo "<script language='javascript' type='text/javascript'>";
            echo "var mensaje=document.getElementById('mensaje');";
            echo "mensaje.innerHTML='Error al registrar usuario';";
            echo "mensaje.style.visibility = 'visible';
			</script>";
            break;
        case 4:
            echo "<script language='javascript' type='text/javascript'>";
            echo "var mensaje=document.getElementById('mensaje');";
            echo "mensaje.innerHTML='La imagen es muy grande no se subio correctamente, Usuario registrado';";
            echo "mensaje.style.visibility = 'visible';
			</script>";
            break;
        case 5:
            echo "<script language='javascript' type='text/javascript'>";
            echo "var mensaje=document.getElementById('mensaje');";
            echo "mensaje.innerHTML='La imagen debe ser formato: jpg, jpeg, png, gif. Usuario registrado';";
            echo "mensaje.style.visibility = 'visible';
			</script>";
            break;
        case 6:
            echo "<script language='javascript' type='text/javascript'>";
            echo "var mensaje=document.getElementById('mensaje');";
            echo "mensaje.innerHTML='La imagen no se subio correctamente, Usuario registrado';";
            echo "mensaje.style.visibility = 'visible';
			</script>";
            break;
        case 7:
            echo "<script language='javascript' type='text/javascript'>";
            echo "var mensaje=document.getElementById('mensaje');";
            echo "mensaje.innerHTML='No se selecciono una imagen. Usuario registrado';";
            echo "mensaje.style.visibility = 'visible';
			</script>";
            break;
        case 8:
            echo "<script language='javascript' type='text/javascript'>";
            echo "var mensaje2=document.getElementById('mensaje2');";
            echo "mensaje2.innerHTML='nombre de usuario ó contraseña incorrecta';";
            echo "mensaje2.style.visibility = 'visible';
			</script>";
            break;
        default:break;
    }
}
