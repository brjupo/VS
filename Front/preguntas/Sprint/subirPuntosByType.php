<?php
//Informacion de la BBDD
$servername = "localhost";
$username = "u526597556_dev";
$password = "1BLeeAgwq1*isgm&jBJe";
$dbname = "u526597556_kaanbal";

$id_usuario = $_POST["id"];
$leccion = $_POST["leccion"];
$puntosNuevos = $_POST["puntos"];
$flagTipo = $_POST["flagTipo"];

//Lanzar consulta para saber si existe calificacion y la trae
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stringQuery = "SELECT puntuacion FROM puntuacion WHERE id_leccion = '" . $leccion . "' AND id_usuario = '" . $id_usuario . "' AND tipo = '" . $flagTipo . "' LIMIT 1;";
  $stmt = $conn->query($stringQuery);
  while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    //Leemos la calificacion 
    $puntosActuales = $row[0];
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;

$response["response"] = 'failed';
if (is_null($puntosActuales)) {
  //Crear la escritura en base de datos
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO puntuacion(id_usuario, id_leccion, puntuacion, tipo) VALUES ($id_usuario, $leccion, $puntosNuevos,'$flagTipo')";
    // use exec() because no results are returned
    $conn->exec($sql);
    $response["response"] = 'exito';
    //$response["response"] = $sql;
  } catch (PDOException $e) {
    $response["response"] = $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
} else if ($puntosNuevos > $puntosActuales) {
  //Lanzar consulta para actualizar calificacion solo si es mayor
  //Crear la escritura en base de datos
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE puntuacion SET puntuacion = $puntosNuevos WHERE id_leccion = $leccion AND id_usuario = $id_usuario AND tipo = '$flagTipo'";
    // use exec() because no results are returned
    $conn->exec($sql);
    $response["response"] = 'exito';
    //$response["response"] = $sql;
  } catch (PDOException $e) {
    $response["response"] = $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
} else if ($puntosNuevos <= $puntosActuales) {
  $response["response"] = 'exito';
}
echo json_encode($response);
