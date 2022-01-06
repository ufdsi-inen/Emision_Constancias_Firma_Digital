<?php
  include '../Entidades/variables_globales.php';
  $url = SSL.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; //url actual (de la pagina)
  $url_index = URL_INDEX; //url del login
  $url_base  = URL_BASE;

  session_start();
  date_default_timezone_set('America/Lima');

  if($_SESSION[SESSION_USUARIO] == ''){
    header("Location: ".$url_index);
  }
  else if(!isset($_SESSION)) {
    header("Location: ".$url_index);
  }
  else {
    if($url != $url_index)
      header('Cache-Control: no cache'); 

    $user = $_SESSION[SESSION_USUARIO];

    if(isset($_REQUEST['opc']))
      $opc = $_REQUEST['opc'];
    else
      $opc = '';

    if(isset($_REQUEST['des_url']))
      $des_url = $_REQUEST['des_url'].'/index.php';
    else
      $des_url = 'EDU/GestionCurso/index.php';
  }
?>