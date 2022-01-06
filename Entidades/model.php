<?php
    /*****************************************************************************
    TIPO            : PHP
    NOMBRE          : model.php
    AUTOR           : PGONZALESC
    FECHA CREACION  : 02/12/2020
    ID REQ          :
    MOTIVO          : Emisión de Constancias con Firma Digital
    *****************************************************************************/

    include("../conexion/connect.php");

    date_default_timezone_set('America/Lima');
    $opc = $_REQUEST['opc'];

    switch ($opc) {
        case 'registro_servicio':
            $cod_unidad      = $_REQUEST["cod_unidad"];
            $cod_tipo_unidad = $_REQUEST["cod_tipo_unidad"];
            $des_servicio    = $_REQUEST["des_servicio"];
            $cod_usuario     = $_REQUEST["cod_usuario"];
            $ip_maquina      = ObtenerIP();

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_INSERT_SERVICIO(:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8); end;');

            oci_bind_by_name($stid, ':p1', $cod_unidad);       //pvi_cod_unidad
            oci_bind_by_name($stid, ':p2', $cod_tipo_unidad);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p3', $des_servicio);     //pvi_des_servicio
            oci_bind_by_name($stid, ':p4', $cod_usuario);      //pvi_cod_usuario
            oci_bind_by_name($stid, ':p5', $ip_maquina);       //pvi_ip_maquina

            oci_bind_by_name($stid, ':p6', $cod_servicio, 20); //pdo_cod_servicio
            oci_bind_by_name($stid, ':p7', $cod_error, 40);    //pdo_cod_error
            oci_bind_by_name($stid, ':p8', $des_error, 100);   //pdo_des_error

            oci_execute($stid);

            echo json_encode(array('cod_servicio'=> $cod_servicio, 'cod_error'=> $cod_error, 'des_error'=> $des_error));
            oci_free_statement($stid);
            oci_close($conn);
            break;
        case 'anular_curso':
            $cod_curso       = $_REQUEST["cod_curso"];
            $cod_unidad      = $_REQUEST["cod_unidad"];
            $cod_tipo_unidad = $_REQUEST["cod_tipo_unidad"];
            $cod_usuario     = $_REQUEST["cod_usuario"];
            $ip_maquina      = ObtenerIP();

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_ANULAR_CURSO(:p1, :p2, :p3, :p4, :p5, :p6, :p7); end;');

            oci_bind_by_name($stid, ':p1', $cod_curso);        //pvi_cod_curso
            oci_bind_by_name($stid, ':p2', $cod_unidad);       //pvi_cod_unidad
            oci_bind_by_name($stid, ':p3', $cod_tipo_unidad);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p4', $cod_usuario);      //pvi_cod_usuario
            oci_bind_by_name($stid, ':p5', $ip_maquina);       //pvi_ip_maquina

            oci_bind_by_name($stid, ':p6', $cod_error, 40);    //pdo_cod_error
            oci_bind_by_name($stid, ':p7', $des_error, 100);   //pdo_des_error

            oci_execute($stid);

            echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error));
            oci_free_statement($stid);
            oci_close($conn);
            break;
        case 'buscar_participante':
            $cod_tipo_documento     = $_REQUEST["cod_tipo_documento"];
            $des_num_documento      = $_REQUEST["des_num_documento"];

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_GET_PARTICIPANTE(:p1, :p2, :p3, :p4, :p5); end;');

            oci_bind_by_name($stid, ':p1', $cod_tipo_documento);        //pvi_cod_curso
            oci_bind_by_name($stid, ':p2', $des_num_documento);       //pvi_cod_unidad

            $cursor_data_participante = oci_new_cursor($conn);
            oci_bind_by_name($stid, ':p3', $cursor_data_participante,-1,OCI_B_CURSOR);    //pdo_datos_usuario
            oci_bind_by_name($stid, ':p4', $cod_error, 40);    //pdo_cod_error
            oci_bind_by_name($stid, ':p5', $des_error, 100);   //pdo_des_error

            oci_execute($stid);

            if($cod_error == '1'){
                oci_execute($cursor_data_participante);

                while($data=oci_fetch_array($cursor_data_participante,OCI_BOTH)) { 
                    $datos_participante[]=$data;
                }
                echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error, 'data'=> $datos_participante));
            } else if($cod_error == '300') {
                if($cod_tipo_documento == '01') {
                    include "nusoap.php";

                    $client = new nusoap_client(RENIEC_MINSA, true);
                    $param = array("strDNIAuto" => DNI_AUTORIZADO,"strDNICon" => $des_num_documento);
                    $result = $client->call('GetReniec', $param);
                    $simple = $client->responseData;
                    
                    $p = xml_parser_create();
                    xml_parse_into_struct($p, $simple, $vals, $index);
                    xml_parser_free($p);

                    $data = [ ['DES_APE_PATERNO' => $vals[5]["value"], 'DES_APE_MATERNO' => $vals[6]["value"], 'DES_NOMBRES' => $vals[7]["value"]] ];

                    $cod_error = $vals[4]["value"];

                    if(is_null($cod_error) or $cod_error==='')
                        echo json_encode(array('cod_error'=> '404', 'des_error'=>'NO HAY WEB SERVICE', 'data'=>'')); 
                    else
                        echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> 'OK', 'data'=>$data)); //No es Paciente 
                } else {
                    echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error, 'data'=> ''));
                }
            }
            else {
                echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error, 'data'=> ''));
            }
            
            oci_free_statement($stid);
            oci_close($conn);
            break;
        case 'update_ind_firma_digital':
            $cod_curso        = $_REQUEST["cod_curso"];
            $cod_unidad       = $_REQUEST["cod_unidad"];
            $cod_tipo_unidad  = $_REQUEST["cod_tipo_unidad"];
            $cod_participante = $_REQUEST["cod_participante"];
            $cod_usuario      = $_REQUEST["cod_usuario"];
            $ip_maquina       = ObtenerIP();

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_UPDATE_IND_FIRMA_DIGITAL(:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8); end;');

            oci_bind_by_name($stid, ':p1', $cod_curso);        //pvi_cod_curso
            oci_bind_by_name($stid, ':p2', $cod_unidad);       //pvi_cod_unidad
            oci_bind_by_name($stid, ':p3', $cod_tipo_unidad);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p4', $cod_participante); //pvi_cod_participante
            oci_bind_by_name($stid, ':p5', $cod_usuario);      //pvi_cod_usuario
            oci_bind_by_name($stid, ':p6', $ip_maquina);       //pvi_ip_maquina

            oci_bind_by_name($stid, ':p7', $cod_error, 40);    //pdo_cod_error
            oci_bind_by_name($stid, ':p8', $des_error, 100);   //pdo_des_error

            oci_execute($stid);

            echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error));
            oci_free_statement($stid);
            oci_close($conn);
            break;
        default:
            # code...
            break;
    }
?>