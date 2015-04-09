<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="images/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="images/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../static/styles/main.css">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Calculadora de rookies</title>
  </head>

  <body>
    <?php
      include('inc/utilities.php');
    ?>
    <div class="col-sm-12 tp">
      <div class="col-xs-2 color-top-1"></div>
      <div class="col-xs-2 color-top-2"></div>
      <div class="col-xs-2 color-top-3"></div>
      <div class="col-xs-2 color-top-4"></div>
      <div class="col-xs-2 color-top-5"></div>
      <div class="col-xs-2 color-top-6"></div>
    </div>

    <!--nav -->
    <nav class="navegador">
      <div class="menu-bottom-div">
        <button id="menu-bottom" type="button" class="btn btn-default navbar-btn">
          <i class="fa fa-bars fa-2x"></i>
        </button>
      </div>
      <div class="header-name">
        <a href="/">BKST Tools</a>
      </div>
    </nav>
    <!--/navegador -->

    <!-- menu -->
    <div id="menu-div" class="menu-content col-sm-3 col-md-2">
      <div class="menu">
        <ul class="nav menu-nav">
          <?php
            if (isUserAuth()) {
              echo '
                <li data-iduser="'; getIdUser(); echo'" class="titulo-nombre nombre-id"><p>'; getNameUser(); echo '</p></li>
                <li class="titulo-menu"><p><i class="fa fa-cog"></i> Rookies </p></li>
                <div class="divisor"></div>
                <li class="option-menu"><a id="save" href=""><i class="fa fa-floppy-o"></i> Guardar rookie </a></li>
                <li class="option-menu"><a id="load" href=""><i class="fa fa-clipboard"></i> Cargar rookie </a></li>
                <li class="option-menu"><a id="reset" href=""><i class="fa fa-plus"></i> Nuevo rookie </a></li>
                <li class="titulo-menu"><p><i class="fa fa-sliders"></i> Herramientas </p></li>
                <div class="divisor"></div>
                <li class="option-menu"><a href="http://bkst.franexposito/calculadora"><i class="fa fa-th"></i> Calculadora de rookies </a></li>
                <li class="titulo-menu"><p><i class="fa fa-question"></i> Ayuda </i></p></li>
                <div class="divisor"></div>
                <li class="option-menu"><a href="https://github.com/franexposito/bkst-calculator"><i class="fa fa-github"></i> Fork me on Github </a></li>
                <li class="option-menu"><a href="http://franexposito.es/contact"><i class="fa fa-phone"></i> Contacto </a></li>
                <li class="option-menu"><a href="http://basketstars.com"><i class="fa fa-star-o"></i> Basketstars </a></li>
                <li class="option-menu"><a href="http://franexposito.es"><i class="fa fa-at"></i> Fran Expósito </a></li>
                <li class="option-menu"><a href="inc/logout"><i class="fa fa-sign-out"></i> Salir </a></li>
              ';
            } else {
              echo '
                <li class="titulo-nombre"><p> Cuenta </p></li>
                <li class="option-menu"><a id="entrar" href=""><i class="fa fa-sign-in"></i> Entrar </a></li>
                <form id="form-login" style="display:none;">
                  <div class="form-group">
                    <input type="text" class="form-control" id="l-usuario" placeholder="Usuario...">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" id="l-pass" placeholder="Contraseña...">
                  </div>
                  <button type="submit" class="btn btn-default btn-block">Entrar</button>
                  <p id="error-form2" class="error-form"></p>
                </form>
                <li class="option-menu"><a id="registro" href=""><i class="fa fa-user-plus"></i> Registrarse </a></li>
                <form id="form-registro" style="display:none;">
                  <div class="form-group">
                    <input type="text" class="form-control" id="r-usuario" placeholder="Usuario...">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" id="r-pass1" placeholder="Contraseña...">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" id="r-pass2" placeholder="Repita contraseña...">
                  </div>
                  <button type="submit" class="btn btn-default btn-block">Registrarse</button>
                  <p id="error-form1" class="error-form"></p>
                  <p id="success-form1" class="success-form"></p>
                </form>
              ';
            }
          ?>
        </ul>
      </div>
    </div>
    <!-- fin menu -->

    <!-- titulo -->
    <div class="title col-sm-12">
      <h1>Calculadora de Rookies <small>beta</small></h1>
    </div>
    <!-- fin titulo -->

    <div class="container-fluid">
      <!-- inicio de cuerpo principal -->
      <div id="cuerpo" class="row">
        <!-- inicio de caracteristicas -->
        <div id="calculadora" class="col-md-9">
          <!-- inicio de nombre seccion -->
           <div id="t">
            <div class="col-md-1 col-xs-1">
              <h1 data-toggle="tooltip" data-placement="bottom" title="Stat">STA</h1>
            </div>
            <div class="col-md-8 col-xs-6">
              <div class="col-md-1 col-xs-3">
                <h1 data-toggle="tooltip" data-placement="bottom" title="Valoración">VAL</h1>
              </div>
              <div class="col-md-11 col-xs-9">
                <h1 data-toggle="tooltip" data-placement="bottom" title="Progreso">PROGRESO</h1>
              </div>
            </div>
            <div class="col-md-3 col-xs-5">
              <div class="col-md-3 col-xs-3"></div>
              <div class="col-md-3 col-xs-3">
                <h1 data-toggle="tooltip" data-placement="bottom" title="Entrenamientos">ENT</h1>
              </div>
              <div class="col-md-3 col-xs-3"></div>
              <div class="col-md-3 col-xs-3">
                <h1 data-toggle="tooltip" data-placement="bottom" title="Habilidad o carencia">H/C</h1>
              </div>
            </div>
          </div>
          <!-- fin de nombre seccion -->
          <!-- VELOCIDAD -->
          <div data-car="1" class="caracteristicas">
            <div class="car nombre col-md-1 col-xs-1"><span>VEL</span></div>
            <div class="car progreso col-md-8 col-xs-6">
              <div class="val col-md-1 col-xs-3">
                <div class="input-group">
                  <input type="text" id="val-1" class="form-control stats" data-car="1" value="0" >
                </div>
              </div>
              <div class="barra col-md-11 col-xs-9">
                <div class="progress">
                  <div id="progress-1" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="99" style="width:0%;">
                  </div>
                </div>
              </div>
            </div>
            <div class="car valor col-md-3 col-xs-5">
              <div class="menos lab col-md-3 col-xs-3">
                <button data-car="1" type="button" class="btn btn-default btn-block"><i class="fa fa-minus"></i></button>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input data-car="1" data-sub="0" data-tipo="fisico" data-ent="0" id="1" type="text" class="stats-val form-control" value="0">
                </div>
              </div>
              <div class="mas lab col-md-3 col-xs-3">
                <button  data-car="1" type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i></button>
              </div>
              <div class="carencia col-md-3 col-xs-3">
                <div class="form-group">
                  <select id="hab-1" class="stats-hab form-control">
                    <option value="1">-</option>
                    <option value="2">H</option>
                    <option value="3">C</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN DE VELOCIDAD -->
          <!-- SALTO -->
          <div data-car="2" class="caracteristicas">
            <div class="car nombre col-md-1 col-xs-1">
              <span>SAL</span>
            </div>
            <div class="car progreso col-md-8 col-xs-6">
              <div class="val col-md-1 col-xs-3">
                <div class="input-group">
                  <input type="text" id="val-2" class="form-control stats" data-car="2" value="0" >
                </div>
              </div>
              <div class="barra col-md-11 col-xs-9">
                <div class="progress">
                  <div id="progress-2" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="99" style="width:0%;">
                  </div>
                </div>
              </div>
            </div>
            <div class="car valor col-md-3 col-xs-5">
              <div class="menos lab col-md-3 col-xs-3">
                <button data-car="2" type="button" class="btn btn-default btn-block btn-block"><i class="fa fa-minus"></i></button>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input data-car="2" data-sub="0" data-tipo="fisico" data-ent="0" id="2" type="text" class="stats-val form-control" value="0">
                </div>
              </div>
              <div class="mas lab col-md-3 col-xs-3">
                <button  data-car="2" type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i></button>
              </div>
              <div class="carencia col-md-3 col-xs-3">
                <div class="form-group">
                  <select id="hab-2" class="stats-hab form-control">
                    <option value="1">-</option>
                    <option value="2">H</option>
                    <option value="3">C</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN DE SALTO -->
          <!-- RESISTENCIA -->
          <div data-car="3" class="caracteristicas">
            <div class="car nombre col-md-1 col-xs-1">
              <span>RES</span>
            </div>
            <div class="car progreso col-md-8 col-xs-6">
              <div class="val col-md-1 col-xs-3">
                <div class="input-group">
                  <input type="text" id="val-3" class="form-control stats" data-car="3" value="0" >
                </div>
              </div>
              <div class="barra col-md-11 col-xs-9">
                <div class="progress">
                  <div id="progress-3" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="99" style="width:0%;">
                  </div>
                </div>
              </div>
            </div>
            <div class="car valor col-md-3 col-xs-5">
              <div class="menos lab col-md-3 col-xs-3">
                <button data-car="3" type="button" class="btn btn-default btn-block"><i class="fa fa-minus"></i></button>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input data-car="3" data-sub="0" data-tipo="fisico" data-ent="0" id="3" type="text"class="stats-val form-control" value="0">
                </div>
              </div>
              <div class="mas lab col-md-3 col-xs-3">
                <button  data-car="3" type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i></button>
              </div>
              <div class="carencia col-md-3 col-xs-3">
                <div class="form-group">
                  <select id="hab-3" class="stats-hab form-control">
                    <option value="1">-</option>
                    <option value="2">H</option>
                    <option value="3">C</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN DE RESISTENCIA -->
          <br />
          <!-- PASE -->
          <div data-car="4" class="caracteristicas">
            <div class="car nombre col-md-1 col-xs-1">
              <span>PAS</span>
            </div>
            <div class="car progreso col-md-8 col-xs-6">
              <div class="val col-md-1 col-xs-3">
                <div class="input-group">
                  <input type="text" id="val-4" class="form-control stats" data-car="4" value="0" >
                </div>
              </div>
              <div class="barra col-md-11 col-xs-9">
                <div class="progress">
                  <div id="progress-4" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="99" style="width:0%;">
                  </div>
                </div>
              </div>
            </div>
            <div class="car valor col-md-3 col-xs-5">
              <div class="menos lab col-md-3 col-xs-3">
                <button data-car="4" type="button" class="btn btn-default btn-block"><i class="fa fa-minus"></i></button>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input data-car="4" data-sub="0" data-tipo="ataque" data-ent="0" id="4" type="text" name="4" class="stats-val form-control" value="0">
                </div>
              </div>
              <div class="mas lab col-md-3 col-xs-3">
                <button  data-car="4" type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i></button>
              </div>
              <div class="carencia col-md-3 col-xs-3">
                <div class="form-group">
                  <select id="hab-4" class="stats-hab form-control">
                    <option value="1">-</option>
                    <option value="2">H</option>
                    <option value="3">C</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN DE PASE -->
          <!-- T1 -->
          <div data-car="5" class="caracteristicas">
            <div class="car nombre col-md-1 col-xs-1">
              <span>T1</span>
            </div>
            <div class="car progreso col-md-8 col-xs-6">
              <div class="val col-md-1 col-xs-3">
                <div class="input-group">
                  <input type="text" id="val-5" class="form-control stats" data-car="5" value="0" >
                </div>
              </div>
              <div class="barra col-md-11 col-xs-9">
                <div class="progress">
                  <div id="progress-5" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="99" style="width:0%;">
                  </div>
                </div>
              </div>
            </div>
            <div class="car valor col-md-3 col-xs-5">
              <div class="menos lab col-md-3 col-xs-3">
                <button data-car="5" type="button" class="btn btn-default btn-block"><i class="fa fa-minus"></i></button>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input data-car="5" data-sub="0" data-tipo="ataque" data-ent="0" id="5" type="text" name="5" class="stats-val form-control" value="0">
                </div>
              </div>
              <div class="mas lab col-md-3 col-xs-3">
                <button  data-car="5" type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i></button>
              </div>
              <div class="carencia col-md-3 col-xs-3">
                <div class="form-group">
                  <select id="hab-5" class="stats-hab form-control">
                    <option value="1">-</option>
                    <option value="2">H</option>
                    <option value="3">C</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN DE T1 -->
          <!-- T2 -->
          <div data-car="6" class="caracteristicas">
            <div class="car nombre col-md-1 col-xs-1">
              <span>T2</span>
            </div>
            <div class="car progreso col-md-8 col-xs-6">
              <div class="val col-md-1 col-xs-3">
                <div class="input-group">
                  <input type="text" id="val-6" class="form-control stats" data-car="6" value="0" >
                </div>
              </div>
              <div class="barra col-md-11 col-xs-9">
                <div class="progress">
                  <div id="progress-6" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="99" style="width:0%;">
                  </div>
                </div>
              </div>
            </div>
            <div class="car valor col-md-3 col-xs-5">
              <div class="menos lab col-md-3 col-xs-3">
                <button data-car="6" type="button" class="btn btn-default btn-block"><i class="fa fa-minus"></i></button>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input data-car="6" data-sub="0" data-tipo="ataque" data-ent="0" id="6" type="text" name="6" class="stats-val form-control" value="0">
                </div>
              </div>
              <div class="mas lab col-md-3 col-xs-3">
                <button  data-car="6" type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i></button>
              </div>
              <div class="carencia col-md-3 col-xs-3">
                <div class="form-group">
                  <select id="hab-6" class="stats-hab form-control">
                    <option value="1">-</option>
                    <option value="2">H</option>
                    <option value="3">C</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN DE T2 -->
          <!-- T3 -->
          <div data-car="7" class="caracteristicas">
            <div class="car nombre col-md-1 col-xs-1">
              <span>T3</span>
            </div>
            <div class="car progreso col-md-8 col-xs-6">
              <div class="val col-md-1 col-xs-3">
                <div class="input-group">
                  <input type="text" id="val-7" class="form-control stats" data-car="7" value="0" >
                </div>
              </div>
              <div class="barra col-md-11 col-xs-9">
                <div class="progress">
                  <div id="progress-7" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="99" style="width:0%;">
                  </div>
                </div>
              </div>
            </div>
            <div class="car valor col-md-3 col-xs-5">
              <div class="menos lab col-md-3 col-xs-3">
                <button data-car="7" type="button" class="btn btn-default btn-block"><i class="fa fa-minus"></i></button>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input data-car="7" data-sub="0" data-tipo="ataque" data-ent="0" id="7" type="text" name="7" class="stats-val form-control" value="0">
                </div>
              </div>
              <div class="mas lab col-md-3 col-xs-3">
                <button  data-car="7" type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i></button>
              </div>
              <div class="carencia col-md-3 col-xs-3">
                <div class="form-group">
                  <select id="hab-7" class="stats-hab form-control">
                    <option value="1">-</option>
                    <option value="2">H</option>
                    <option value="3">C</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN DE T3 -->
          <!-- MATE -->
          <div data-car="8" class="caracteristicas">
            <div class="car nombre col-md-1 col-xs-1">
              <span>MAT</span>
            </div>
            <div class="car progreso col-md-8 col-xs-6">
              <div class="val col-md-1 col-xs-3">
                <div class="input-group">
                  <input type="text" id="val-8" class="form-control stats" data-car="8" value="0" >
                </div>
              </div>
              <div class="barra col-md-11 col-xs-9">
                <div class="progress">
                  <div id="progress-8" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="99" style="width:0%;">
                  </div>
                </div>
              </div>
            </div>
            <div class="car valor col-md-3 col-xs-5">
              <div class="menos lab col-md-3 col-xs-3">
                <button data-car="8" type="button" class="btn btn-default btn-block"><i class="fa fa-minus"></i></button>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input data-car="8" data-sub="0" data-tipo="ataque" data-ent="0" id="8" type="text" name="8" class="stats-val form-control" value="0">
                </div>
              </div>
              <div class="mas lab col-md-3 col-xs-3">
                <button  data-car="8" type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i></button>
              </div>
              <div class="carencia col-md-3 col-xs-3">
                <div class="form-group">
                  <select id="hab-8" class="stats-hab form-control">
                    <option value="1">-</option>
                    <option value="2">H</option>
                    <option value="3">C</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN DE MATE -->
          <br />
          <!-- ROBO -->
          <div data-car="9" class="caracteristicas">
            <div class="car nombre col-md-1 col-xs-1">
              <span>ROB</span>
            </div>
            <div class="car progreso col-md-8 col-xs-6">
              <div class="val col-md-1 col-xs-3">
                <div class="input-group">
                  <input type="text" id="val-9" class="form-control stats" data-car="9" value="0" >
                </div>
              </div>
              <div class="barra col-md-11 col-xs-9">
                <div class="progress">
                  <div id="progress-9" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="99" style="width:0%;">
                  </div>
                </div>
              </div>
            </div>
            <div class="car valor col-md-3 col-xs-5">
              <div class="menos lab col-md-3 col-xs-3">
                <button data-car="9" type="button" class="btn btn-default btn-block"><i class="fa fa-minus"></i></button>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input data-car="9" data-sub="0" data-tipo="defensa" data-ent="0" id="9" type="text" name="9" class="stats-val form-control" value="0">
                </div>
              </div>
              <div class="mas lab col-md-3 col-xs-3">
                <button  data-car="9" type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i></button>
              </div>
              <div class="carencia col-md-3 col-xs-3">
                <div class="form-group">
                  <select id="hab-9" class="stats-hab form-control">
                    <option value="1">-</option>
                    <option value="2">H</option>
                    <option value="3">C</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN DE ROBO -->
          <!-- REBOTE -->
          <div data-car="10" class="caracteristicas">
            <div class="car nombre col-md-1 col-xs-1">
              <span>REB</span>
            </div>
            <div class="car progreso col-md-8 col-xs-6">
              <div class="val col-md-1 col-xs-3">
                <div class="input-group">
                  <input type="text" id="val-10" class="form-control stats" data-car="10" value="0" >
                </div>
              </div>
              <div class="barra col-md-11 col-xs-9">
                <div class="progress">
                  <div id="progress-10" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="99" style="width:0%;">
                  </div>
                </div>
              </div>
            </div>
            <div class="car valor col-md-3 col-xs-5">
              <div class="menos lab col-md-3 col-xs-3">
                <button data-car="10" type="button" class="btn btn-default btn-block"><i class="fa fa-minus"></i></button>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input data-car="10" data-sub="0" data-tipo="defensa" data-ent="0" id="10" type="text" name="10" class="stats-val form-control" value="0">
                </div>
              </div>
              <div class="mas lab col-md-3 col-xs-3">
                <button  data-car="10" type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i></button>
              </div>
              <div class="carencia col-md-3 col-xs-3">
                <div class="form-group">
                  <select id="hab-10" class="stats-hab form-control">
                    <option value="1">-</option>
                    <option value="2">H</option>
                    <option value="3">C</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN DE REBOTE -->
          <!-- TAPON -->
          <div data-car="11" class="caracteristicas">
            <div class="car nombre col-md-1 col-xs-1">
              <span>TAP</span>
            </div>
            <div class="car progreso col-md-8 col-xs-6">
              <div class="val col-md-1 col-xs-3">
                <div class="input-group">
                  <input type="text" id="val-11" class="form-control stats" data-car="11" value="0" >
                </div>
              </div>
              <div class="barra col-md-11 col-xs-9">
                <div class="progress">
                  <div id="progress-11" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="99" style="width:0%;">
                  </div>
                </div>
              </div>
            </div>
            <div class="car valor col-md-3 col-xs-5">
              <div class="menos lab col-md-3 col-xs-3">
                <button data-car="11" data-car="11" type="button" class="btn btn-default btn-block"><i class="fa fa-minus"></i></button>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input data-sub="0" data-tipo="defensa" data-ent="0" id="11" type="text" name="11" class="stats-val form-control" value="0">
                </div>
              </div>
              <div class="mas lab col-md-3 col-xs-3">
                <button  data-car="11" type="button" class="btn btn-default btn-block"><i class="fa fa-plus"></i></button>
              </div>
              <div class="carencia col-md-3 col-xs-3">
                <div class="form-group">
                  <select id="hab-11" class="stats-hab form-control">
                    <option value="1">-</option>
                    <option value="2">H</option>
                    <option value="3">C</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN DE TAPON -->
          <!-- TOTALES -->
          <div class="totales">
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-8 col-xs-6">
              <div class="col-md-1 col-xs-2"></div>
              <div class="col-md-11 col-xs-10"></div>
            </div>
            <div class="col-md-3 col-xs-5">
              <div class="ent col-md-3 col-xs-3">
                <h1>TOT</h1>
              </div>
              <div class="value lab col-md-3 col-xs-3">
                <div class="input-group">
                  <input type="text" name="tot" id="tot" class="form-control" value="0">
                </div>
              </div>
              <div class="col-md-3 col-xs-3"></div>
              <div class="col-md-3 col-xs-3"></div>
            </div>
          </div>
          <!-- FIN DE TOTALES -->
        </div>
        <!-- fin de caracteristicas -->
        <!-- inicio de stats relacionados con su físico -->
        <div class="datos-cont col-sm-3">
          <section id="datos">
            <form role="form">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-terminal"></i></span>
                <input id="nombre" type="text" class="form-control" placeholder="nombre">
              </div>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-terminal"></i></span>
                <input id="altura" type="text" class="form-control" placeholder="altura">
              </div>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-terminal"></i></span>
                <input id="edad" type="text" class="form-control" placeholder="edad">
              </div>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-terminal"></i></span>
                <input id="peso" type="text" class="form-control" placeholder="peso">
              </div>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-terminal"></i></span>
                <input id="envergadura" type="text" class="form-control" placeholder="envergadura">
              </div>
              <div class="form-group">
                <label for="posicion">Posición</label>
                <select id="posicion" name="posicion" class="form-control">
                  <option value="1">Base</option>
                  <option value="2">Escolta</option>
                  <option value="3">Alero</option>
                  <option value="4">Ala-Pívot</option>
                  <option value="5">Pívot</option>
                </select>
              </div>
              <div class="form-group">
                <label for="fisico">Físico</label>
                <select id="fisico" name="fisico" class="form-control">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="ataque">Ataque</label>
                <select id="ataque" name="ataque" class="form-control">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="defensa">Defensa</label>
                <select id="defensa" name="defensa" class="form-control">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
            </form>
          </section>
        </div>
        <!-- fin de stats fisicos -->
      </div>
      <!-- fin de cuerpo principal -->

      <!-- inicio de alertas -->
      <div class="col-md-6 col-sm-offset-3 alertas">
        <div style="display:none;" id="alerta-peligro" class="alert alert-danger">
          <button type="button" class="close c-alert">&times;</button>
          <p></p>
        </div>
        <div style="display:none;" id="alerta-exito" class="alert alert-success alert-dismissable">
          <button type="button" class="close c-alert" data-dismiss="alert">&times;</button>
          <p></p>
        </div>
      </div>
      <!-- fin de alertas -->
      <!-- inicio de ventanas modales -->

    <div class="modal fade" id="modal-cargar" tabindex="-1" role="dialog" aria-labelledby="modal-cargar-label" aria-hidd  en="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <h4 class="modal-title" id="modal-cargar-label">Rookies</h4>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
              <table class="table table-load-rookies">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Posicion</th>
                    <th>Físico</th>
                    <th>Ataque</th>
                    <th>Defensa</th>
                    <th>Edad</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody class="table-load-rookies-body">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- fin de ventanas modales -->
    </div>

  <!-- scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <script src="static/js/calculadora.js"></script>
  </body>
</html>
