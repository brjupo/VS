<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" type="image/x-icon" href="../CSSsJSs/icons/pyramid.svg" />
  <title>Asignaturas</title>
  <link rel="stylesheet" href="../CSSsJSs/bootstrap341.css" />
  <link rel="stylesheet" href="../CSSsJSs/styleAsignaturas.css" />
  <script src="../CSSsJSs/scriptAsignaturas.js"></script>
</head>

<body>
  <?php
  $con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");
  //////////////////////////////////////////////////////
  session_start();
  $tokenValidar = array();

  
  $arregloAsignaturastodas = array("Materia y el entorno", "Física", ".");
  //Consultar si existe token de usuario
  $statement = mysqli_prepare($con, "SELECT tokenSesion FROM usuario_prueba WHERE mail = ?");
  mysqli_stmt_bind_param($statement, "s", $_SESSION["mail"]);
  mysqli_stmt_execute($statement);

  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $tokenSesionp);

  while (mysqli_stmt_fetch($statement)) {
    $tokenValidar["tokenSesionp"] = $tokenSesionp;
  }

  if ($_SESSION["tokenSesion"] == $tokenValidar["tokenSesionp"] and $tokenValidar["tokenSesionp"] != "") {

    //Comprobar que tiene más de una licencia para no mostrar pantalla de materias
    //$query2 = "SELECT count(*) FROM pregunta WHERE id_leccion = $idL"; // WHERE TEMA = 'TEMA' AND SUBTEMA = 'SUBTEMA' AND LECCION = 'LECCION'";
    //$result2 = mysqli_query($con, $query2);
    //$total = mysqli_fetch_row($result2);


    $arregloAsignaturas = array();
    $arregloAsignaturas = traerAsignaturas();
    imprimirPagina($arregloAsignaturas, $arregloAsignaturastodas);
  } else {
    /* echo'<script type="text/javascript">
            alert("segundo caminio");
            </script>'; */

    $correo = $_POST["validarUsuario"];
    $password = $_POST["validarPassword"];

    //Validamos que los campos correo y password no lleguen vacios
    if ($correo == "" or $password == "") {
      echo '<script type="text/javascript">
            alert("Ingresa usuario y/o contraseña");
            window.location.href="https://kaanbal.net";
            </script>';
    } else {

      
    //Comprobar que tiene más de una licencia para no mostrar pantalla de materias

        $query = "SELECT id_usuario FROM usuario_prueba WHERE mail = '$correo'"; 
        $result = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          $iduser[] = $row;
      }
        echo '<script type="text/javascript">
            alert("'.$iduser[0]["id_usuario"].'");
            </script>';
       
            $iduser = $iduser[0]["id_usuario"];

        $query2 = "SELECT count(*) FROM licencia WHERE id_usuario = $iduser"; // WHERE TEMA = 'TEMA' AND SUBTEMA = 'SUBTEMA' AND LECCION = 'LECCION'";
        $result2 = mysqli_query($con, $query2);
        $total = mysqli_fetch_row($result2);

        echo '<script type="text/javascript">
            alert("'.$total[0].'");
            </script>';


      //Consultar si existe usuario en tabla alumnos
      $statement = mysqli_prepare($con, "SELECT * FROM usuario_prueba WHERE mail = ? AND pswd = ?");
      mysqli_stmt_bind_param($statement, "ss", $correo, $password);
      mysqli_stmt_execute($statement);

      mysqli_stmt_store_result($statement);
      mysqli_stmt_bind_result($statement, $id_usuario, $mail, $pswd, $tokenA, $tokenSesion, $idioma);



      //Leemos datos del usuario
      while (mysqli_stmt_fetch($statement)) { //si si existe el usuario
        $temp_id_usuario = $id_usuario;
        $temp_mail = $mail;
        $temp_pswd = $pswd;
        $temp_tokenA = $tokenA;
        $temp_tokenSesion = $tokenSesion;
        $temp_idioma = $idioma;
        //$response["token"] = $token;
        //$response["token_a"] = $token_a;
        //$response["tokenp"] = $tokenp;
        //$response["tokenpp"] = $tokenpp;
        //$response["flag"] = $flag;
      }

      //Si el usuario EXISTE despliega el menú de las asignaturas
      if ($temp_id_usuario) {
        //Creamos token de sesión
        $rand = bin2hex(random_bytes(5));
        //Registrar token de sesion en BD
        $sql = "UPDATE usuario_prueba SET tokenSesion='$rand' WHERE mail = '$correo'";
        mysqli_query($con, $sql);
        //Aactualizamos variables de sesión
        $_SESSION["id_usuario"] = $temp_id_usuario;
        $_SESSION["mail"] = $temp_mail;
        $_SESSION["pswd"] = $temp_pswd;
        $_SESSION["tokenA"] = $temp_tokenA;
        $_SESSION["tokenSesion"] = $rand;
        $_SESSION["idioma"] = $temp_idioma;
        //Imprimimos pantalla de asignaturas
        $arregloAsignaturas = array();
        $arregloAsignaturas = traerAsignaturas();
        //todas las asignaturas
        imprimirPagina($arregloAsignaturas, $arregloAsignaturastodas);
      }

      //Si el usuario NO EXISTE mensaje de error y retorna a inicio
      else {
        echo '<script type="text/javascript">
            alert("Usuario y/o contraseña incorrectos");
            window.location.href="https://kaanbal.net";
            </script>';
      }
    }
  }

  //traer licencias disponibles
  function traerAsignaturas()
  {
    /*+++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    $asignatura = $_GET['asignatura'];
    /*echo '<script type="text/javascript">
            alert("'.$asignatura.'");
            </script>';
    */
    /*+++++++++++++++++++++++++++++++++++++++++++++++++++++++PROBADO*/
    $con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");
    /*----Paso 1 Obtener las asignaturas a las que se tienen permiso ----*/
    $statement = mysqli_prepare($con, "SELECT * FROM asignatura WHERE id_asignatura IN (SELECT id_asignatura FROM licencia WHERE id_usuario = ? AND vigencia > NOW())");
    mysqli_stmt_bind_param($statement, "s", $_SESSION["id_usuario"]);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $id_asignatura, $nombre, $nivel, $grado_academico, $idioma);

    $arregloAsignaturas = array();

    $i = 0;
    while (mysqli_stmt_fetch($statement)) {
      $arregloAsignaturas[$i]["id_asignatura"] = $id_asignatura;
      $arregloAsignaturas[$i]["nombre"] = $nombre;
      $arregloAsignaturas[$i]["nivel"] = $nivel;
      $arregloAsignaturas[$i]["grado_academico"] = $grado_academico;
      $arregloAsignaturas[$i]["idioma"] = $idioma;
      $i = $i + 1;
    }
    /*+++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    //DETECTAR DONDE DA CLIC A LA ASIGNATURA PARA GUARDAR LA VARIABLE DE SESION DEL ID DE LA ASIGNATURA

    return ($arregloAsignaturas);
  }


  //////////////////////
  function imprimirPagina($arregloAsignaturas, $arregloAsignaturastodas)
  {
    imprimirTitulo();
    imprimirAsignaturas($arregloAsignaturas, $arregloAsignaturastodas);
    imprimirRelleno();
    imprimirFooter();
  }




  function imprimirTitulo()
  {
    echo '
          <!----------------------------------------------TITULO--------------------------------------------->
          <div class="top">
            <div class="container">
              <div class="row">
                <div class="textCenter col-xs-2 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                  <img
                    class="iconoPrincipal"
                    src="../CSSsJSs/icons/quetzalcoatl.svg"
                  />
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                  <p class="titulo">Kaanbal</p>
                </div>
              </div>
            </div>
          </div>
          <!------------------------------------------------FIN TITULO----------------------------------------------->

          <!------------------------------------------------RELLENO----------------------------------------------->
          <div class="container">
            <div class="row">
              <p class="relleno">.</p>
            </div>
            <div class="row">
              <p class="relleno">.</p>
            </div>
            <div class="row">
              <p class="relleno">.</p>
            </div>
          </div>
          <!------------------------------------------------FIN RELLENO----------------------------------------------->
    ';
  }

  function imprimirAsignaturas($arregloAsignaturas, $arregloAsignaturastodas)
  {
    $tamanho = count($arregloAsignaturastodas);
    $esImpar = $tamanho % 2;
    $numeroDePares = intval($tamanho / 2);
    /*echo '<script type="text/javascript">
            alert("' . $tamanho . '");
            </script>';
    */
    for ($i = 0; $i < $numeroDePares; $i++) {
      if (in_array($arregloAsignaturas[2 * $i]["nombre"], $arregloAsignaturastodas)) {
        $permiso1 = 1;
      } else {
        $permiso1 = 0;
      }
      if (in_array($arregloAsignaturas[2 * $i + 1]["nombre"], $arregloAsignaturastodas)) {
        $permiso2 = 1;
      } else {
        $permiso2 = 0;
      }
      imprimirAsignaturaPar($arregloAsignaturastodas[2 * $i], $arregloAsignaturastodas[2 * $i + 1], $permiso1, $permiso2);
    }
    //si es del 0 a 4, te regresa 5
    if ($esImpar) {
      if (in_array($arregloAsignaturas[$tamanho - 1]["nombre"], $arregloAsignaturastodas)) {
        imprimirAsignaturaImpar($arregloAsignaturastodas[$tamanho - 1], 1);
      } else {
        imprimirAsignaturaImpar($arregloAsignaturastodas[$tamanho - 1], 0);
      }
    }
  }

  function imprimirAsignaturaPar($nombreAsignatura1, $nombreAsignatura2, $siTienePermiso1, $siTienePermiso2)
  {
    $link = "temas.php?asignatura=";
    if ($siTienePermiso1 == 1) {
      $claseBloque1 = "asignaturaPrincipal";
      $link1=$link.$nombreAsignatura1;
      $imagen1="imagenAsignatura";
    } else {
      $claseBloque1 = "asignaturaDesactivada";
      $link1="";
      $imagen1="imagenDesactivada";
    }
    if ($siTienePermiso2 == 1) {
      $claseBloque2 = "asignaturaPrincipal";
      $link2=$link.$nombreAsignatura2;
      $imagen2="imagenAsignatura";
    } else {
      $claseBloque2 = "asignaturaDesactivada";
      $link2="";
      $imagen2="imagenDesactivada";
    }
    echo '
        <div class="container">
          <div class="row">
            <div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1"></div>   
              <a href="' . $link1 . '">     
                <div
                  class="' . $claseBloque1 . ' col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"
                >
                  <div>
                    <img class="'.$imagen1.'" src="../CSSsJSs/icons/star.svg" />
                  </div>
                  <div class="tituloAsignaturas">
                    ' . $nombreAsignatura1 . '
                  </div>
                </div>
              </a>
              <div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1"></div>
              <div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1"></div>   
              <a href="' . $link2 . '">    
                <div
                  class="' . $claseBloque2 . ' col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"
                >
                  <div>
                    <img class="'.$imagen2.'" src="../CSSsJSs/icons/physics.svg" />
                  </div>
                  <div class="tituloAsignaturas">
                  ' . $nombreAsignatura2 . '
                  </div>
                </div>
              </a>
              <div class="hidden-xs hidden-sm col-md-1 col-lg-1 col-xl-1"></div>
            </div>
          </div>

          <!------------------------------------------------RELLENO----------------------------------------------->
          <div class="container">
            <div class="row">
              <p class="relleno">.</p>
            </div>
            <div class="row">
              <p class="relleno">.</p>
            </div>
          </div>
          <!------------------------------------------------FIN RELLENO----------------------------------------------->
    ';
  }

  function imprimirAsignaturaImpar($nombreAsignatura, $siTienePermiso)
  {
    $link = "temas.php?asignatura=";
    if ($siTienePermiso == 1) {
      $claseBloque = "asignaturaPrincipal";
      $link.=$nombreAsignatura;
      $imagen="imagenAsignatura";
    } else {
      $claseBloque = "asignaturaDesactivada";
      $link="";
      $imagen="imagenDesactivada";
    }
    echo '
        <div class="container">
          <div class="row">
            <div class="hidden-xs hidden-sm col-md-4 col-lg-4 col-xl-4"></div>  
              <a href="' . $link . '">      
                <div
                  class="' . $claseBloque . ' col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"
                >
                  <div>
                    <img class="'.$imagen.'" src="../CSSsJSs/icons/star.svg" />
                  </div>
                  <div class="tituloAsignaturas">'
                  . $nombreAsignatura .
                  '</div>
                </div>              
              </a>
              <div class="hidden-xs hidden-sm col-md-4 col-lg-4 col-xl-4"></div>  
            </div>
          </div>

          <!------------------------------------------------RELLENO----------------------------------------------->
          <div class="container">
            <div class="row">
              <p class="relleno">.</p>
            </div>
            <div class="row">
              <p class="relleno">.</p>
            </div>
          </div>
          <!------------------------------------------------FIN RELLENO----------------------------------------------->
    ';
  }

  function imprimirRelleno()
  {
    echo '
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>
          <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 col-xl-11"></div>
          <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10"></div>
          <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xl-9"></div>
          <div class="col-xs-8 col-sm-9 col-md-8 col-lg-8 col-xl-8"></div>
          <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 col-xl-7"></div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"></div>
          <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5"></div>
          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4"></div>
          <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"></div>
          <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"></div>
          <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
        </div>
      </div>
      <div class="container ">
        <div class="row">
          <p class="relleno">.</p>
        </div>
        <div class="row">
          <p class="relleno">.</p>
        </div>
        <div class="row">
          <p class="relleno">.</p>
        </div>
        <div class="row">
          <p class="relleno">.</p>
        </div>
      </div>
    ';
  }

  function imprimirFooter()
  {
    echo '
          <div class="foot">
            <div class="container">
              <div class="row text-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <img
                    class="footIcon"
                    id="botonLogout"
                    src="../CSSsJSs/icons/logout.svg"
                  />
                </div>
              </div>
            </div>
          </div>
    ';
  }

  ?>

</body>

</html>