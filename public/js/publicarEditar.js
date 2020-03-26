
	var x;
	var idViaje=sessionStorage.getItem("idViaje");
	document.getElementById("idViaje").value=idViaje;
	var waypts=[];
	if(idViaje==undefined){
		location.href="verViaje.php";
	}else{
		var dato = "bandera=infoViaje&idViaje="+idViaje;
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
			// console.log(miXHR.responseText);
			console.log(miXHR.responseText);
			var myObj = JSON.parse(miXHR.responseText);
			var origen=myObj[0]['origen'];
			var destino=myObj[0]['destino'];
			var usuario=myObj[0]['usuario'];
			var escalas=myObj[0]['escalas'];
			var salida2=myObj[0]['salida'];
			var idayvuelta=myObj[0]['idayvuelta'];
			var lugares=myObj[0]['lugares'];
			var precio=myObj[0]['precio'];
			// console.log(origen);
			//
			var salida=document.getElementById("pac-input");
    		var d=document.getElementById("pac-input2");
    		var paradas=document.getElementById("pac-input3");
    		var fecha=document.getElementById("fecha");
    		var vuelta=document.getElementById("vuelta");
    		var l=document.getElementById("lugares");
    		var p=document.getElementById("precio");

    		var slider=document.getElementById("slider");

    		salida.value=origen;
    		d.value=destino;
    		paradas.value=escalas;
    		var dt = new Date(salida2);
    		salida2=toDatetimeLocal(dt);
    		// alert(salida2);
    		fecha.value=salida2;
    		if(idayvuelta==0){
    			vuelta.checked = false;
    		}else{
    			vuelta.checked = true;
    		}
    		l.value=lugares;
    		p.value=precio;
    		slider.value=precio;
    		// alert(dt.toISOString());
    		// let date = dt.format('yyyy-MM-ddTHH:mm:ss.fffZ');
    		// alert(date);
		
		}
		if (miXHR.readyState==4&& miXHR.status==404){
			console.log('El servidor no está disponible');
			console.log(miXHR.responseText);
		}
	}
	}

  function toDatetimeLocal(date) {
  
      ten = function (i) {
        return (i < 10 ? '0' : '') + i;
      },
      YYYY = date.getFullYear(),
      MM = ten(date.getMonth() + 1),
      DD = ten(date.getDate()),
      HH = ten(date.getHours()),
      II = ten(date.getMinutes()),
      SS = ten(date.getSeconds())
    ;
    return YYYY + '-' + MM + '-' + DD + 'T' +
             HH + ':' + II + ':' + SS;
  }
  var a,b,c;
  function verViaje(){
  	var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 20.6121228, lng: -100.4802576},
          zoom: 13,
          mapTypeId: 'roadmap'
        });

  	var input = document.getElementById('pac-input');
 	var input2 = document.getElementById('pac-input2');
	var input3 = document.getElementById('pac-input3');

  		// alert(arr[i]);
		miXHR=new XMLHttpRequest();
		miXHR.open('GET','https://maps.googleapis.com/maps/api/geocode/json?address='+input.value+"&key=AIzaSyCXehX75JTcGWUuZdBL_GWzRSguwQeTagg");
		miXHR.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		miXHR.send();
		miXHR.onreadystatechange=function(){
		if(miXHR.readyState==3&&miXHR.status==200){
			console.log('Cargando... Esperando ...');
		}
		if (miXHR.readyState==4&& miXHR.status==200){
			console.log('LISTO!, lo que se cargo fue: ');
			// console.log(miXHR.responseText);
			console.log(miXHR.responseText);
			var myObj = JSON.parse(miXHR.responseText);
			console.log(myObj);
			x=myObj['results'][0]['geometry']['location'];
			a=x;

			
		// 	var marker = new google.maps.Marker({
  //   			position: location,
  //   			title:"Hello World!"
		// 	});
		// marker.setMap(map);
		// map.setCenter(marker.getPosition()); 
		
		}
		if (miXHR.readyState==4&& miXHR.status==404){
			console.log('El servidor no está disponible');
			console.log(miXHR.responseText);
		}


  }

  //
  	miXHR2=new XMLHttpRequest();
		miXHR2.open('GET','https://maps.googleapis.com/maps/api/geocode/json?address='+input2.value+"&key=AIzaSyCXehX75JTcGWUuZdBL_GWzRSguwQeTagg");
		miXHR2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		miXHR2.send();
		miXHR2.onreadystatechange=function(){
		if(miXHR2.readyState==3&&miXHR2.status==200){
			console.log('Cargando... Esperando ...');
		}
		if (miXHR2.readyState==4&& miXHR2.status==200){
			console.log('LISTO!, lo que se cargo fue: ');
			// console.log(miXHR2.responseText);
			console.log(miXHR2.responseText);
			var myObj = JSON.parse(miXHR2.responseText);
			console.log(myObj);
			x=myObj['results'][0]['geometry']['location'];
			b=x;
		}
		if (miXHR2.readyState==4&& miXHR2.status==404){
			console.log('El servidor no está disponible');
			console.log(miXHR2.responseText);
		}
  }
  //
  miXHR3=new XMLHttpRequest();
		miXHR3.open('GET','https://maps.googleapis.com/maps/api/geocode/json?address='+input3.value+"&key=AIzaSyCXehX75JTcGWUuZdBL_GWzRSguwQeTagg");
		miXHR3.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		miXHR3.send();
		miXHR3.onreadystatechange=function(){
		if(miXHR3.readyState==3&&miXHR3.status==200){
			console.log('Cargando... Esperando ...');
		}
		if (miXHR3.readyState==4&& miXHR3.status==200){
			console.log('LISTO!, lo que se cargo fue: ');
			// console.log(miXHR3.responseText);
			console.log(miXHR3.responseText);
			var myObj = JSON.parse(miXHR3.responseText);
			console.log(myObj);
			x=myObj['results'][0]['geometry']['location'];
			c=x;
		}
		if (miXHR3.readyState==4&& miXHR3.status==404){
			console.log('El servidor no está disponible');
			console.log(miXHR3.responseText);
		}
  }
		

setTimeout(function(){ console.log('gg');waypts.push({
              location: c,
              stopover: true

            }); calcRoute(a,b,waypts); }, 1000);
}
function calcRoute(start,end,waypts) {

 var directionsService = new google.maps.DirectionsService();
 var directionsDisplay = new google.maps.DirectionsRenderer();
  var request = {
    origin: start,
    destination: end,
    waypoints: waypts,
    travelMode: 'DRIVING'
  };
  directionsService.route(request, function(result, status) {
    if (status == 'OK') {
      directionsDisplay.setDirections(result);
    }
  });
  var mapOptions = {
    zoom:20,
    center: start
  }
  var map = new google.maps.Map(document.getElementById('map'), mapOptions);
  directionsDisplay.setMap(map);
}
setTimeout(function(){ verViaje()}, 1000);
document.getElementById("eliminar").addEventListener("click",function(){
	if(confirm("Se borrárá todo lo relacionado a este viaje ¿Desea continuar?")){
		var dato = "bandera=eliminarViaje&idViaje="+idViaje;
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
			// console.log(miXHR.responseText);
			console.log(miXHR.responseText);
			if(miXHR.responseText="Si"){
				location.href="verViaje.php";
			}else{
				alert("error");
			}
		}
		if (miXHR.readyState==4&& miXHR.status==404){
			console.log('El servidor no está disponible');
			console.log(miXHR.responseText);
		}
	}
	}

});
document.getElementById("finalizarViaje").addEventListener("click",function(){

		var dato = "bandera=finalizar&idViaje="+idViaje;
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
			// console.log(miXHR.responseText);
			console.log(miXHR.responseText);
			if(miXHR.responseText="Si"){
				alert("viaje finalizado exitosamente");
			}else{
				alert("error");
			}
		}
		if (miXHR.readyState==4&& miXHR.status==404){
			console.log('El servidor no está disponible');
			console.log(miXHR.responseText);
		}
	}
	

});