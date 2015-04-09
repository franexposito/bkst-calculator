<?php
    include('utilities.php');

  if (isUserAuth()) {
      if ( !isset($_SESSION) ){
        session_start();
    }

    unset($_SESSION['user']);
    session_destroy();

  }

  header('Location: ../calculadora');
  die;
?>
