<?php 
function conexion(){
	$con = mysqli_connect('localhost','root','','uaqride');
	return $con;
}


function consulta($query){
	$con = conexion();
	mysqli_set_charset($con, 'utf8');
	$res = mysqli_query($con, $query);
	mysqli_close($con);
	return $res; 
}
?>