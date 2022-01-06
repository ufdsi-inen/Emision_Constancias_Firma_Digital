<?php
session_start();
include("../conexion/connect.php");
include("variables_globales.php");

date_default_timezone_set('America/Lima');

if(isset($_REQUEST["accion"])) {
  $accion = $_REQUEST["accion"];

  if($accion == "web") {
    $usuario  = strtoupper($_REQUEST["usuario"]);
    $password = $_REQUEST["password"];

    $stid = oci_parse($conn, 'begin INEN.SP_ADM_WS_VALIDA_USUARIO(:p1, :p2, :p3, :p4, :p5); end;');

    oci_bind_by_name($stid, ':p1', $usuario);                   //pvi_cod_usuario
    oci_bind_by_name($stid, ':p2', $password);                  //pvi_des_clave           

    oci_bind_by_name($stid, ':p3', $cod_error, 40);             //pdo_cod_error
    oci_bind_by_name($stid, ':p4', $des_error, 100);            //pdo_des_error
    $cursor = oci_new_cursor($conn);
    oci_bind_by_name($stid, ':p5', $cursor,-1,OCI_B_CURSOR);    //pdo_datos_usuario

    oci_execute($stid);

    if($cod_error == '01') { //USUARIO Y CLAVE VÁLIDOS
        oci_execute($cursor);

        while($data=oci_fetch_array($cursor, OCI_BOTH)){ 
            $datos_usuario[]=$data;
        }
        $_SESSION[SESSION_USUARIO_BD] = $datos_usuario[0]['COD_USUARIO'];
        $_SESSION[SESSION_CLAVE_BD]   = $datos_usuario[0]['CLAVE'];
        $_SESSION[SESSION_USUARIO]    = $usuario;
    }

    echo json_encode(array('cod_error'=> $cod_error, 'des_error' => $des_error));
    oci_free_statement($stid);
    oci_close($conn);
  }
}
?>