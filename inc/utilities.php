<?php
  //Con esta función comprobamos si el usuario ha iniciado sesión.
  function isUserAuth(){
    if ( !isset($_SESSION) ){
      session_start();
    }

    if ( isset($_SESSION['user']) ){
      return true;
    } else {
      return false;
    }
  }

  //Obtenemos el nombre del usuario
  function getNameUser() {
    if (isset($_SESSION)) {
      echo $_SESSION['user'];
    }
  }

  //Obtenemos el id del usuario
  function getIdUser() {
    if (isset($_SESSION)) {
      echo $_SESSION['id_user'];
    }
  }

  //Comprobamos si tiene privilegios
  function hasPrivileges() {
    if ($_SESSION['privileges'] == '1') {
      return true;
    } else {
     return false;
    }
  }
?>
