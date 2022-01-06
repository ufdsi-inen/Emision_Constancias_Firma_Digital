<?php
    //CONEXIÓN BD
    if (!defined('PROD')) define('PROD', '<Nombre de servidor de Producción>'); //Base de Datos de Producción
	if (!defined('DESA')) define('DESA', '<Nombre de servidor de Desarrollo>'); //Base de Datos de Desarrollo
	if (!defined('BD_CONNECT')) define('BD_CONNECT', PROD); //Se selecciona a que BD se quiere apuntar

	if (!defined('SESSION_USUARIO')) define('SESSION_USUARIO', 'web_usuario');
	if (!defined('SESSION_USUARIO_BD')) define('SESSION_USUARIO_BD', 'web_usuario_bd');
	if (!defined('SESSION_CLAVE_BD')) define('SESSION_CLAVE_BD', 'web_clave_bd');

	if (!defined('USER_BD_DEFAULT')) define('USER_BD_DEFAULT', ''); //Usuario de  BD
	if (!defined('CLAVE_BD_DEFAULT')) define('CLAVE_BD_DEFAULT', ''); //Clave de BD

	//DIRECCIÓN URL DE LA PÁGINA 
	if (!defined('HTTP')) define('HTTP', 'http://');
    if (!defined('HTTPS')) define('HTTPS', 'https://');
    if (!defined('SSL')) define('SSL', HTTP);

    if (!defined('DOMAIN')) define('DOMAIN', SSL.'localhost'); //Dominio
	if (!defined('DIR')) define('DIR', '/ConstanciaDigital'); //Nombre de la carpeta donde se encuentra el código

	if (!defined('URL_INDEX')) define('URL_INDEX', DOMAIN.DIR);
	if (!defined('URL_BASE')) define('URL_BASE', URL_INDEX."/admin/");

	//WEB SERVICE 
	//MINSA
	if (!defined('RENIEC_MINSA')) define('RENIEC_MINSA', ''); //Dirección del web service de la RENIEC
	if (!defined('DNI_AUTORIZADO')) define('DNI_AUTORIZADO', ''); //DNI autorizado para la consulta del WS

	//MAIL
	if (!defined('USER_CORREO')) define('USER_CORREO', '');
	if (!defined('PASS_CORREO')) define('PASS_CORREO', '');
	if (!defined('SMTP_SERVER_CORREO')) define('SMTP_SERVER_CORREO', ''); //SMT SERVER del correo
?>