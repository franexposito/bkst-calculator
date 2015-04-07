/*jslint browser: true*/
/*global $, jQuery, alert*/
var values = {"1": "38", "2": "38", "3": "40", "4": "45", "5": "53", "6": "65", "7": "83", "8": "108", "9": "140", "10": "180", "11": "230", "12": "291", "13": "363", "14": "447", "15": "545", "16": "658", "17": "786", "18": "930", "19": "1092", "20": "1273", "21": "1473", "22": "1693", "23": "1935", "24": "2200", "25": "2488", "26": "2800", "27": "3138", "28": "3503", "29": "3895", "30": "4315", "31": "4765", "32": "5246", "33": "5758", "34": "6302", "35": "6880", "36": "7493"};
var valoracion = 0;
var subida = 0;
var entTot = 0;
var upVal = 0;
var pass = '';
var nombre = '';
var preVal = 0;
var email = '';

function suma(estrellas, hcn, dias) {
  var jornada;
  var up = false;
  var posSubida = subida;
  if (estrellas == 1) { jornada = 14;}
  if (estrellas == 2) { jornada = 27;}
  if (estrellas == 3) { jornada = 41;}
  if (estrellas == 4) { jornada = 55;}
  if (estrellas == 5) { jornada = 68;}

  if (hcn == 2) { jornada = jornada * 1.5;}
  if (hcn == 3) { jornada = jornada * 0.5;}

  entTot = entTot + (jornada * dias);

  for (var i = posSubida; i < 36; i++) {
    if (entTot >= values[i+1] && valoracion + upVal < 99) {
      posSubida = posSubida + 1; upVal = upVal + 1; up = true;
    }
  }

  if (up == true) { subida = posSubida; }

  return up;
}

function resta(estrellas, hcn, dias) {
  var jornada;
  var down = false;
  var posBajada = subida;
  if (estrellas == 1) { jornada = 14;}
  if (estrellas == 2) { jornada = 27;}
  if (estrellas == 3) { jornada = 41;}
  if (estrellas == 4) { jornada = 55;}
  if (estrellas == 5) { jornada = 68;}

  if (hcn == 2) { jornada = jornada * 1.5;}
  if (hcn == 3) { jornada = jornada * 0.5;}

  entTot = entTot - (jornada * dias);
  for (var i = posBajada; i > 0; i--) {
    if (entTot < values[i]) {posBajada = posBajada - 1; upVal = upVal + 1; down = true;}
  }

  if (down == true) {subida = posBajada;}

  return down;
}

function progressColor(valoracion, p_l) {
  if (valoracion >= 0 && valoracion < 45) {$(p_l).css('background', 'rgb(7, 221, 0)');}
  if (valoracion >= 45 && valoracion < 60) {$(p_l).css('background', 'rgb(221, 221, 0)');}
  if (valoracion >= 60 && valoracion < 70) {$(p_l).css('background', 'rgb(245, 159, 0)');}
  if (valoracion >= 70 && valoracion < 80) {$(p_l).css('background', 'rgb(221, 144, 0)');}
  if (valoracion >= 80 && valoracion < 90) {$(p_l).css('background', 'rgb(221, 51, 0)');}
  if (valoracion >= 90 && valoracion < 100) {$(p_l).css('background', 'rgb(255, 0, 0)');}
}

function progressValue(cat, valoracion) {
  var p_l = '#progress-' + cat;
  $(p_l).attr('aria-valuenow', valoracion);
  var val_percent = valoracion + '%';
  $(p_l).css('width', val_percent);
  progressColor(valoracion, p_l);
}

function guardarRookie() {
  //recogemos los datos necesarios del rookie
  var diasTotales = parseInt($('#tot').val());
  var altura = parseInt($('#altura').val());
  var edad = parseInt($('#edad').val());
  var peso = parseInt($('#peso').val());
  var envergadura = parseInt($('#envergadura').val());
  var posicion = parseInt($('#posicion').val());
  var fisico = parseInt($('#fisico').val());
  var ataque = parseInt($('#ataque').val());
  var defensa = parseInt($('#defensa').val());
  var nombre = $('#nombre').val();

  var rookie = {"datos" : {
    "nombre": nombre,
    "diasTotales": diasTotales,
    "altura": altura,
    "edad": edad,
    "peso": peso,
    "envergadura": envergadura,
    "posicion": posicion,
    "estFisico": fisico,
    "estAtaque": ataque,
    "estDefennsa": defensa
  },
           "stats": {

           }};

  //recogemos los datos necesarios de los stats
  for (var i = 1; i < 12; i++) {
    var car = '#' + i;
    var dataCar = i;
    var puntosEntrenamiento = parseInt($(car).data('ent'));
    var subidasVal = parseInt($(car).data('sub'));
    var diasEntrenados = parseInt($(car).val());
    var id_hab = '#hab-' + i;
    var habilidad = parseInt($(id_hab).val());
    var val_i = '#val-' + i;
    var valoracion = parseInt($(val_i).val());
    rookie.stats[i] = {
      'valoracion': valoracion,
      'habilidad': habilidad,
      'diasEntreandos': diasEntrenados,
      'subidasVal': subidasVal,
      'puntosEntrenamiento': puntosEntrenamiento
    }
  }

  $.ajax({
    type: "POST",
    data: rookie,
    url: "/save",
    dataType: "json",
    success: function(resp) {
      console.log(resp);
    },
    error: function() {
      bool = false;
    }
  });
}

function cargarRookie(pass) {
  var id = '5504946647087063d08233b6';
  var data = {'id':id};
  $.ajax({
    type: "POST",
    data: data,
    url: "/load",
    dataType: "json",
    success: function(resp) {
      $.each(resp, function (key, value) {
        console.log(key + ':' + value);
      });
      //$('#altura').val(resp.datos);
    },
    error: function() {
      bool = false;
    }
  });
}

function showMenu(bot) {
  'use strict';
  $(bot).addClass('active');
  $('#menu-div').show("slide", { direction: "left" }, 800);
}

function hideMenu() {
  'use strict';
  $('#menu-bottom').removeClass('active');
  $('#menu-div').hide("slide", { direction: "left" }, 800);
}

$(document).ready(function () {
  $('#load').on('click', function() {
    if ($.cookie('bkst-cal')) {
      $('.stepA').css('display', 'none');
      $('.stepB').css('display', 'block');
      pass = $.cookie('bkst-cal').val();
      cargarRookies(pass);
    }
    $('#modal-cargar').modal('show');

    $('#siguiente-load').on('click', function () {
      pass = $('#pass2').val('');
      $('.stepA').css('display', 'none');
      $('.stepB').css('display', 'block');
    });
  });

  $('#save').on('click', function(e) {
    e.preventDefault();
    hideMenu()
    guardarRookie();
  });

  $('.mas button').on('click', function() {
    //obtengo la caracteristica
    cat = $(this).data('car');
    var car = '#' + cat;
    //obtengo el numero de dias actual
    var actVal = parseInt($(car).val());
    //obtengo el numero total de dias de entrenamiento
    var actTot = parseInt($('#tot').val());
    //obtengo el tipo de la caracteristica, fisico, defensa o ataque
    var tipo = '#' + $(car).data('tipo');
    var estrellas = $(tipo).val();
    //obtengo los puntos de entrenamiento de la caracteristica
    entTot = parseInt($(car).data('ent'));
    //obtengo las veces que ha subido de stat la caracteristica
    subida = $(car).data('sub');
    //obtengo si es habilidad, carencia o nada
    var id_hab = '#hab-' + cat;
    var hcn = $(id_hab).val();
    //obtengo la valoracion
    var val_l = '#val-' + cat;
    valoracion = parseInt($(val_l).val());

    if (actVal < 144 && actTot < 144 && valoracion < 99) {
      //Calculamos cuantos puntos va a sumar
      upVal = 0;
      if ( suma(estrellas, hcn, 1) ) {
        valoracion = valoracion + upVal;
        $(val_l).val(valoracion);
        progressValue(cat, valoracion);
        $(car).data('sub', subida);


      }

      $(car).data('ent', entTot);
      actVal = actVal + 1;
      actTot = actTot + 1;
      $(car).val(actVal);
      $('#tot').val(actTot);
    }

    if (actTot == 144) {
      $('.alertas').hide();
      $('#alerta1').show();
    }

  });

  $('.menos button').on('click', function() {
    //obtengo la caracteristica
    cat = $(this).data('car');
    var car = '#' + cat;
    //obtengo el numero de dias actual
    var actVal = parseInt($(car).val());
    //obtengo el numero total de dias de entrenamiento
    var actTot = parseInt($('#tot').val());
    //obtengo el tipo de la caracteristica, fisico, defensa o ataque
    var tipo = '#' + $(car).data('tipo');
    var estrellas = $(tipo).val();
    //obtengo los puntos de entrenamiento de la caracteristica
    entTot = parseInt($(car).data('ent'));
    //obtengo las veces que ha subido de stat la caracteristica
    subida = $(car).data('sub');
    //obtengo si es habilidad, carencia o nada
    var id_hab = '#hab-' + cat;
    var hcn = $(id_hab).val();
    //obtengo la valoracion
    var val_l = '#val-' + cat;
    valoracion = parseInt($(val_l).val());

    if (actVal > 0 && actTot > 0) {
      //Calculamos cuantos puntos va a restar
      upVal = 0;
      if ( resta(estrellas, hcn, 1) ) {
        valoracion = valoracion - upVal;
        $(val_l).val(valoracion);
        progressValue(cat, valoracion);
        $(car).data('sub', subida);
      }

      $(car).data('ent', entTot);
      actVal = actVal - 1;
      actTot = actTot - 1;
      $(car).val(actVal);
      $('#tot').val(actTot);

    }

  });

  $('.stats-val').on('focus', function() {
    preVal = $(this).val();
  });

  $('.stats-val').on('blur', function () {
    $(this).val(preVal);
  });

  $('.stats').on('blur', function (){
    var cat = $(this).data('car');
    var val_l = '#val-' + cat;
    valoracion = parseInt($(val_l).val());
    if (valoracion > 99 || valoracion < 0) { $('.alertas').hide(); $('#alerta2').show(); $(val_l).val(0);}
    else if (valoracion >= 0 && valoracion <= 99) {progressValue(cat, valoracion);}
    else {$('.alertas').hide(); $('#alerta2').show();$(val_l).val(0);}
  });

  $('#reset').on('click', function(e) {
    e.preventDefault();
    $('.stats').val(0);
    for (var i = 1; i < 12; i++) {
      progressValue(i, 0);
    }
    $('.stats-val').data('ent', 0);
    $('.stats-val').data('sub', 0);
    $('.stats-val').val(0);
    $('.stats-hab').val(1);
    $('#tot').val(0);
    $('#fisico').val(1);
    $('#defensa').val(1);
    $('#ataque').val(1);
    $('#altura').val('');
    $('#edad').val('');
    $('#peso').val('');
    $('#nombre').val('');
    $('#envergadura').val('');
  });

  $('#altura').on('blur', function () {
    var altura = $(this).val();
    if ((altura < 100 || altura > 250) && altura != '') {$('.alertas').hide();$('#alerta2').show();$(this).val('');}
  });

  $('#edad').on('blur', function () {
    var edad = $(this).val();
    if ((edad < 13 || edad > 18) && edad != '' ) {$('.alertas').hide();$('#alerta2').show();$(this).val('');}
  });

  $('#peso').on('blur', function () {
    var peso = $(this).val();
    if ((peso < 50 || peso > 250) && peso != '' ) {$('.alertas').hide();$('#alerta2').show();$(this).val('');}
  });

  $('#envergadura').on('blur', function () {
    var envergadura = $(this).val();
    if ((envergadura < 100 || envergadura > 250) && envergadura != '' ) {$('.alertas').hide();$('#alerta2').show();$(this).val('');}
  });

  $('#menu-bottom').on('click', function (evt) {
    if ($(this).hasClass('active')) {
      hideMenu();
    } else {
      showMenu($(this));
    }
    evt.preventDefault();
    evt.stopPropagation();
  });

  $('html').click(function (evt) {
    if ($('#menu-bottom').hasClass('active')) {
      hideMenu();
    }
  });

  $('#menu-div').click(function (evt) {
    evt.stopPropagation();
  });

  $('#registro').on('click', function (e) {
    e.preventDefault();
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $('#form-registro').slideUp('800');
    } else {
      $(this).addClass('active');
      $('#form-registro').slideDown('800');
      $('#form-login').slideUp('800');
    }
  });

  $('#entrar').on('click', function (e) {
    e.preventDefault();
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $('#form-login').slideUp('800');
    } else {
      $(this).addClass('active');
      $('#form-login').slideDown('800');
      $('#form-registro').slideUp('800');
    }
  });
});
