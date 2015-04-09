<?php
  require_once('config.php');

  if ($_POST) {
    $id_rookie = $_POST["id_rookie"];

    try {
      $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      echo json_encode(array('result' => false, 'message' => $e->getMessage()));
    }

    $sql = "DELETE FROM ROOKIES WHERE id_rookie = '$id_rookie'";
    $result = $conexion->query($sql);
    $sql2 = "DELETE FROM STATS WHERE id_rookie = '$id_rookie'";
    $result2 = $conexion->query($sql2);
    $conexion = null;

    if ($result == true && $result2 == true) {
      echo json_encode(array('result' => true));
    } else {
      echo json_encode(array('result' => false));
    }
  }

?>
