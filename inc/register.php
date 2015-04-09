<?php

  require_once('config.php');

  if($_POST) {
   $usuarioS = $_POST["usuario"];
   $passwordS = md5($_POST["contrasena"]);
  } else {
   echo json_encode(array('result' => false));
  }

  try{
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
    $conexion->setAttribute( PDO::ATTR_PERSISTENT, true);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch ( PDOException $e ) {
    echo json_encode(array('result' => false, 'message' => $e->getMessage()));
  }

  $sql2 = "SELECT * FROM USUARIOS WHERE usuario = '$usuarioS'";
  $result2 = $conexion->query($sql2);

  if ($result2->fetchColumn() > 0) {
    echo json_encode(array('result' => false, 'user' => true));
  } else {
    $sql = "INSERT INTO USUARIOS (usuario, password) VALUES ('$usuarioS', '$passwordS')";

    try {
      $conexion->query( $sql );
      echo json_encode(array('result' => true));
    } catch ( PDOException $e ) {
      echo json_encode(array('result' => false));
    }
  }

  $conexion = null;

?>
