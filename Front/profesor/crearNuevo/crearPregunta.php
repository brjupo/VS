<?php
require "../../../Servicios/DDBBVariables.php";
require "../../../Servicios/isAdmin.php";
$teacherID = isAdmin();
if ($teacherID == "null") {
    header('Location: https://kaanbal.net/');
    exit;
}
?>

<!DOCTYPE html>
<html>

<?php
printEditTopic();
function printEditTopic()
{
  printHead();
  echo '<body>';
  printTitle();
  printInstructions();
  printTopics();
  printNewTopic();
  printButtons();
  echo '</body>';
}

function printTopics()
{
  $idLeccion = $_GET['ID_Leccion'];
  $con = mysqli_connect("localhost", "u526597556_dev", "1BLeeAgwq1*isgm&jBJe", "u526597556_kaanbal");
  $statement = mysqli_prepare($con, "SELECT id_pregunta, pregunta FROM pregunta WHERE id_leccion = ? ORDER BY orden");
  mysqli_stmt_bind_param($statement, "i", $idLeccion);
  mysqli_stmt_execute($statement);

  mysqli_stmt_store_result($statement);
  mysqli_stmt_bind_result($statement, $id_pregunta, $pregunta);

  $arregloTemas = array();
  $i = 0;
  //Leemos datos del la leccion habilitadas
  while (mysqli_stmt_fetch($statement)) { //si si existe la leccion
    $arregloTemas[$i]["id_pregunta"] = $id_pregunta;
    $arregloTemas[$i]["pregunta"] = $pregunta;
    $i = $i + 1;
  }

  $tamanho = count($arregloTemas);

  for ($i = 0; $i < $tamanho; $i++) {
    //print_r($arregloTemas[$i]["id_tema"]);
    //print_r($arregloTemas[$i]["nombre"]);
    printTopic($arregloTemas[$i]["id_pregunta"], $arregloTemas[$i]["pregunta"]);
  }
}

function printTopic($ID_Question, $questionName)
{
  echo '
    <div class="container">
      <div class="row">
        <div class="input-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="input-group-prepend">
            <span class="input-group-text">' . $ID_Question . '</span>
          </div>
          <input type="text" class="form-control" id="' . $ID_Question . '" value="' . $questionName . '" />
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <p style="color: rgba(0, 0, 0, 0);">.</p>
        </div>
      </div>
    </div>

  ';
}

function printNewTopic()
{
  echo '
  <div class="container" style="border-top: 4px dotted #007bff;">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <p style="color: rgba(0, 0, 0, 0);">.</p>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="input-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <input
          id="nuevaPregunta"
          type="text"
          class="form-control"
          placeholder="Escribe AQUI la nueva pregunta"
        />
        <div class="input-group-append">
          <span class="input-group-text">ID Lección = </span>
          <span class="input-group-text" id="id_leccion">' . $_GET['ID_Leccion'] . '</span>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <p style="color: rgba(0, 0, 0, 0);">.</p>
      </div>
    </div>
  </div>
  ';
}

function printHead()
{
  echo '
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="../CSSsJSs/icons/pyramid.svg"
    />
    <title>Kaanbal</title>
    <link rel="stylesheet" href="../CSSsJSs/bootstrap441.css" />
    <link rel="stylesheet" href="../CSSsJSs/kaanbalEsentials.css" />
    <script src="../CSSsJSs/minAJAX.js"></script>
    <script src="../CSSsJSs/crearPregunta.js"></script>
  </head>
  ';
}
function printTitle()
{
  echo '
  <div class="container">
    <div class="row">
      <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
      <div class="col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
        <h1 class="titulo">Kaanbal</h1>
      </div>
      <div class="col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5"></div>
      <div class="col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"></div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <p style="color: rgba(0, 0, 0, 0);">.</p>
      </div>
    </div>
  </div>
  ';
}

function printInstructions()
{
  echo '
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <p>
          - Para crear una nueva <strong>pregunta</strong>, inserte la pregunta en la última sección 
          y de clic en "Guardar en base de datos"
        </p>
        <p>
          - Recuerde, aquí solo se crea la pregunta en español, para crear las respuestas, el tipo de 
          pregunta y su traducción, utilice la sección "Editar preguntas por ID", ubicada en el panel 
          de profesores
        </p>
        <p>
          - Por el momento, falta la carga de imagen. Nombre de la imagen == al ID mostrado en esta 
          pantalla 
        </p>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <p style="color: rgba(0, 0, 0, 0);">.</p>
      </div>
    </div>
  </div>
  ';
}

function printButtons()
{
  echo '
  <div class="container">
    <div class="row">
      <div
        class="input-group input-group-sm col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6"
      >
        <button
          id="guardarEnBBDD"
          type="button"
          class="btn btn-primary btn-sm"
        >
          Guardar en base de datos
        </button>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <p style="color: rgba(0, 0, 0, 0);">.</p>
      </div>
    </div>
  </div>
  ';
}

?>

</html>