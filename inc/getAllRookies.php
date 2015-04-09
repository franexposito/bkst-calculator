<?php
  require_once('config.php');

  if ($_POST) {
    $userID = $_POST["id_user"];

    try{
      $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      echo json_encode(array('result' => false, 'message' => $e->getMessage()));
    }

    $sql = "SELECT id_rookie, nombre, edad, estFisico, estAtaque, estDefensa, posicion FROM ROOKIES WHERE id_user = '$userID'";
    $result = $conexion->query($sql);
    $count = $result->rowCount();
    $conexion = null;
    $resp = array();

    if ($count > 0) {
      foreach ($result as $r) {
        $temp = array('id_rookie' => $r['id_rookie'], 'nombre' => $r['nombre'], 'edad' => $r['edad'], 'estFisico' => $r['estFisico'], 'estAtaque' => $r['estAtaque'], 'estDefensa' => $r['estDefensa'], 'posicion' => $r['posicion'] );
        $response[] = $temp;
      }
      echo json_encode(array("result" => true, 'resp' => $response));
    } else {
      echo json_encode(array("result" => false));
    }

  }
?>
