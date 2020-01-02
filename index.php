<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <!--Important links-->
    <!--link rel="stylesheet" href="CSSsJSs/bootstrap341.css" /-->

    <!--Temporal ONLINE fonts and styles-->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="icons/EducAppIcon.png"
    />

    <link rel="stylesheet" href="CSSsJSs/bootstrap441.css" />
    <link rel="stylesheet" href="CSSsJSs/jQuerySLIM341.js" />
    <link rel="stylesheet" href="CSSsJSs/popper1160.js" />
    <link rel="stylesheet" href="CSSsJSs/bootstrapJS441.js" />

    <script src="CSSsJSs/index.js"></script>
    <link rel="stylesheet" href="CSSsJSs/styleIndex.css" />
  </head>
  <body>
    <!----------------------------------------------TITULO--------------------------------------------->
    <div class="top">
      <div class="container">
        <div class="row">
          <div
            class="textCenter col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"
          ></div>
          <div class="textLeft col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
            <p class="titulo">EducApp</p>
          </div>
          <div class="textRight col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
            <p class="masInfo">+ info</p>
          </div>
          <div
            class="textCenter col-1 col-sm-1 col-md-1 col-lg-1 col-xl-1"
          ></div>
        </div>
      </div>
    </div>
    <!------------------------------------------------FIN TITULO----------------------------------------------->

    <div class="container">
      <div class="row">
        <p></p>
      </div>
      <div class="row">
        <p></p>
      </div>
      <div class="row">
        <p></p>
      </div>
    </div>

    <!----------------------------------------------PORTADA Y BOTONES--------------------------------------------->
    <div class="container">
      <div class="row">
        <div
          class="textCenter hidden-xs hidden-sm col-md-2 col-lg-2 col-xl-2"
        ></div>
        <div class="textCenter col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <img class="iconoPrincipal" src="icons/ufo.svg" />
        </div>
        <div class="textCenter col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
          <p class="slogan">¡Divertete aprendiendo!</p>
          <button class="boton1" id="botonCodigo">Tengo un código</button>
          <button class="boton2" id="botonSesion">Ingresar</button>
        </div>
        <div
          class="textCenter hidden-xs hidden-sm col-md-2 col-lg-2 col-xl-2"
        ></div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <p></p>
      </div>
    </div>
    <!--++++++++++++++++++++++++++++++++++ FORMAS +++++++++++++++++++++++++++++++++++++-->
    <div class="container" id="seccionCodigo" style="display:none;">
      <form class="needs-validation" action="errorInfoPages/infoCodePage.html" novalidate>
        <div class="form-row">
          <div class="col-md-3 mb-3">
            <label class="fuenteForma" for="validarCodigo">Código</label>
            <input
              type="text"
              class="form-control"
              id="validarCodigo"
              minlength="10"
              aria-describedby="inputGroupPrepend2"
              required
            />
            <div class="invalid-feedback">
              Por favor llena bien este campo.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label class="fuenteForma" for="validarCorreo">Correo</label>
            <input
              type="email"
              class="form-control"
              id="validarCorreo"
              placeholder="A01169493@itesm.mx"
              pattern=".+@itesm.mx"
              minlength="18"
              maxlength="18"
              required
            />
            <div class="invalid-feedback fuenteFormaError">
              Por favor llena bien este campo.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <!--div class="form-check pl-0 terminosCondiciones"-->
            <label class="" for="invalidCheck2">
              <a class="fuenteForma" href="http://www.google.com"
                >Acepto los términos</a
              >
            </label>
            <input
              class="cajaChequeo"
              type="checkbox"
              value=""
              id="invalidCheck2"
              required
            />
            <div class="invalid-feedback">
              Debes leer y aceptar.
            </div>
            <!--/div-->
          </div>
          <div class="col-md-3 mb-3">
            <label class="fuenteForma ocultoColor">||</label>
            <button type="submit"
              class="btn btn-primary btn-sm btn-rounded siguiente"
            >
              >
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="container" id="seccionSesion"  style="display:none;">
      <form class="needs-validation" action="https://zalutiz.000webhostapp.com/Educapp/registerEducapp.php" method="post" novalidate>
        <div class="form-row">
          <div style="display:none">
            <label class="fuenteForma" for="nombre">Nombre</label>
            <input
              name="name"
              type="text"
              class="form-control"
              id="nombre"
              placeholder="A01169493@itesm.mx"
              pattern=".+@itesm.mx"
              minlength="18"
              maxlength="18"
              value="Brandon1"
            />
          </div>
          <div class="col-md-4 mb-3">
            <label class="fuenteForma" for="validarUsuario">Usuario</label>
            <input
              name="username"
              type="email"
              class="form-control"
              id="validarUsuario"
              placeholder="A01169493@itesm.mx"
              pattern=".+@itesm.mx"
              minlength="18"
              maxlength="18"
              required
            />
            <div class="invalid-feedback fuenteFormaError">
              Por favor llena bien este campo.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="fuenteForma" for="validarPassword">Contraseña</label>
            <label class="fuenteForma olvidada" id="contraOlvidada" for="validarPassword">¿Olvidaste tu contraseña?</label>
            <input
              name="password"
              type="password"
              class="form-control"
              id="validarPassword"
              aria-describedby="inputGroupPrepend2"
              required
            />
            <div class="invalid-feedback">
              Por favor llena bien este campo.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label class="fuenteForma ocultoColor">||</label>
            <button 
              class="btn btn-primary btn-sm btn-rounded siguiente"
              type="submit" 
            >
              >
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="container" id="emailSent" style="display:none;">
      <div class="row">
        <div class="textCenter col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <p class="fuenteForma">Te hemos enviado un mensaje a tu correo para recuperar tu contraseña.</p>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="textCenter col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <p>.</p>
        </div>
      </div>
      <div class="row">
        <div class="textCenter col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <p>.</p>
        </div>
      </div>
    </div>

    <div class="container" id="relleno">
      <div class="row">
        <div class="textCenter col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <p>.</p>
        </div>
      </div>
      <div class="row">
        <div class="textCenter col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <p>.</p>
        </div>
      </div>
    </div>

    <!---->
    <!--
    <div class="container">
      <div class="row">
        <div class="textCenter hidden-xs col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <h3>Column 1</h3>
          <p>Lorem ipsum dolor..</p>
        </div>
        <div class="textCenter col-10 col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <h3>Column 2</h3>
          <p>Lorem ipsum dolor..</p>
        </div>
        <div class="textCenter hidden-xs col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <h3>Column 3</h3>
          <p>Lorem ipsum dolor..</p>
        </div>
      </div>
    </div>
    -->
    <!---->
  </body>
  <footer class="foot">
    <div class=" container ">
      <div class=" row text-center">
        <div class="hidden-xs hidden-sm col-md-3 col-lg-3 col-xl-3 "></div>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2 ">
          <p class="footSubject">Nosotros</p>
        </div>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2 ">
          <p class="footSubject">Ayuda</p>
        </div>
        <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2 ">
          <p class="footSubject">Términos</p>
        </div>
        <div class="hidden-xs hidden-sm col-md-3 col-lg-3 col-xl-3"></div>
      </div>
    </div>
  </footer>
</html>
