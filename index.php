<?php 

    /*****************************************************************************
    TIPO            : script
    NOMBRE          : index.php
    AUTOR           : PGONZALESC
    FECHA CREACION  : 02/12/2020
    ID REQ          :
    MOTIVO          : Muestra login de acceso para ingresar al aplicativo web
    *****************************************************************************/
    session_start();
    include('Entidades/variables_globales.php');

    if(SSL === 'https://') {
    	if (!isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "on")
    		header("Location: ".URL_INDEX);
    }

    if(isset($_SESSION[SESSION_USUARIO])) {
		if ($_SESSION[SESSION_USUARIO] <> '' )
			header("Location: ".URL_BASE);
		else
			header("Location: ".URL_INDEX);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Instituto Nacional de Enfermedades Neoplásicas</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<!-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> -->
	<link rel="shortcut icon" href="images/icons/Logo-inen.png" type="image/png">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form id="form" role="form" method="post" action="admin/" class="login100-form validate-form" >
					<span class="login100-form-title p-b-43">
						Ingrese su cuenta SISINEN
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="usuario" id="usuario" autocomplete="username" autofocus>
						<span class="focus-input100"></span>
						<span class="label-input100">Usuario</span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" id="password" autocomplete="current-password">
						<span class="focus-input100"></span>
						<span class="label-input100">Contraseña</span>
					</div>

					<div class="container-login100-form-btn">
						<input type="button" class="login100-form-btn" id="btn_login" value="Aceptar">
					</div>
				</form>

				<div class="login100-more" style="background-image: url('images/inen.jpg');">
				</div>
			</div>
		</div>
	</div>
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert2/sweetalert2.all.js"></script>
	<script src="vendor/redirect/redirect.js"></script>

	<script type="text/javascript">

        const enviar = () => {
        	let peticion = new XMLHttpRequest();
	        peticion.open('post', 'Entidades/validacion_usuario.php?accion=web');
	        peticion.send(new FormData(form));
	        peticion.onload = function() {
	            let obj = JSON.parse(peticion.response);
	            
	            if(obj.cod_error == '1' || obj.cod_error == '01')
	              form.submit();
	            else {
	                swal.fire("Aviso!",obj.des_error, "info")
            		.then((value) => {
                        password.value = '';
                        password.focus();
                    });
	            }
	        };
        }

        window.onload = () => {
        	btn_login.addEventListener('click', () => enviar() );

        	password.addEventListener('keydown', event => {
        		if (event.keyCode == 13) {
	               enviar();
	            }
        	});
        }
    </script>
</body>
</html>