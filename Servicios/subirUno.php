<?php
$con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");


$studentID = $_POST["studentID"];
$password = $_POST["password"];

//Corroborar que no existe el correo en base de datos
$correo_e = $studentID . "@itesm.mx";

$sql = "SELECT mail FROM usuario_prueba WHERE mail = '$correo_e'";
$resultp = mysqli_query($con, $sql);
$rowp = mysqli_fetch_array($resultp);

$sql = "SELECT pswd FROM usuario_prueba WHERE mail = 'superUsuario'";
$resultadoSuper = mysqli_query($con, $sql);
$arraySuper = mysqli_fetch_array($resultp);
if ($arraySuper[0] != $password) {
    $response = array();
    $response['response'] = 'Error en la contraseña';
    echo json_encode($response);
} else {
    if ($rowp) {
        //Si ya existe, regresar que ya existe.
        $response = array();
        $response['response'] = 'Error! Este correo ya existe';
        echo json_encode($response);
    } else {
        //Agregar a la base de datos
        $sql = "INSERT INTO usuario_prueba(mail) VALUES ('$correo_e')";
        mysqli_query($con, $sql);

        //Si no existe, regresar true
        $response = array();
        $response['response'] = 'true';
        echo json_encode($response);
    }
}
