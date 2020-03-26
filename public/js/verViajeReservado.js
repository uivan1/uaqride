window.addEventListener("load",ver());
	 var slider=document.getElementById("slider");


// Update the current slider value (each time you drag the slider handle)
slider.oninput = function() {
  document.getElementById("val").innerHTML = this.value;
}


function ver(){
	var o=document.getElementById("o").value;
	var d=document.getElementById("d").value;
	var f=document.getElementById("f").value;
	var p=document.getElementById("slider").value;
	if (p==0) {
		p="";
	}

	var dato = "bandera=verViajesRes&o="+o+"&d="+d+"&f="+f+"&p="+p;
	// 1 CREAR INSTANCIA DE OBJETO
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
			// if (myObj.length == undefined) {
   //              var myObj2 = [];
   //              myObj2[0] = [];
   //              myObj2[0]['idViaje'] = myObj['idViaje'];
   //              myObj2[0]['idUsuario'] = myObj['idUsuario'];
   //              myObj2[0]['origen'] = myObj['origen'];
   //              myObj2[0]['destino'] = myObj['destino'];
   //              myObj2[0]['escalas'] = myObj['escalas'];
   //              myObj2[0]['salida'] = myObj['salida'];
   //              myObj2[0]['idayvuelta'] = myObj['idayvuelta'];
   //              myObj2[0]['lugares'] = myObj['lugares'];
   //              myObj2[0]['precio'] = myObj['precio'];
   //              myObj2[0]['finalizado'] = myObj['finalizado'];
   //              var myObj = myObj2;
   //          }
   document.getElementById("padre").innerHTML="";
			for (var i = 0; i < myObj.length; i++) {
				var nombre = myObj[i]['nombre'];
				var fechaNac = myObj[i]['fechaNac'];
				var facultad = myObj[i]['facultad'];
				var foto = myObj[i]['rutaFoto'];
				if(foto==""){
					foto="user.png";
				}
				var idViaje = myObj[i]['idViaje'];
                var idUsuario = myObj[i]['idUsuario'];
                var origen = myObj[i]['origen'];
                var destino = myObj[i]['destino'];
                var escalas = myObj[i]['escalas'];
                var salida = myObj[i]['salida'];
                var date=new Date(salida);
                var idayvuelta = myObj[i]['idayvuelta'];
                var lugares = myObj[i]['lugares'];
                var precio = myObj[i]['precio'];
                var finalizado = myObj[i]['finalizado'];

                console.log(idViaje);
                // var btn = document.createElement("button");
                // btn.innerHTML="Ver elemento: "+idViaje;
                // btn.addEventListener("click",function(){
                // 	sessionStorage.setItem("idViaje",idViaje);
                // 	location.href="infoViaje.php";
                // });
                // document.getElementById("html").appendChild(btn);

                var div = document.createElement("div");
                div.className="d";
                var img = document.createElement("img");
                img.className="persona";
                img.src="../files/"+foto;
                var p = document.createElement("p");
                p.className="nameD";
                p.innerHTML=nombre+"<br>"+fechaNac+"<br>"+facultad;
                var hr=document.createElement("hr");
                hr.color="gray";
                hr.size="150";
                hr.className="linea";
                hr.width="1";
                var p2 = document.createElement("p");
                p2.className="nameI";
                p2.innerHTML=salida+"<br>"+origen+" - "+destino+"<br>"+precio+"$";
                var button = document.createElement("button");
                button.className="b2";
               button.innerHTML="ver";
                button.name=idViaje;
                button.addEventListener("click",function(){
                  
                  sessionStorage.setItem("idViaje",this.name);
                  location.href="reservar.php";
                });
             	div.appendChild(img);
              	div.appendChild(p);
              	div.appendChild(hr);
              	div.appendChild(p2);
              	div.appendChild(button);
				
              	document.getElementById("padre").appendChild(div);





			}
		}
		if (miXHR.readyState==4&& miXHR.status==404){
			console.log('El servidor no está disponible');
			console.log(miXHR.responseText);
		}
	}
}
function initAutocomplete(){
	var input3 = document.getElementById('o');
        var searchBox3 = new google.maps.places.SearchBox(input3);
        searchBox3.addListener('places_changed', function() {
          var places = searchBox3.getPlaces();

          if (places.length == 0) {
            return;
          }

          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }

    
          });

        });
        var input2 = document.getElementById('d');
        var searchBox2 = new google.maps.places.SearchBox(input2);
        searchBox2.addListener('places_changed', function() {
          var places = searchBox2.getPlaces();

          if (places.length == 0) {
            return;
          }

          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }

    
          });

        });
}
document.getElementById("flecha").addEventListener("click",function(){
	var o=document.getElementById('o');
	var d=document.getElementById('d');
	var temp=o.value;

	o.value=d.value;
	d.value=temp;

});