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

function hideErrorForm(error) {
  if ($(error).is(":visible")) {
    $($(error).hide());
  }
}

function showErrorForm(text, error) {
  $(error).text(' ');
  $(error).text(text);
  $(error).show();
}

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

  var rookie = {
    "id_user": $('.nombre-id').data('iduser'),
    "datos" : {
      "nombre": nombre,
      "diasTotales": diasTotales,
      "altura": altura,
      "edad": edad,
      "peso": peso,
      "envergadura": envergadura,
      "posicion": posicion,
      "estFisico": fisico,
      "estAtaque": ataque,
      "estDefensa": defensa
    },
    "stats": {

    }
  };

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
      'diasEntrenados': diasEntrenados,
      'subidasVal': subidasVal,
      'puntosEntrenamiento': puntosEntrenamiento
    }
  }

  $.ajax({
    type: "POST",
    data: rookie,
    url: "inc/setRookie.php",
    dataType: "json",
    success: function(resp) {
      if (resp.result === true) {
        showAlerta('Rookie guardado con exito', $('#alerta-exito'));
      } else {
        showAlerta('Se ha producido un error, intenta guardarlo luego.', $('#alerta-peligro'));
      }
    },
    error: function() {
      alert('Se ha producido un error');
    }
  });
}

function cargarRookie(id_rookie) {
  var data = {
    "id_rookie": id_rookie
  };

  $.ajax({
    type: "POST",
    data: data,
    url: "inc/getRookie.php",
    dataType: "json",
    success: function(resp) {
      if (resp.result === true) {
        $('#modal-cargar').modal('hide');
        //Cargamos los datos personales
        var datos = resp.datos;
        $('#tot').val(datos['diasTotales']);
        $('#altura').val(datos['altura']);
        $('#edad').val(datos['edad']);
        $('#peso').val(datos['peso']);
        $('#envergadura').val(datos['envergadura']);
        $('#posicion').val(datos['posicion']);
        $('#fisico').val(datos['estFisico']);
        $('#ataque').val(datos['estAtaque']);
        $('#defensa').val(datos['estDefensa']);
        $('#nombre').val(datos['nombre']);

        //Cargamos los datos de las stats
        var stats = resp.stats;
        $.each(stats, function(index) {
          var t = stats[index].tipo;
          var car = '#' + t;
          var dataCar = stats[index].tipo;
          $(car).data('ent', stats[index].puntosEntrenamiento);
          $(car).data('sub', stats[index].subidasVal);
          $(car).val(stats[index].diasEntrenados);
          var id_hab = '#hab-' + t;
          $(id_hab).val(stats[index].habilidad);
          var val_i = '#val-' + t;
          $(val_i).val(stats[index].valoracion);
          progressValue(t, parseInt(stats[index].valoracion));
        });

      } else {
        showErrorForm('Se ha producido un error, inténtelo de nuevo', $('#alerta-peligro'));
      }
    },
    error: function() {
      showErrorForm('Se ha producido un error, inténtelo de nuevo', $('#alerta-peligro'));
    }
  });
}

function checkPosicion(opt) {
  var pos;
  switch (parseInt(opt)) {
    case 1:
      pos = 'Base';
      break;
    case 2:
      pos = 'Escolta';
      break;
    case 3:
      pos = "Alero";
      break;
    case 4:
      pos = "Ala-Pívot";
      break;
    case 5:
      pos = "Pívot";
      break;
  }
  return pos;
}

function checkEstrella(est) {
  var nEst;
  switch (parseInt(est)) {
      case 1:
        nEst = '<i class="fa fa-star"></i>';
        break;
      case 2:
        nEst = '<i class="fa fa-star"></i><i class="fa fa-star"></i>';
        break;
      case 3:
        nEst = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
        break;
      case 4:
        nEst = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
        break;
      case 5:
        nEst = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
        break;
  }

  return nEst;
}

function obtenerRookies() {
  var data = {'id_user': $('.nombre-id').data('iduser')};
  $.ajax({
    type: "POST",
    data: data,
    url: "inc/getAllRookies.php",
    dataType: "json",
    success: function(resp) {
      if(resp.result === true) {
        var rookies = resp.resp;
        $.each(rookies, function (index) {
          var pos = checkPosicion(rookies[index].posicion);
          var ataque = checkEstrella(rookies[index].estAtaque);
          var defensa = checkEstrella(rookies[index].estDefensa);
          var fisico = checkEstrella(rookies[index].estFisico);
          var r = "<tr><th>"+rookies[index].nombre+"</th><th>"+pos+"</th><th>"+fisico+"</th><th>"+ataque+"</th><th>"+defensa+"</th><th>"+rookies[index].edad+"</th><th><a class='load-r' data-idrookie='"+rookies[index].id_rookie+"' href='#'><i class='fa fa-upload'></i> Cargar</a></th><th><a class='delete-r' data-idrookie='"+rookies[index].id_rookie+"' href='#'><i class='fa fa-trash-o'></i></a></th></tr>"
          $('.table-load-rookies-body').prepend(r);
        });
      } else {
        $('.table-load-rookies-body').html('<p>No tienes ningún rookie guardado</p>');
      }
    },
    error: function() {
      alert('Ha habido un error, intentalo más tarde');
    }
  });
}

function borrarRookie(id_rookie) {
  var data = {
    "id_rookie": id_rookie
  };

  $.ajax({
    type: "POST",
    data: data,
    url: "inc/deleteRookie.php",
    dataType: "json",
    success: function(resp) {
      if (resp.result === true) {
        $('*[data-idrookie="'+id_rookie+'"]').parent().parent().fadeOut();
        showErrorForm('El rookie ha sido eliminado', $('#alerta-peligro'));
      } else {
        showErrorForm('Se ha producido un error, inténtelo de nuevo', $('#alerta-peligro'));
      }
    },
    error: function() {
      showErrorForm('Se ha producido un error, inténtelo de nuevo', $('#alerta-peligro'));
    }
  });
}

function crearUsuario(user, password) {
  var user = {
    "usuario": user,
    "contrasena": password
  };

  $.ajax({
    type: "POST",
    data: user,
    url: "inc/register.php",
    dataType: "json",
    success: function(resp) {
      if (resp.result === true) {
        showErrorForm('Registro completo. Ahora puedes iniciar sesión', $('#success-form1'));
      } else {
        if(resp.user === true) {
          showErrorForm('El usuario ya está cogido', $('#error-form1'));
        } else {
          showErrorForm('Se ha producido un error, inténtelo de nuevo', $('#error-form1'));
        }
      }
    },
    error: function() {
      showErrorForm('Se ha producido un error, inténtelo de nuevo', $('#error-form1'));
    }
  });
}

function loginUsuario(user, password) {
  var user = {
    "usuario": user,
    "contrasena": password
  };

  $.ajax({
    type: "POST",
    data: user,
    url: "inc/login.php",
    dataType: "json",
    success: function(resp) {
      if (resp.result === true) {
        location.reload(true);
      } else {
        showErrorForm('Se ha producido un error, inténtelo de nuevo', $('#error-form2'));
      }
    },
    error: function() {
      showErrorForm('Se ha producido un error, inténtelo de nuevo', $('#error-form2'));
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

function resetValues() {
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
}

function checkValues() {
  var check = true;
  var nombre = $('#nombre').val();
  if (nombre.length <= 0) {
    showAlerta('Introduce un nombre para tu rookie', $('#alerta-peligro'));
    check = false;
  }

  return check;
}

function sticky_relocate() {
  'use strict';
  var window_top = $(window).scrollTop(),
    div_top = 40;
  if (window_top > div_top) {
    $('.navegador').addClass('transp');
  } else {
    $('.navegador').removeClass('transp');
  }
}

function showAlerta(text, alert) {
  if ($(alert).is(':visible')) {
    $(alert).hide();
  }
  $(alert).children('p').text(' ');
  $(alert).children('p').text(text);
  $(alert).show();
}

$(document).ready(function () {
  $('#load').on('click', function(evt) {
    evt.preventDefault();
    $('.table-load-rookies-body').html('');
    $('#modal-cargar').modal('show');
    hideMenu();
    obtenerRookies();
  });

  $('#save').on('click', function(e) {
    e.preventDefault();
    hideMenu();
    var check = checkValues();
    if (check) {
      guardarRookie();
    }
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
    if (valoracion > 99 || valoracion < 0) {
      showAlerta('Introduce una val válida. Entre 0 y 99', $('#alerta-peligro'));
      $(val_l).val(0);
    }
    else if (valoracion >= 0 && valoracion <= 99) {
      progressValue(cat, valoracion);
    }
    else {
      $(val_l).val(0);
    }
  });

  $('#reset').on('click', function(e) {
    e.preventDefault();
    $('.stats').val(0);
    resetValues();
  });

  $('#altura').on('blur', function () {
    var altura = $(this).val();
    if ((altura < 100 || altura > 250) && altura != '') {
      $(this).val('');
      showAlerta('Introduce una altura válida. Entre 100 y 250', $('#alerta-peligro'));
    }
  });

  $('#edad').on('blur', function () {
    var edad = $(this).val();
    if ((edad < 12 || edad > 23) && edad != '' ) {
      $(this).val('');
      showAlerta('Introduce una edad válida. Entre 12 y 23', $('#alerta-peligro'));
    }
  });

  $('#peso').on('blur', function () {
    var peso = $(this).val();
    if (peso < 0 || peso > 300) {
      $(this).val('');
      showAlerta('Introduce un peso válido. Entre 0 y 300', $('#alerta-peligro'));
    }
  });

  $('#envergadura').on('blur', function () {
    var envergadura = $(this).val();
    if ((envergadura < 100 || envergadura > 300) && envergadura != '' ) {
      $(this).val('');
      showAlerta('Introduce una envergadura válida. Entre 100 y 300', $('#alerta-peligro'));
    }
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

  $('#form-registro').on('submit', function (evt) {
    evt.preventDefault();
    hideErrorForm($('#error-form1'));
    var user = $('#r-usuario').val();
    var pass1 = $('#r-pass1').val();
    var pass2 = $('#r-pass2').val();

    if (user.length <= 0) {
      showErrorForm("Introduce un usuario", $('#error-form1'));
    }
    else if (pass1.length <= 0 || pass2.length <= 0) {
      showErrorForm("Rellena ambas contraseñas", $('#error-form1'));
    }
    else if (pass1 !== pass2) {
      showErrorForm("Las contraseñas no coinciden", $('#error-form1'));
    } else {
      crearUsuario(user, pass1);
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

  $('#form-login').on('submit', function (evt) {
    evt.preventDefault();
    hideErrorForm($('#error-form2'));
    var user = $('#l-usuario').val();
    var pass = $('#l-pass').val();

    if (user.length <= 0) {
      showErrorForm("Introduce un usuario", $('#error-form2'));
    }
    else if (pass.length <= 0 ) {
      showErrorForm("Introduce la contraseña", $('#error-form2'));
    } else {
      loginUsuario(user, pass);
    }
  });

  $(function () {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
  });

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  $('.c-alert').on('click', function(evt) {
    evt.preventDefault();
    $(this).parent().hide();
  });

  $('body').on('click', 'a.delete-r', function(evt) {
    evt.preventDefault();
    borrarRookie($(this).data('idrookie'));
  });

  $('body').on('click', 'a.load-r', function(evt) {
    evt.preventDefault();
    cargarRookie($(this).data('idrookie'));
  });
});
