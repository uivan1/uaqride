document.getElementById("reg").addEventListener("click",send_form);
	function val_correo(){
		var email=document.getElementById("email").value;
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    	return regex.test(email) ? true : false;
	}
	function send_form(){
		var nombre=document.getElementById("nombre");
		var facultad=document.getElementById("facultad");
		var nombreU=document.getElementById("nombreU");
		var email=document.getElementById("email");
		var fecha=document.getElementById("fechaNac");
		var contra=document.getElementById("contra");
		var contra2=document.getElementById("contra2");

		var mensaje=document.getElementById("mensaje");
		
		if(nombre.value=="" || facultad.value=="" || nombreU.value=="" || email.value=="" || contra.value=="" || contra2.value=="" || fechaNac.value==""){
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
	function send_form2(){
		var u=document.getElementById("u");
		var p=document.getElementById("p");
		var mensaje2=document.getElementById("mensaje2");
		if(u.value=="" || facultad.p=="" ){
			mensaje2.innerHTML="Debes de llenar ambos campos";
			mensaje2.style.visibility = "visible";
			return false;
		}else{
			return true;
		}
	}