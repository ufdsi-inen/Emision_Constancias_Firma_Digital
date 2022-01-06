<?php
    
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

    include  __DIR__.'/../Entidades/variables_globales.php';

    $Servidor = BD_CONNECT;
    $db_charset = 'AL32UTF8';

    if(isset($_SESSION[SESSION_USUARIO_BD]))
        $Usuario = $_SESSION[SESSION_USUARIO_BD];
    else
        $Usuario = USER_BD_DEFAULT; 

    if(isset($_SESSION[SESSION_CLAVE_BD]))
        $Password = $_SESSION[SESSION_CLAVE_BD];
    else
        $Password = CLAVE_BD_DEFAULT;

    $conn = oci_connect($Usuario, $Password, $Servidor, $db_charset) or die("</br><Strong>Disculpen las molestias. Estamos trabajando para usted...</Strong>");

    if (!$conn) {
        $e = oci_error();
        print htmlentities($e['message']);
        exit;
    }

    function ObtenerIP()
    {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        $ip = getenv("REMOTE_ADDR");
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $ip = $_SERVER['REMOTE_ADDR'];
        else
        $ip = "IP desconocida";
        return($ip);
    }
?>