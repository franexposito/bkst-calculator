<?php
  require_once('config.php');

  if ($_POST) {
    $datos = $_POST["datos"];
    $stats = $_POST["stats"];
    $id_user = $_POST["id_user"];
    $id_rookie;

    try {
      $conexion = new PDO(DB_DSN, DB_USUARIO, DB_CONTRASENIA);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
      echo json_encode(array('result' => false, 'message' => $e->getMessage()));
      die;
    }

    $sql = "INSERT INTO ROOKIES (id_user, nombre, altura, edad, envergadura, estAtaque, estDefensa, estFisico, peso, posicion, diasTotales) VALUES (:id_userA, :nombreA, :alturaA, :edadA, :envergaduraA, :estAtaqueA, :estDefensaA, :estFisicoA, :pesoA, :posicionA, :diasTotalesA)";
    $q = $conexion->prepare($sql);

    $a = array (
      ':id_userA' => $id_user,
      ':nombreA' => $datos['nombre'],
      ':alturaA' => $datos['altura'],
      ':edadA' => $datos['edad'],
      ':envergaduraA' => $datos['envergadura'],
      ':estAtaqueA' => $datos['estAtaque'],
      ':estDefensaA' => $datos['estDefensa'],
      ':estFisicoA' => $datos['estFisico'],
      ':pesoA' => $datos['peso'],
      ':posicionA' => $datos['posicion'],
      ':diasTotalesA' => $datos['diasTotales']
    );

    try {
      $q->execute($a);
      $id_rookie = $conexion->lastInsertId();
    } catch ( PDOException $e ) {
      echo json_encode(array('result' => false, 'error' => $e->getMessage()));
    }

    $sqlStat = "INSERT INTO STATS (id_rookie, tipo, diasEntrenados, habilidad, puntosEntrenamiento, subidasVal, valoracion) VALUES (:id_rookieA, :tipoA, :diasEntrenadosA, :habilidadA, :puntosEntrenamientoA, :subidasValA, :valoracionA)";
    $qStat = $conexion->prepare($sqlStat);
    $type = 0;

    foreach ($stats as $st) {
      $type = $type + 1;
      $a = array (
        ':id_rookieA' => $id_rookie,
        ':tipoA' => $type,
        ':diasEntrenadosA' => $st['diasEntrenados'],
        ':habilidadA' => $st['habilidad'],
        ':puntosEntrenamientoA' => $st['puntosEntrenamiento'],
        ':subidasValA' => $st['subidasVal'],
        ':valoracionA' => $st['valoracion']
      );
      try {
        $qStat->execute($a);
      } catch ( PDOException $e ) {
        echo json_encode(array('result' => false, 'error' => $e->getMessage(), 'sql' => $a));
      }
    }

    echo json_encode(array('result' => true));
    $conexion = null;
  }
?>
