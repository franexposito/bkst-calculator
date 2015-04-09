<?php
  require_once('config.php');

  if ($_POST) {
    $idRookie = $_POST["id_rookie"];

    try{
      $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch ( PDOException $e ) {
      echo json_encode(array('result' => false, 'message' => $e->getMessage()));
    }

    $sql = "SELECT * FROM ROOKIES WHERE id_rookie = '$idRookie'";
    $datos = $conexion->query($sql);
    $sql2 = "SELECT * FROM STATS WHERE id_rookie = '$idRookie' ORDER BY tipo ASC";
    $rookieStats = $conexion->query($sql2);
    $count = $datos->rowCount();
    $conexion = null;
    $rookie = array();
    $stats = array();

    if ($count > 0) {
      foreach ($datos as $r) {
        $rookie = array('id_rookie' => $r['id_rookie'], 'nombre' => $r['nombre'], 'altura' => $r['altura'], 'edad' => $r['edad'], 'envergadura' => $r['envergadura'], 'estFisico' => $r['estFisico'], 'estAtaque' => $r['estAtaque'], 'estDefensa' => $r['estDefensa'], 'peso' => $r['peso'], 'posicion' => $r['posicion'], 'diasTotales' => $r['diasTotales'] );
      }
      foreach ($rookieStats as $s) {
        $temp = array('tipo' => $s['tipo'], 'diasEntrenados' => $s['diasEntrenados'], 'habilidad' => $s['habilidad'], 'puntosEntrenamiento' => $s['puntosEntrenamiento'], 'subidasVal' => $s['subidasVal'], 'valoracion' => $s['valoracion']);
        $stats[] = $temp;
      }
      echo json_encode(array("result" => true, 'datos' => $rookie, 'stats' => $stats));
    } else {
      echo json_encode(array("result" => false));
    }

  }
?>
