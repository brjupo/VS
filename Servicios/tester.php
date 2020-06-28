<?php
  $con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");
  //////////////////////////////////////////////////////
  session_start();
  $tokenValidar = array();
  $idValidarprofe = array();

  //Consultar si existe token de usuario
  $statement = mysqli_prepare($con, "SELECT tokenSesion, id_usuario FROM usuario_prueba WHERE mail = ?");
  mysqli_stmt_bind_param($statement, "s", $_SESSION["mail"]);
  mysqli_stmt_execute($statement);

  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $tokenSesionp, $iduser);

  while (mysqli_stmt_fetch($statement)) {
    $idValidarprofe["profe"] = $iduser;
    $tokenValidar["tokenSesionp"] = $tokenSesionp;
  }

  //Consultar si es profe
  $statement = mysqli_prepare($con, "SELECT id_profesor FROM profesor WHERE id_usuario = ?");
  mysqli_stmt_bind_param($statement, "s", $idValidarprofe["profe"]);
  mysqli_stmt_execute($statement);

  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $idProfe);

  while (mysqli_stmt_fetch($statement)) {
    $existeProfe["profe"] = $idProfe;
  }

  if ($_SESSION["tokenSesion"] == $tokenValidar["tokenSesionp"] and $existeProfe["profe"] != "" and $tokenValidar["tokenSesionp"] != "") {

    $idAsignatura = 1;


    $statement = mysqli_prepare($con, "SELECT id_tema, nombre FROM tema WHERE id_asignatura = ?");
    mysqli_stmt_execute($statement,"i", $idAsignatura);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $id_tema, $nombre);

    $arregloTemas = array();
    $i = 0;
    //Leemos datos del la leccion habilitadas
    while (mysqli_stmt_fetch($statement)) { //si si existe la leccion
      $arregloTemas[$i]["id_tema"] = $id_tema;
      $arregloTemas[$i]["nombre"] = $nombre;
      $i = $i + 1;
    }

    $tamanho = count($arregloAsignaturas);

    for ($i = 0; $i < $tamanho; $i++) {
      print_r($arregloTemas[$i]["id_tema"]);
      print_r($arregloTemas[$i]["nombre"]);
    }
  

}else{
  echo '<script type="text/javascript">
  alert("Inicie sesión");
  window.location.href="https://kaanbal.net";
  </script>';
}

?>