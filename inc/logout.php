<?php
    include('utilities.php');

  if (isUserAuth()) {
      if ( !isset($_SESSION) ){
        session_start();
    }

    unset($_SESSION['user']);
    unset($_SESSION['id_user']);
    unset($_SESSION['privileges']);
    session_destroy();

  }

  header('Location: ../calculadora');
  die;
?>
