<?php
    $con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");

    $id_usuario = $_POST["id"];
    $leccion = $_POST["leccion"];
    $puntosNuevos = $_POST["puntos"];
    
    //Lanzar consulta para saber si existe calificacion y la trae
    $statement = mysqli_prepare($con, "SELECT puntuacion FROM puntuacion WHERE id_leccion = ? AND id_usuario = ?");
      mysqli_stmt_bind_param($statement, "ss", $leccion, $id_usuario);
      mysqli_stmt_execute($statement);
      mysqli_stmt_store_result($statement);
      mysqli_stmt_bind_result($statement, $puntuacion);

      //Leemos la calificacion 
      while (mysqli_stmt_fetch($statement)) { //si si existe el usuario
        $puntosActuales = $puntuacion ;
      }
    
    if($puntosNuevos >= $puntosActuales){
    //Lanzar consulta para actualizar calificacion solo si es mayor
    $sql = "UPDATE puntuacion SET puntuacion = $puntosNuevos WHERE id_leccion = $leccion AND id_usuario = $id_usuario";
    mysqli_query($con,$sql);
    }
    //Lanzar consulta para insertar primera calificacion
    
            
    //SELECT puntuacion FROM puntuacion WHERE id_leccion = 1 AND id_licencia = (SELECT id_licencia FROM licencia WHERE id_usuario = 4 and vigencia > NOW());

    //UPDATE puntuacion SET puntuacion = 78768 WHERE id_puntuacion = (SELECT id_puntuacion FROM puntuacion WHERE id_leccion = 1 AND id_licencia = (SELECT id_licencia FROM licencia WHERE id_usuario = 4 and vigencia > NOW()));
   
    /* $sql = "SELECT mail FROM usuario_prueba WHERE mail = '$correo'";
    $resultp = mysqli_query($con,$sql);
    $rowp = mysqli_fetch_array($resultp);
    
    if($rowp){
        

        //Si existe registrar contraseña en base de datos y responder true
        $sql = "UPDATE usuario_prueba SET pswd='$password' WHERE mail = '$correo'";
        mysqli_query($con,$sql); */

        $response["response"] = 'exito';
            
            echo json_encode($response); 

?>