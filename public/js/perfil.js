
	window.addEventListener("load", loadInfo);
	document.getElementById("mod").addEventListener("click",modificar);
	document.getElementById("guardar").addEventListener("click",guardar);
	function loadInfo() {
	var dato = "bandera=infoPerfil"
	miXHR=new XMLHttpRequest();
	// 2 UTILIZAR METODO OPEN
	miXHR.open('POST','../functions/funciones.php');
	miXHR.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	// 3 UTILIZAR METODO SEND
	miXHR.send(dato);
	// 4 ESCUCHAR CAMBIOS
	miXHR.onreadystatechange=function(){
		if(miXHR.readyState==3&&miXHR.status==200){
			console.log('Cargando... Esperando ...');
		}
		if (miXHR.readyState==4&& miXHR.status==200){
			console.log('LISTO!, lo que se cargo fue: ');
			console.log(miXHR.responseText);
			var myObj = JSON.parse(miXHR.responseText);
			var nombre=myObj['nombre'];
			var usuario=myObj['usuario'];
			var imagen=myObj['imagen'];
			var facultad=myObj['facultad'];
			var correo=myObj['correo'];
			var fechaNac=myObj['fechaNac'];

			document.getElementById("nombre").value=nombre;
			document.getElementById("usuario").value=usuario;
			document.getElementById("facultad").value=facultad;
			document.getElementById("correo").value=correo;
			document.getElementById("fechaNac").value=fechaNac;
			document.getElementById("img").src="../files/"+imagen;
			console.log(imagen);
		}
		if (miXHR.readyState==4&& miXHR.status==404){
			console.log('El servidor no está disponible');
			console.log(miXHR.responseText);
		}
	}
}
function modificar(){
	document.getElementById("nombre").removeAttribute('readonly');
	document.getElementById("usuario").removeAttribute('readonly');
	document.getElementById("facultad").removeAttribute('readonly');
	document.getElementById("correo").removeAttribute('readonly');
	document.getElementById("fechaNac").removeAttribute('readonly');
	document.getElementById("contraseña").removeAttribute('readonly');

	document.getElementById("guardar").removeAttribute('button');
	document.getElementById("guardar").classList.remove("d");
	document.getElementById("mod").classList.add("d");
	document.getElementById("mod").disabled=true;
	document.getElementById("file").classList.remove("d");
	document.getElementById("file").disabled=false;
	document.getElementById("guardar").disabled=false;
}
function send_form(){
		var nombre=document.getElementById("nombre");
		var facultad=document.getElementById("facultad");
		var nombreU=document.getElementById("usuario");
		var email=document.getElementById("correo");
		var fecha=document.getElementById("fechaNac");
		var contra=document.getElementById("contraseña");

		var mensaje=document.getElementById("mensaje");
		
		if(nombre.value=="" || facultad.value=="" || nombreU.value=="" || email.value=="" || fechaNac.value==""){
			mensaje.innerHTML="Debes llenar todos los campos";
			mensaje.style.visibility = "visible";
			return false;
		}else{
			if(!val_correo()){
				mensaje.innerHTML="El correo ingresado no es válido";
				mensaje.style.visibility = "visible";
				return false;
			}else if(contra.value.length<8){
				mensaje.innerHTML="La contraseña debe de contener al menos 8 caracteres";
				mensaje.style.visibility = "visible";
				return false;
			}else if(contra.value!=contra2.value){
				mensaje.innerHTML="Las contraseñas no coinciden";
				mensaje.style.visibility = "visible";
				return false;
			}else{
				// document.getElementById("myForm").submit();
				return true;
			}
		}


	}
	function val_correo(){
		var email=document.getElementById("email").value;
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    	return regex.test(email) ? true : false;
	}