<?php
	include "../../../../Entidades/variables_globales.php";
	$opc = $_REQUEST['opc'];

	function getParam($param) {
		$url_base = DOMAIN.DIR."/admin/EDU/GestionCurso/";
		switch ($param) {
			case 'CLIENTID':
				return "FBsoKsPFYa6lSMbHG_G1_dovDqg";
				break;
			case 'CLIENTSECRET':
				return "c9ifg4y_dtHAE2c0n9VT";
				break;
			case 'PROTOCOL':
				return "https";
				break;
			case 'SERVER_PATH':
				return $url_base;
				break;
			case 'DIR_IMAGE':
				return $url_base."images";
				break;
			case 'FILEUPLOADURL':
				return $url_base."Entidades/Upload.php";
				break;
			case 'FILEDOWNLOADLOGOURL':
				return $url_base."images/iLogo1.png";
				break;
			case 'FILEDOWNLOADSTAMPURL':
				return $url_base."images/iFirma1.png";
				break;
			default:
				# code...
				break;
		}
	}

	switch ($opc) {
		case 'getFile':
			$documentName = $_REQUEST['documentName'];
			$separa=DIRECTORY_SEPARATOR;

			$tmp = dirname(tempnam (null,'')); 

			$archivo = $tmp.$separa."upload".$separa.$file_name.$documentName;

			header('Content-Type: application/pdf');
			header('Content-Disposition:attachment;filename="'.$documentName.'"');
			readfile($archivo);
			break;
		case 'postArguments':
			$parametro = $_REQUEST['parametro'];
			$data = explode(",", $parametro);
			$type = $data[0];
			$documentName = $data[1];
			$namePdf = $data[2];

			if($type=="L")
			{
			    $param ='{
						"app":"pdf",
						"fileUploadUrl":"'.getParam('FILEUPLOADURL').'",
						"reason":"Soy el autor del documento",
						"type":"L",
						"clientId":"'.getParam('CLIENTID').'",
						"clientSecret":"'.getParam('CLIENTSECRET').'",
						"dcfilter":".*FIR.*|.*FAU.*",
						"fileDownloadUrl":"",
						"posx":"200",
						"posy":"500",
						"outputFile":"'.$documentName.'",
						"protocol":"T",
						"contentFile":"",
						"stampAppearanceId":"0",
						"isSignatureVisible":"true",
						"idFile":"MyForm",
						"fileDownloadLogoUrl":"'.getParam('SERVER_PATH').'images/iLogo1.png",
						"fileDownloadStampUrl":"'.getParam('SERVER_PATH').'images/iFirma1.png",
						"pageNumber":"0",
						"maxFileSize":"5242880",
						"fontSize":"7",			
						"timestamp":"false"
					}';
				echo  base64_encode($param);
			}	

			if($type=="W")
			{
				//"outputFile":"'.$documentName.'",
			    $param ='{
						"app":"pdf",
						"fileUploadUrl":"'.getParam('FILEUPLOADURL').'",
						"reason":"Soy el autor del documento",
						"type":"W",
						"clientId":"'.getParam('CLIENTID').'",
						"clientSecret":"'.getParam('CLIENTSECRET').'",
						"dcfilter":".*FIR.*|.*FAU.*",
						"fileDownloadUrl":"'.getParam('SERVER_PATH').'documents/sinFirma/'.$namePdf.'",
						"posx":"200",
						"posy":"500",
						"outputFile":"'.$documentName.'",
						"protocol":"T",
						"contentFile":"'.$namePdf.'",
						"stampAppearanceId":"0",
						"isSignatureVisible":"true",
						"idFile":"MyForm",
						"fileDownloadLogoUrl":"'.getParam('SERVER_PATH').'images/iLogo1.png",
						"fileDownloadStampUrl":"'.getParam('SERVER_PATH').'images/iFirma1.png",
						"pageNumber":"0",
						"maxFileSize":"5242880",
						"fontSize":"7",			
						"timestamp":"false"
					}';
				echo  base64_encode($param);
			}
			break;
		case 'getArguments':
			$name = $_REQUEST['name'];
			$name = explode('.', $name);
			$name = $name[0].'F.'.$name[1];
			echo $name;
			break;
		default:
			# code...
			break;
	}
?>