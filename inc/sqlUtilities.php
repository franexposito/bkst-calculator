<?php
  require_once('config.php');

  function getNumberUsers() {
    try {
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      die;
    }

    $sql = "SELECT * FROM USUARIOS";
    $result = $conexion->query($sql);
    $count = $result->rowCount();
    $conexion = null;

    if ($count > 0) {
      echo $count;
    } else {
      echo 0;
    }
  }

  function getNumberRookies() {
    try {
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      die;
    }

    $sql = "SELECT * FROM ROOKIES";
    $result = $conexion->query($sql);
    $count = $result->rowCount();
    $conexion = null;

    if ($count > 0) {
      echo $count;
    } else {
      echo 0;
    }
  }

  function getAllUsers() {
    try {
      $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      die;
    }

    $sql = "SELECT id_usuario, usuario, fecha  FROM USUARIOS";
    $result = $conexion->query($sql);
    $count = $result->rowCount();
    $conexion = null;

    if ($count > 0) {
      foreach ($result as $u) {
        $n = getNumberRookieUser($u["id_usuario"]);
        echo '<tr>
                <th>'.$u["usuario"].'</th>
                <th>'.date('m/d/Y', strtotime($u["fecha"])).'</th>
                <th>'.$n.'</th>
                <th></th>
                <th></th>
                <th>
                  <a data-userid="'.$u["id_usuario"].'" data-toggle="tooltip" data-placement="top" title="Eliminar" href="#"><i class="fa fa-trash-o"></i></a>
                  <a data-userid="'.$u["id_usuario"].'" data-toggle="tooltip" data-placement="top" title="Hacer admin" href="#"><i class="fa fa-key"></i></a>
                </th>
              </tr>';
      }
    }

  }

  function getNumberRookieUser($id) {
    try {
      $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      die;
    }

    $sql = "SELECT * FROM ROOKIES WHERE id_user = '$id'";
    $result = $conexion->query($sql);
    $count = $result->rowCount();
    $conexion = null;

    if ($count > 0) {
      return $count;
    } else {
      return 0;
    }
  }

  function getRookies() {
    try {
      $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      die;
    }

    $sql = "SELECT id_rookie, id_user, nombre FROM ROOKIES";
    $result = $conexion->query($sql);
    $conexion = null;

    foreach ($result as $r) {
      $u = getRookieUser($r["id_user"]);
      echo '<tr>
              <th>'.$r["nombre"].'</th>
              <th>'.$u.'</th>
              <th></th>
              <th></th>
              <th></th>
              <th>
                <a data-rookieid="'.$r["id_rookie"].'" data-toggle="tooltip" data-placement="top" title="Eliminar" href="#"><i class="fa fa-trash-o"></i></a>
              </th>
            </tr>';
    }
  }

  function getRookieUser($id) {
    try {
      $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      die;
    }

    $sql = "SELECT usuario FROM USUARIOS WHERE id_usuario = '$id'";
    $result = $conexion->query($sql);
    $conexion = null;

    return $result->fetchColumn();
  }

?>
