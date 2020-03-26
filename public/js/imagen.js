
   	setTimeout(function(){ imagen() }, 2000);

   	function imagen(){
    var dato = "bandera=img";
    miXHR=new XMLHttpRequest();
	miXHR.open('POST','../functions/funciones.php');
	miXHR.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	miXHR.send(dato);
	miXHR.onreadystatechange=function(){
		if(miXHR.readyState==3&&miXHR.status==200){
			console.log('Cargando... Esperando ...');
		}
		if (miXHR.readyState==4&& miXHR.status==200){
			console.log('LISTO!, lo que se cargo fue: ');
			console.log(miXHR.responseText);
			document.getElementById("im").src="../files/"+miXHR.responseText;
		}
		if (miXHR.readyState==4&& miXHR.status==404){
			console.log('El servidor no está disponible');
			console.log(miXHR.responseText);
		}
	}
}

