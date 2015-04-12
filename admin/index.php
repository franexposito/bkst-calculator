<?php
require('../inc/utilities.php');
require('../inc/sqlUtilities.php');
/*if (!hasPrivileges()) {
  header('Location: /calculadora');
}*/
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="../images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="manifest" href="../images/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../images/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../static/styles/main.css">
    <link type="text/css" rel="stylesheet" href="../static/styles/admin.css">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Panel de administración</title>
  </head>

  <body>
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
      <div class="menu-bottom-div"></div>
      <div class="header-name">
        <a href="/">BKST Tools</a>
      </div>
    </nav>
    <!--/navegador -->
    <!-- titulo -->
    <div class="title col-sm-12">
      <h1>Panel de administración <small>beta</small></h1>
    </div>
    <!-- fin titulo -->
    <main class="container-fluid">
      <div class="row">

        <!-- inicio panel usuarios -->
        <section class="panel-usuarios col-sm-6">
          <div id="usuarios-graf" class="graf">
            <div>
              <?php
                echo '<h2>';getNumberUsers(); echo ' <br /> usuarios</h2>';
              ?>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h1><i class="fa fa-users"></i> Usuarios</h1>
            </div>
            <div class="panel-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Registro</th>
                    <th>Rookies</th>
                    <th></th>
                    <th></th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    getAllUsers();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
        <!-- fin panel usuarios -->

        <!-- inicio panel rookies -->
        <section class="panel-rookies col-sm-6">
          <div id="rookies-graf" class="graf">
            <div>
              <?php
                echo '<h2>';getNumberRookies(); echo ' <br /> rookies</h2>';
              ?>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h1><i class="fa fa-smile-o"></i> Rookies</h1>
            </div>
            <div class="panel-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    getRookies();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </section>
        <!-- fin panel usuarios -->

      </div>
    </main>

    <!-- scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  </body>

</html>
