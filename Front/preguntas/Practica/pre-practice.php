<?php
require "../../../servicios/validarLicencia.php";
require "../../../servicios/00DDBBVariables.php";
require "../../CSSsJSs/mainCSSsJSs.php"
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="../../CSSsJSs/icons/pyramid.svg" />
    <title>Práctica</title>
    <link rel="stylesheet" href="../../CSSsJSs/<?php echo $bootstrap341; ?>" />
    <link rel="stylesheet" href="../../CSSsJSs/<?php echo $kaanbalEssentials; ?>" />
    <link rel="stylesheet" href="../../CSSsJSs/stylePreguntas.css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-F7VGWM5LKB"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-F7VGWM5LKB');
    </script>
</head>


<body>
    <!--script>
        document.addEventListener("contextmenu", (event) => event.preventDefault());
        $(document).keydown(function(event) {
            if (event.keyCode == 123) {
                // Prevent F12
                return false;
            } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
                // Prevent Ctrl+Shift+I
                return false;
            } else if (event.ctrlKey && event.keyCode == 85) {
                // Prevent Ctrl+U
                return false;
            } else if (event.ctrlKey && event.keyCode == 67) {
                // Prevent Ctrl+C
                return false;
            }
        });
    </script-->

    <?php
    $con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");
    //////////////////////////////////////////////////////
    session_start();

    /*---------------------------------------------------------------------------------------- */
    /*----------------------------- VALIDAR LICENCIA Y USUARIO ------------------------------- */
    /*---------------------------------------------------------------------------------------- */
    $tokenValidar = array();
    /* echo'<script type="text/javascript">
          alert("$_SESSION["mail"]");
          </script>'; */
    //Consultar si existe token de usuario
    $statement = mysqli_prepare($con, "SELECT tokenSesion FROM usuario_prueba WHERE mail = ?");
    mysqli_stmt_bind_param($statement, "s", $_SESSION["mail"]);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $tokenSesionp);
    while (mysqli_stmt_fetch($statement)) {
        $tokenValidar["tokenSesionp"] = $tokenSesionp;
    }
    /* echo'<script type="text/javascript">
          alert("'.$_SESSION["tokenSesion"]."____".$tokenValidar["tokenSesionp"] .'");
          </script>'; */

    if ($_SESSION["tokenSesion"] == $tokenValidar["tokenSesionp"] and $tokenValidar["tokenSesionp"] != "") {
        //Si existe un token de sesion activo se mostraran las preguntas 
        $leccion = $_GET['leccion'];
        $leccion = intval($leccion);
        $con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");
        /*----Paso 1 Obtener el ID del subtema----*/
        $idL = $leccion;
        //Validacion de licencia
        $flag = validarLicencia($idL);

        if ($flag == 0) {
            echo '<script type="text/javascript">
            alert("No cuenta con licencia para acceder a esta página");
            window.location.href="https://kaanbal.net";
            </script>';
        }
    } else {
        //Si NO existe un token de sesion activo se redireccionara a pagina de inicio
        echo '<script type="text/javascript">
          alert("Ingresa usuario y/o contraseña");
          window.location.href="https://kaanbal.net";
          </script>';
    }
    ?>

    <?php
    /*---------------------------------------------------------------------------------------- */
    /*--------------------------- GOOGLE ADS - ANUNCIO DE DISPLAY ---------------------------- */
    /*---------------------------------------------------------------------------------------- */
    ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h1>Anuncio</h1>
                <p>Google Adsense - Inicio</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <!-- Google AdSense -->
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9977500171937835" crossorigin="anonymous"></script>
                <!-- Pre_practica_1 -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-9977500171937835" data-ad-slot="7302320421" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p>Google Adsense - Final</p>
            </div>
        </div>
    </div>

    <?php
    /*---------------------------------------------------------------------------------------- */
    /*---------------------------------- BOTON DE CONTINUAR ---------------------------------- */
    /*---------------------------------------------------------------------------------------- */
    $practica = "practice.php?leccion=" . $leccion;
    ?>
    <div id="botonIrPractica" style="display: none; opacity:0.0;">
        <div class="container">
            <div class="row text-center">
                <div class="hidden-xs hidden-sm col-md-4 col-lg-4 col-xl-4"></div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <button class="botonContinuar" onclick="window.location.href='<?= $practica ?>'">
                        Continue
                    </button>
                </div>
                <div class="hidden-xs hidden-sm col-md-4 col-lg-4 col-xl-4"></div>
            </div>
        </div>
    </div>

    <script>
        function timeOutOpacity(i) {
            num = i / 10;
            setTimeout(function() {
                console.log("i: " + i + "opacidad: " + num);
                document.getElementById(elementId).style.opacity = num.toString();
            }, 500);
        }

        function subirOpacidadPorId(elementId) {
            console.log("block");
            document.getElementById(elementId).style.display = "block";
            for (i = 0; i < 11; i++) {
                timeOutOpacity(i);
            }
        }

        window.onload = function() {
            console.log("cargado");
            setTimeout(function() {
                console.log("Fin 5 s");
                subirOpacidadPorId("botonIrPractica");
            }, 5000);
        };
    </script>




</body>

</html>