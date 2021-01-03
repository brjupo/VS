<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" type="image/x-icon" href="../CSSsJSs/icons/pyramid.svg" />
  <title>Top</title>
  <link rel="stylesheet" href="../CSSsJSs/bootstrap441.css" />
  <link rel="stylesheet" href="Top.css" />
  <script src="Top03.js"></script>
</head>

<body>
  <?php
  session_start();
  $idMateria = $_SESSION["idAsignatura"];
  $idUsuario = $_SESSION["id_usuario"];
  ?>
  <div class="top">
    <div class="container">
      <div class="row">
        <div class="textCenter col-2 col-sm-2 col-md-2 col-lg-1 col-xl-1">
          <img class="iconoPrincipal" src="../CSSsJSs/icons/physics.svg" />
        </div>
        <div class="textCenter col-10 col-sm-10 col-md-10 col-lg-11 col-xl-11">
          <p class="Ciencia fuenteTitulo" id="asignaturad"><?= $_SESSION["asignaturaNavegacion"] ?></p>
          <p class="Ciencia fuenteTitulo" id="asignatura" style="display:none"><?= $_SESSION["idAsignatura"] ?></p>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row" style="margin:3vw;">
      <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <button type="button" class="btn btn-light" id="topGrupalButton" style="display:block; margin:auto;">Top grupal</button>
      </div>
      <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <button type="button" class="btn btn-primary" id="topSemestralButton" style="display:block; margin:auto;">Top semestral</button>
      </div>
      <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <button type="button" class="btn btn-primary" id="topNacionalButton" style="display:block; margin:auto;">Top nacional</button>
      </div>
    </div>
  </div>

  <div id="topGrupal">
    <?php
    imprimirVistaTopGrupal($idMateria, $idUsuario);
    ?>
  </div>
  <div id="topSemestral" style="display:none;">
    <?php
    imprimirVistaTopSemestral($idMateria);
    ?>
  </div>
  <div id="topNacional" style="display:none;">
    <?php
    imprimirVistaTopNacional($idMateria);
    ?>
  </div>




  <div class="foot">
    <div class="container">
      <div class="row text-center">
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
          <img class="footIcon" id="botonLecciones" src="../CSSsJSs/icons/business.svg" />
        </div>
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 ">
          <img class="footIcon" id="botonPerfil" src="../CSSsJSs/icons/identification.svg" />
        </div>
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
          <img class="footIcon" id="botonTop" src="../CSSsJSs/icons/top.svg" />
        </div>
        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
          <img class="footIcon" id="botonLogout" src="../CSSsJSs/icons/logout.svg" />
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
      <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11"></div>
      <div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10"></div>
      <div class="col-9 col-sm-9 col-md-9 col-lg-9 col-xl-9"></div>
      <div class="col-8 col-sm-9 col-md-8 col-lg-8 col-xl-8"></div>
      <div class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-7"></div>
      <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"></div>
      <div class="col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5"></div>
      <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
      <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
      <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
      <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
    </div>
  </div>
</body>

</html>

<?php
function imprimirVistaTopGrupal($idMateria, $idUsuario)
{
  $posicion = 0;
  $avatar = 0;
  $diamantes = 0;
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
  //++++++++++++++++++OBTENER TOP 5 DEL GRUPO +++++++++++++++++//
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
  $con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");

  //Obtener el top 5 de alumnos con mayor puntuación
  $strqry = "SELECT a.id_alumno, a.id_usuario, a.matricula, a.avatar, suma FROM alumno a INNER JOIN( SELECT id_usuario, SUM(puntuacion) AS suma FROM puntuacion WHERE id_leccion IN( SELECT id_leccion FROM leccion WHERE id_subtema IN( SELECT id_subtema FROM subtema WHERE id_tema IN( SELECT id_tema FROM tema ) ) ) GROUP BY id_usuario ) p ON a.id_usuario = p.id_usuario WHERE a.id_usuario IN( SELECT id_usuario FROM licencia WHERE estatus = 1 AND id_asignatura = ". $idMateria . " ) AND p.id_usuario NOT IN( SELECT id_usuario FROM profesor ) AND a.id_alumno IN( SELECT id_alumno FROM alumno_grupo WHERE id_grupo IN( SELECT id_grupo FROM alumno_grupo WHERE id_alumno IN( SELECT id_alumno FROM alumno WHERE id_usuario = ". $idUsuario . " ) ) ) ORDER BY suma DESC LIMIT 5";
  echo '<p>.</p>';
  echo '<p>' . $idMateria . '</p>';
  echo '<p>.</p>';
  echo '<p>' . $idUsuario . '</p>';
  echo '<p>.</p>';
  echo '<p>QUERY: ' . $strqry . ' </p>';
  $statement = mysqli_prepare($con, $strqry);
  //[ID DE LA ASIGNATURA ACTUAL]
  //mysqli_stmt_bind_param($statement, "i", $idMateria, $idUsuario);
  mysqli_stmt_execute($statement);
  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $id_alumno, $id_usuario, $matricula, $avatar, $suma);

  $arregloTopUsuarios = array();

  $i = 0;
  while (mysqli_stmt_fetch($statement)) {
    $arregloTopUsuarios[$i]["id_alumno"] = $id_alumno;
    $arregloTopUsuarios[$i]["id_usuario"] = $id_usuario;
    $arregloTopUsuarios[$i]["matricula"] = $matricula;
    $arregloTopUsuarios[$i]["avatar"] = $avatar;
    $arregloTopUsuarios[$i]["suma"] = $suma;
    $i = $i + 1;
  }
  for ($i = 0; $i < 5; $i++) {
    $posicion = $i + 1;
    $diamantes = $arregloTopUsuarios[$i]["suma"];
    $matricula = $arregloTopUsuarios[$i]["matricula"];
    if ($arregloTopUsuarios[$i]["avatar"] == NULL) {
      $avatar = "avatar.jpg";
    } else {
      $avatar = $arregloTopUsuarios[$i]["avatar"];
    }
    imprimirPersonaTop($posicion, $avatar, $matricula, $diamantes);
  }
}
function imprimirVistaTopSemestral($idMateria)
{
  $posicion = 0;
  $avatar = 0;
  $diamantes = 0;
  //////////////////////////////////////////////CRISTIAN/////////////////////////////////////////////////////////////
  $con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");

  //Obtener el top 30 de alumnos con mayor puntuación
  $strqry = 'SELECT a.id_alumno, a.id_usuario, a.matricula, a.avatar, suma FROM alumno a 
  INNER JOIN (SELECT id_usuario, SUM(puntuacion) AS suma FROM puntuacion 
  WHERE tiempo BETWEEN "2021-01-01" AND "2021-05-31" AND id_leccion 
  IN (SELECT id_leccion FROM leccion WHERE id_subtema 
  IN (SELECT id_subtema FROM subtema WHERE id_tema 
  IN (SELECT id_tema FROM tema))) GROUP BY id_usuario) p 
  ON a.id_usuario = p.id_usuario WHERE a.id_usuario 
  IN (SELECT id_usuario FROM licencia 
  WHERE estatus = 1 AND vigencia BETWEEN "2021-01-01" AND "2021-05-31" AND id_asignatura = ?) 
  AND p.id_usuario NOT IN (SELECT id_usuario FROM profesor) ORDER BY suma DESC LIMIT 30;';
  $statement = mysqli_prepare($con, $strqry);
  //[ID DE LA ASIGNATURA ACTUAL]
  mysqli_stmt_bind_param($statement, "i", $idMateria);
  mysqli_stmt_execute($statement);
  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $id_alumno, $id_usuario, $matricula, $avatar, $suma);

  $arregloTopUsuarios = array();

  $i = 0;
  while (mysqli_stmt_fetch($statement)) {
    $arregloTopUsuarios[$i]["id_alumno"] = $id_alumno;
    $arregloTopUsuarios[$i]["id_usuario"] = $id_usuario;
    $arregloTopUsuarios[$i]["matricula"] = $matricula;
    $arregloTopUsuarios[$i]["avatar"] = $avatar;
    $arregloTopUsuarios[$i]["suma"] = $suma;
    $i = $i + 1;
  }
  for ($i = 0; $i < 30; $i++) {
    $posicion = $i + 1;
    $diamantes = $arregloTopUsuarios[$i]["suma"];
    $matricula = $arregloTopUsuarios[$i]["matricula"];
    if ($arregloTopUsuarios[$i]["avatar"] == NULL) {
      $avatar = "avatar.jpg";
    } else {
      $avatar = $arregloTopUsuarios[$i]["avatar"];
    }
    imprimirPersonaTop($posicion, $avatar, $matricula, $diamantes);
  }
}
function imprimirVistaTopNacional($idMateria)
{
  $posicion = 0;
  $avatar = 0;
  $diamantes = 0;
  //////////////////////////////////////////////CRISTIAN/////////////////////////////////////////////////////////////
  $con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");

  //Obtener el top 5 de alumnos con mayor puntuación

  $strqry = "SELECT a.id_alumno, a.id_usuario, a.matricula, a.avatar, suma 
    FROM alumno a INNER JOIN (SELECT id_usuario, SUM(puntuacion) AS suma FROM puntuacion 
    WHERE id_leccion IN (SELECT id_leccion FROM leccion 
    WHERE id_subtema IN (SELECT id_subtema FROM subtema 
    WHERE id_tema IN (SELECT id_tema FROM tema))) GROUP BY id_usuario) p 
    ON a.id_usuario = p.id_usuario 
    WHERE a.id_usuario IN (SELECT id_usuario FROM licencia WHERE estatus = 1 AND id_asignatura = ?) AND p.id_usuario NOT IN (SELECT id_usuario FROM profesor) 
    ORDER BY suma DESC LIMIT 30";
  $statement = mysqli_prepare($con, $strqry);
  //[ID DE LA ASIGNATURA ACTUAL]
  mysqli_stmt_bind_param($statement, "i", $idMateria);
  mysqli_stmt_execute($statement);
  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $id_alumno, $id_usuario, $matricula, $avatar, $suma);

  $arregloTopUsuarios = array();

  $i = 0;
  while (mysqli_stmt_fetch($statement)) {
    $arregloTopUsuarios[$i]["id_alumno"] = $id_alumno;
    $arregloTopUsuarios[$i]["id_usuario"] = $id_usuario;
    $arregloTopUsuarios[$i]["matricula"] = $matricula;
    $arregloTopUsuarios[$i]["avatar"] = $avatar;
    $arregloTopUsuarios[$i]["suma"] = $suma;
    $i = $i + 1;
  }
  for ($i = 0; $i < 30; $i++) {
    $posicion = $i + 1;
    $diamantes = $arregloTopUsuarios[$i]["suma"];
    $matricula = $arregloTopUsuarios[$i]["matricula"];
    if ($arregloTopUsuarios[$i]["avatar"] == NULL) {
      $avatar = "avatar.jpg";
    } else {
      $avatar = $arregloTopUsuarios[$i]["avatar"];
    }
    imprimirPersonaTop($posicion, $avatar, $matricula, $diamantes);
  }
}
?>

<?php

function imprimirPersonaTop($posicion, $avatar, $ultimosDigitosMatricula, $diamantes)
{
  echo '
                <div class="container">
                    <div class="row">
                        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                            <p class="topNumber">' . $posicion . '</p>
                        </div>
                        <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                            <img src="../CSSsJSs/images/' . $avatar . '" class="avatarTop">
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <p class="ID3st">' . $ultimosDigitosMatricula . '</p>
                        </div>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                            <p class="IDiamonds">' . $diamantes . '</p>
                        </div>
                        <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                            <img src="../CSSsJSs/icons/diamante.svg" class="diamantesTop">
                        </div>
                        <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">
                        </div>
                    </div>
                </div>
                ';
}


function imprimirRelleno()
{
  echo '
            <div class="container">
              <div class="row">
                <p class="relleno">.</p>
              </div>
              <div class="row">
                <p class="relleno">.</p>
              </div>
            </div>
      ';
}

?>