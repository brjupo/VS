var preguntaActual = 1;
var popUpLevantado = false;
var cantidadIDs = 0;
var puntos = 0;

window.onload = function () {
  //startClock();
  contarIDs();
  limpiarInputs(cantidadIDs);
  showQuestion(1);
};

document.addEventListener("click", function (evt) {
  var cruzCerrar = document.getElementById("cruzCerrar");
  var botonSiguientePregunta = document.getElementById("sprintNext");
  targetElement = evt.target; // clicked element

  do {
    if (targetElement == cruzCerrar) {
      seguroRegresar();
      return;
    }
    if (targetElement == botonSiguientePregunta) {
      siguientePregunta();
      return;
    }
    if (
      parseInt(targetElement.id) >= 10 * preguntaActual - 3 &&
      parseInt(targetElement.id) <= 10 * preguntaActual &&
      popUpLevantado === false
    ) {
      //console.log(parseInt(targetElement.id));
      whiteButtons(targetElement.id);
      sprintNext();
      popUpLevantado = true;
      //console.log(popUpLevantado);
      return;
    }
    if (
      parseInt(targetElement.id) == 10 * preguntaActual - 4 &&
      popUpLevantado === false
    ) {
      //console.log(parseInt(targetElement.id));
      whiteButtonsType2(targetElement.id);
      sprintNextType2();
      popUpLevantado = true;
      //console.log(popUpLevantado);
      return;
    }
    // Go up the DOM
    targetElement = targetElement.parentNode;
  } while (targetElement);
});

function seguroRegresar() {
  if (
    confirm(
      "¿Estás seguro de regresar?\n Si regresas perderás todo tu avance de este tema"
    )
  ) {
    window.location.href = "https://kaanbal.net";
  }
}

function whiteButtons(seleccionada) {
  var numero = preguntaActual;
  var numeroCorrecta = 3000 + numero;
  respuestaCorrecta = document.getElementById(numeroCorrecta).innerHTML;
  //console.log(respuestaCorrecta);
  var IDrespuestaCorrecta;
  for (var i = 10 * numero - 3; i <= 10 * numero; i++) {
    //Convertir todos a blanco de la pregunta en curso
    document.getElementById(i).className = "OpcionBlanco";
    //Buscar el id que contiene lo mismo que la respuesta correcta
    //console.log(document.getElementById(i).innerHTML);
    if (document.getElementById(i).innerHTML == respuestaCorrecta) {
      IDrespuestaCorrecta = i;
      //console.log(i);
    }
  }
  //Marcar en rojo la respuesta seleccionada
  document.getElementById(seleccionada).className = "OpcionIncorrecta";
  //Buscar la respuesta correcta
  document.getElementById(IDrespuestaCorrecta).className = "OpcionCorrecta";
  if (IDrespuestaCorrecta == seleccionada) {
    puntos = puntos + 1;
    document.getElementById("puntosBuenos").innerHTML = puntos;
  }
}

//$IDTextoEscrito = 10 * $respuestas - 5; == inputEscrito
//$IDBotonAceptar = 10 * $respuestas - 4; == miniBoton
function whiteButtonsType2() {
  var numero = preguntaActual;
  var numeroCorrecta = 3000 + numero;

  //NORMALIZAR la respuesta CORRECTA
  var respuestaCorrectaTrim = document.getElementById(numeroCorrecta).innerHTML.trim();
  var respuestaCorrectaNormalizada = respuestaCorrectaTrim.normalize('NFD')
  .replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi,"$1")
  .normalize();
  var respuestaCorrectaUpper = respuestaCorrectaNormalizada.toUpperCase();

  //Convertir a blanco el miniboton
  document.getElementById(10 * numero - 4).className = "OpcionMiniBlanco";

  var inputEscrito=10 * numero - 5;
  //NORMALIZAR la respuesta ESCRITA
  var respuestaEscritaTrim = document.getElementById(inputEscrito).value.trim();
  var respuestaEscritaNormalizada = respuestaEscritaTrim.normalize('NFD')
  .replace(/([^n\u0300-\u036f]|n(?!\u0303(?![\u0300-\u036f])))[\u0300-\u036f]+/gi,"$1")
  .normalize();
  var respuestaEscritaUpper = respuestaEscritaNormalizada.toUpperCase();


  if (respuestaEscritaUpper == respuestaCorrectaUpper) {
    document.getElementById(inputEscrito).style.color = "green";
    puntos = puntos + 1;
    document.getElementById("puntosBuenos").innerHTML = puntos;
  } else {
    document.getElementById(inputEscrito).style.color = "red";
  }
}

function restoreInputColors() {
  document.getElementById(10 * preguntaActual - 5).style.color = "black";
}

function sprintNext() {
  disableAllButtons();
  document.getElementById("sprintNext").style.display = "block";
}
function sprintNextType2() {
  disableMiniButton();
  document.getElementById("sprintNext").style.display = "block";
}

function disableAllButtons() {
  var numero = preguntaActual;
  for (var i = 10 * numero - 3; i <= 10 * numero; i++) {
    document.getElementById(i).disabled = true;
  }
}
function disableMiniButton() {
  var numero = preguntaActual;
  var j = 10 * numero - 4;
  document.getElementById(j).disabled = true;
}

function siguientePregunta() {
  popUpLevantado = false;
  enableAllButtons();
  document.getElementById("sprintNext").style.display = "none";
  restoreInputColors();
  preguntaActual = preguntaActual + 1;
  showQuestion(preguntaActual);
}

function enableAllButtons() {
  if (document.getElementById(10 * numero - 4)) {
    document.getElementById(10 * numero - 4).disabled = false;
    console.log("mini Habilitado");
  }
  var numero = preguntaActual;
  if (document.getElementById(10 * numero - 3)) {
    for (var i = 10 * numero - 3; i <= 10 * numero; i++) {
      document.getElementById(i).disabled = false;
    }
    console.log("todos Habilitados");
  }
}

function startClock() {
  // Set the date we're counting down to
  var minutos = 0;
  var segundos = 10;
  var milisegundos = segundos * 1000 + minutos * 60 * 1000;
  var countDownDate = new Date(milisegundos).getTime();
  var unSegundo = new Date(1000).getTime();
  var sumaSegundos = new Date(1000).getTime();

  // Update the count down every 1 second
  var x = setInterval(function () {
    var previous = countDownDate - sumaSegundos - unSegundo;
    var actual = countDownDate - sumaSegundos;
    var later = countDownDate - sumaSegundos + unSegundo;
    //----------------------------ACTUAL-----------------------------------
    // Time calculations for days, hours, minutes and seconds
    var minutes = Math.floor((actual % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((actual % (1000 * 60)) / 1000);
    // Output the result in an element with id="demo"
    document.getElementById("actual").innerHTML =
      minutes + "m " + seconds + "s ";

    //----------------------------PREVIO-----------------------------------
    minutes = Math.floor(((actual - 1000) % (1000 * 60 * 60)) / (1000 * 60));
    seconds = Math.floor(((actual - 1000) % (1000 * 60)) / 1000);
    document.getElementById("previous").innerHTML =
      minutes + "m " + seconds + "s ";
    //----------------------------PREVIO-----------------------------------
    minutes = Math.floor(((actual + 1000) % (1000 * 60 * 60)) / (1000 * 60));
    seconds = Math.floor(((actual + 1000) % (1000 * 60)) / 1000);
    document.getElementById("later").innerHTML =
      minutes + "m " + seconds + "s ";

    // If the count down is over, write some text
    if (previous < 0) {
      document.getElementById("previous").innerHTML = "---";
    }
    if (actual < 0) {
      clearInterval(x);
      document.getElementById("actual").innerHTML = "TIEMPO!";
      if (popUpLevantado == false) {
        sprintNext();
        popUpLevantado = true;
        //console.log(popUpLevantado);
      }
    }
    sumaSegundos = sumaSegundos + unSegundo;
  }, 1000);
}

function contarIDs() {
  for (var i = 1001; i <= 1100; i++) {
    if (document.getElementById(i)) {
      //console.log(document.getElementById(i));
      cantidadIDs = i;
    }
  }
}

//Cada vez que se escribe sobre un input
//Firefox y o Google guardar la variable
//Para evitar que ya se tengan las respuestas, se limpiaran
//los campos input cada vez que se inicie [5,15,20,25]
function limpiarInputs(cantidadIDs){
  for (var i = 1; i <= cantidadIDs; i++) {
    //borrar a los i*10-5
    document.getElementById(i*10-5).value = "";
  }
}

function showQuestion(pregunta) {
  preguntaTexto = 1000 + pregunta;
  respuestaTexto = 2000 + pregunta;
  if (pregunta == 1) {
    document.getElementById(1001).style.display = "block";
    document.getElementById(2001).style.display = "block";
  } else {
    document.getElementById(preguntaTexto).style.display = "block";
    document.getElementById(respuestaTexto).style.display = "block";
    preguntaTexto = preguntaTexto - 1;
    respuestaTexto = respuestaTexto - 1;
    document.getElementById(preguntaTexto).style.display = "none";
    document.getElementById(respuestaTexto).style.display = "none";
  }
}
