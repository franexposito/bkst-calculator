<?php
  require_once('config.php');

  $userD = $_POST["usuario"];
  $passD = md5($_POST["contrasena"]);

  try{
    $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch ( PDOException $e ) {
    echo json_encode(array('result' => false, 'message' => $e->getMessage()));
  }

  $sql = "SELECT * FROM USUARIOS WHERE usuario = '$userD' and password = '$passD'";
  $result = $conexion->query($sql);

  $conexion = null;
  $fresult = $result->fetchColumn();
  if ($fresult > 0) {
    if (!isset($_SESSION)) {
      session_start();
    }
    $_SESSION['user'] = $userD;
    $_SESSION['id_user'] = $fresult;
    echo json_encode(array('result' => true));
  } else {
    echo json_encode(array('result' => false));
  }

?>
