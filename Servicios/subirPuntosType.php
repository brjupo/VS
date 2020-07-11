<?php
$con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");

$id_usuario = $_POST["id"];
$leccion = $_POST["leccion"];
$puntosNuevos = $_POST["puntos"];
$flagTipo = $_POST["flagTipo"];

//Lanzar consulta para saber si existe calificacion y la trae
$statement = mysqli_prepare($con, "SELECT puntuacion FROM puntuacion WHERE id_leccion = ? AND id_usuario = ? AND tipo = ?");
mysqli_stmt_bind_param($statement, "sss", $leccion, $id_usuario, $flagTipo);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $puntuacion);

$puntosActuales = 'xxx';

$response["response"] = 'failed';
//Leemos la calificacion 
while (mysqli_stmt_fetch($statement)) { //si si existe 
  $puntosActuales = $puntuacion;
}

print_r($puntosActuales);

if ($puntosActuales != 'xxx' OR $puntosActuales == 0) { //validamos que exista una calificacion $puntosActuales != NULL or $puntosActuales == 0
  if ($puntosNuevos >= $puntosActuales) {
    //Lanzar consulta para actualizar calificacion solo si es mayor
    $sql = "UPDATE puntuacion SET puntuacion = $puntosNuevos WHERE id_leccion = $leccion AND id_usuario = $id_usuario AND tipo = '$flagTipo'";
    mysqli_query($con, $sql);
    $response["response"] = 'exito1u';
  }
} else {
  $sql = "INSERT INTO puntuacion(id_usuario, id_leccion, puntuacion, tipo) VALUES ('$id_usuario', '$leccion', '$puntosNuevos','$flagTipo')";
  mysqli_query($con, $sql);
  $response["response"] = 'exito2';
}

echo json_encode($response);

?>