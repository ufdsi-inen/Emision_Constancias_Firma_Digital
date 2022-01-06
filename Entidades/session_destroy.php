<?php
    session_start();

    if($_REQUEST["url"])
        $cod_url = $_REQUEST["url"];
    else
        $cod_url = '';
    
	session_destroy();
    header("Location: $cod_url");
?>