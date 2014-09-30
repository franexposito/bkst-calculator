var values = {"1": "38","2": "38","3": "40","4": "45","5": "53","6": "65","7": "83","8": "108","9": "140","10": "180","11": "230","12": "291",
              "13": "363","14": "447","15": "545","16": "658","17": "786","18": "930","19": "1092","20": "1273","21": "1473","22": "1693",  
              "23": "1935","24": "2200","25": "2488","26": "2800","27": "3138","28": "3503","29": "3895","30": "4315","31": "4765","32": "5246",
              "33": "5758","34": "6302","35": "6880","36": "7493"};
var valoracion = 0;
var subida = 0;
var entTot = 0;
var upVal = 0;
var pass= '';
var nombre= '';
var preVal = 0;
var email = '';

$(document).ready(function () {
    $('#modal-guardar .close').on('click', function() {
        $('.step1').css('display', 'block');
        $('.step2').css('display', 'none');
        $('.step3').css('display', 'none');
        $('.step4').css('display', 'none');
        nombre = '';
        pass = '';
        $('#nombre').val('');
        $('#pass1').val('');
    });
    
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
    
    $('#save').on('click', function() {
        $("#modal-guardar").modal('show');
    });
    
    $('#siguiente-save').on('click', function() {
        nombre = $('#nombre').val();
        if (nombre != '') {
            $('.alerta-span').hide();
            if ($.cookie('bkst-cal')) { 
                pass = $.cookie('bkst-cal');
                guardarRookie(nombre, pass);
                $('.step1').css('display', 'none');
                $('.step4').css('display', 'block');
            }
            else {
                $('.step1').css('display', 'none');
                $('.step2').css('display', 'block');
            
                $("#siguiente-save2").on('click', function() {
                    pass = $('#pass1').val();
                    email = $('#email').val();
                    if (!comprobarPass(pass)) {
                        $('.alerta-span').text('Contraseña no válida').show();
                    }
                    else {
                        $('.alerta-span').hide();
                        if (guardarRookie(nombre, pass)) {
                            $('.step2').css('display', 'none');
                            $('.step4').css('display', 'block');
                            //$.cookie('bkst-cal', pass, { expires : 1000 });     
                        }   
                    }

                });
                
                $("#siguiente-generar").on('click', function() {
                    pass = generarClave();
                    email = $('#email').val();
                    $('#step3-pass').text(pass);
                    $('.step2').css('display', 'none');
                    $('.step3').css('display', 'block');
                });
                
                $('#siguiente-save3').on('click', function() {
                    if (guardarRookie(nombre, pass)) {
                        $('.step3').css('display', 'none');
                        $('.step4').css('display', 'block');
                        //$.cookie('bkst-cal', pass, { expires : 1000 });    
                    }
                });
            }
                    
        }
        else {$('.alerta-span').text('Introduce un nombre para tu rookie.').show();}
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
        /*
        if (actVal < 0 || actVal > 99 ) { $(this).val(preVal); mensaje de error }
        //si anterior dias de entreno es menor que nuevos dias de entrenamientos calculamos aumento de valoracion
        else {
            //obtengo la caracteristica
            cat = $(this).data('car');
            var car = '#' + cat;
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
            
            if (actVal > preVal && actVal + actTot <= 144) {
                upVal = 0;
                var dif = actVal - preVal;
                if ( suma(estrellas, hcn, dif) ) {
                    valoracion = valoracion + upVal;
                    $(val_l).val(valoracion);
                    progressValue(cat, valoracion);
                    $(car).data('sub', subida);    
                }
              
                $(car).data('ent', entTot);
                actTot = actTot + dif;
                actVal = actVal;
                $(car).val(actVal);
                $('#tot').val(actTot);
            }
        }*/
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
});

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

function generarClave(){
    var source = '0123456789';
    var generada = 'bkst-34765';
    
    for (var i = 0; i < 5; i++) {
        
    }
    
    return generada;
}

function guardarRookie(nombre, pass, email) {
    //recogemos los datos necesarios del rookie
    var diasTotales = parseInt($('#tot').val());
    var altura = parseInt($('#altura').val());
    var edad = parseInt($('#edad').val());
    var peso = parseInt($('#peso').val());
    var envergadura = parseInt($('#envergadura').val());
    var posicion = parseInt($('posicion').val());
    var fisico = parseInt($('#fisico').val());
    var ataque = parseInt($('#ataque').val());
    var defensa = parseInt($('#defensa').val());
    
    var r = {"rookie" : {
                    "nombre": nombre,
                    "pass": pass,
                    "email": email,
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
        r.stats[1]['dataCar'] = car;
        var dataCar = i;
        var puntosEntrenamiento = $(car).data('ent');
        var subidasVal = $(car).data('sub');
        var diasEntrenados = $(car).data('ent');
        var id_hab = '#hab-' + i;
        var habilidad = $(id_hab).val();
        var val_i = '#val-' + i;
        var valoracion = $(val_i).val();
        var tipo = $(car).data('tipo'); 
    }
    
    
    var bool = false;
    /*
    $.ajax({
        type: "POST",
        async: false,
        data: data,
        url: "/inc/save.php",
        dataType: "json",
        success: function(resp) {
            if (resp.mensaje == 'false') {bool = false; }
        },
        error: function() {
            bool = false;
        }
        
    });
    */
    
    return true;
}

function comprobarPass(pass) {
    //recogemos datos
    var data = {"pass":pass};
    var bool = false;
    /*
    $.ajax({
        type: "POST",
        url: "/inc/check.php",
        data: data,
        async: false,
        dataType: 'json',
        success: function(resp) {
            if (resp.respuesta == 'true') { bool = true;}
            if (resp.respuesta == 'false') { bool = false;}
        },
        error : function(){
            bool = false;
        }
    });
    */
    
    return true;
    return bool;
}

function cargarRookies(pass) {
    
}