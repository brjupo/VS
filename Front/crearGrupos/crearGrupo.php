<?php
//Necesario para los estilos nuevos desde Octubre 2020
require "../CSSsJSs/mainCSSsJSs.php";
require "../../servicios/00DDBBVariables.php";
require "../../servicios/isTeacher.php";
$teacherID = isTeacher();
if ($teacherID == "null") {
    header('Location: https://kaanbal.net/');
    exit;
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="../CSSsJSs/icons/pyramid.svg" />
    <title>Kaanbal</title>
    <link rel="stylesheet" href="../CSSsJSs/<?= $bootstrap441 ?>" />
    <link rel="stylesheet" href="../CSSsJSs/<?= $kaanbalEssentials ?>" />
    <script src="../<?= $minAJAX ?>"></script>
    <script src="CSSsJSs/crearGrupo.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <h1 class="titulo">Kaanbal</h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p style="color: rgba(0, 0, 0, 0)">.</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p>Para crear un nuevo <strong>grupo</strong>:</p>
                <p>- Elija la materia</p>
                <p>- Escriba el nombre que deseé darle a su grupo</p>
                <p>
                    > De clic en "crear grupo". Su grupo se creará y se añadirá a la
                    lista inferior.
                </p>
                <p>
                    - Comparta el código del grupo a sus alumnos para que puedan unirse.
                </p>
                <p style="font-size: small">
                    Cualquier duda estamos para ayudarte
                    <a href="https://kaanbal.net/contacto.html">contáctanos</a>
                </p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p style="color: rgba(0, 0, 0, 0)">.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="input-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="input-group-prepend">
                    <div class="input-group-text">Elija la materia:</div>
                </div>
                <select class="custom-select" id="idMateria">
                    <option value="0" selected disabled>Elige...</option>
                    <?php
                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stringQuery = "SELECT id_asignatura, nombre FROM asignatura;";
                        $stmt = $conn->query($stringQuery);
                        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                            echo '
                                <option value="' . $row[0] . '">' . $row[1] . '</option>
                            ';
                        }
                    } catch (PDOException $e) {
                        echo "failed: " . $stringQuery . $e->getMessage();
                    }
                    $conn = null;
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p style="color: rgba(0, 0, 0, 0)">.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="input-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="input-group-prepend">
                    <div class="input-group-text">Nombre del grupo:</div>
                </div>
                <input id="nombreGrupo" type="text" class="form-control" placeholder="Escribe AQUI el nombre del grupo" />
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p style="color: rgba(0, 0, 0, 0)">.</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="input-group input-group-sm col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <button id="crearNuevoGrupo" type="button" class="btn btn-primary btn-sm">
                    Crear nuevo grupo
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p style="color: rgba(0, 0, 0, 0)">.</p>
            </div>
        </div>
    </div>
    <div class="container" style="border-top: 4px dotted #007bff">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p style="color: rgba(0, 0, 0, 0)">.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="input-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <?php
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stringQuery = "SELECT id_grupo, id_asignatura, nombre, codigo FROM grupo WHERE id_profesor = 1;";
                    $stmt = $conn->query($stringQuery);
                    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo '
                                <div class="input-group-prepend">
                                    <span class="input-group-text">ID: ' . $row[0] . '</span>
                                    <span class="input-group-text">Materia: ' . $row[1] . '</span>
                                </div>
                                <input type="text" class="form-control" value="' . $row[2] . '" />
                                <div class="input-group-append">
                                    <span class="input-group-text">Código: ' . $row[3] . '</span>
                                </div>
                                ';
                    }
                } catch (PDOException $e) {
                    echo "failed: " . $stringQuery . $e->getMessage();
                }
                $conn = null;
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p style="color: rgba(0, 0, 0, 0)">.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p style="color: rgba(0, 0, 0, 0)">.</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p style="color: rgba(0, 0, 0, 0)">.</p>
            </div>
        </div>
    </div>
</body>

</html>

<!--
<?php
function printTopic($ID_Topic, $topicName)
{
    echo '
    <div class="container">
      <div class="row">
        <div class="input-group col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="input-group-prepend">
            <span class="input-group-text">' . $ID_Topic . '</span>
          </div>
          <input type="text" class="form-control" id="' . $ID_Topic . '" value="' . $topicName . '" />
          <div class="input-group-append">
            <a href="crearSubtema.php?ID_Tema=' . $ID_Topic . '">
              <button class="btn btn-outline-secondary" type="button">
                Buscar sus subtemas
              </button>
            </a>
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
?>

-->