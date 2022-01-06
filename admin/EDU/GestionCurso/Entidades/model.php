<?php
    /*****************************************************************************
    TIPO            : PHP
    NOMBRE          : model.php
    AUTOR           : PGONZALESC
    FECHA CREACION  : 02/12/2020
    ID REQ          :
    MOTIVO          : Emisión de Constancias con Firma Digital
    *****************************************************************************/
    
    include '../../../../Entidades/variables_globales.php';
    include("../../../../conexion/connect.php");
    date_default_timezone_set('America/Lima');
    $opc = $_REQUEST['opc'];

    switch ($opc) {
        case 'lista_unidad_organica':
            $cod_tipo_unidad = $_REQUEST['cod_tipo_unidad']; //1->DPTO, 2->Escuela

            $query ="SELECT V.COD_UNIDAD_ORGANICA,
                            V.DES_UNIDAD_ORGANICA
                     FROM V_EDU_LISTA_UNIDAD_ORGANICA V
                     WHERE V.COD_TIPO_UNIDAD = '$cod_tipo_unidad'";

            $result=oci_parse($conn,$query);
            oci_execute($result,OCI_DEFAULT);

            $dato = array();
            while($data=oci_fetch_array($result,OCI_BOTH))
            { 
                $dato[]=$data;
            }
            echo json_encode(array('dato' => $dato));
            break;
        case 'lista_servicio':
            $cod_unidad = $_REQUEST['cod_unidad']; //1->DPTO, 2->Escuela

            $query ="SELECT V.COD_UNIDAD_ORGANICA,
                            V.COD_TIPO_UNIDAD,
                            V.COD_SERVICIO,
                            V.DES_SERVICIO
                     FROM V_EDU_LISTA_SERVICIO V
                     WHERE V.COD_UNIDAD_ORGANICA='$cod_unidad'";

            $result=oci_parse($conn,$query);
            oci_execute($result,OCI_DEFAULT);

            $dato = array();
            while($data=oci_fetch_array($result,OCI_BOTH))
            { 
                $dato[]=$data;
            }
            echo json_encode(array('dato' => $dato));
            break;
        case 'lista_curso':
            $cod_estado = $_REQUEST['cod_estado']; //1->Abierto, 2->Cerrado

            if(isset($_REQUEST['cod_curso']))
                $cod_curso = $_REQUEST['cod_curso'];
            else
                $cod_curso = '%';

            $query ="SELECT V.COD_CURSO,
                            V.COD_UNIDAD,
                            V.COD_TIPO_UNIDAD,
                            V.COD_TIPO_CURSO,
                            V.DES_NOMBRE_CURSO,
                            V.DES_UNIDAD_ORGANICA,
                            V.COD_SERVICIO,
                            V.DES_SERVICIO,
                            V.DES_MODALIDAD,
                            V.FEC_REALIZACION,
                            V.FEC_INICIO,
                            V.FEC_FIN,
                            V.FEC_EMISION,
                            V.IND_VISUALIZACION_HORAS,
                            V.NUM_TOTAL_HORAS,
                            V.COD_ENLACE_FECHA,
                            V.COD_TIPO_HORAS,
                            V.COD_TIPO_MODALIDAD,
                            V.IND_FIRMA,
                            V.DES_ENLACE_FECHA
                     FROM V_EDU_LISTA_CURSOS V
                     WHERE V.COD_ESTADO = '$cod_estado'
                     AND V.COD_CURSO LIKE '$cod_curso'";

            $result=oci_parse($conn,$query);
            oci_execute($result,OCI_DEFAULT);

            $dato = array();
            while($data=oci_fetch_array($result,OCI_BOTH))
            { 
                $dato[]=$data;
            }
            echo json_encode($dato);
            break;
        case 'lista_participante':
            $cod_curso = $_REQUEST['cod_curso']; //1->Abierto, 2->Cerrado

            if(isset($_REQUEST['cod_participante']))
                $cod_participante = $_REQUEST['cod_participante'];
            else
                $cod_participante = '%';

            $query ="SELECT ROWNUM AS NUM_ORDEN,
                            V.COD_CURSO,
                            V.COD_UNIDAD,
                            V.COD_TIPO_UNIDAD,
                            V.COD_PARTICIPANTE,
                            V.DES_NOMBRE_COMPLETO,
                            V.DES_NOMBRES,
                            V.DES_APE_PATERNO,
                            V.DES_APE_MATERNO,
                            V.COD_TIPO_PARTICIPANTE,
                            V.DES_TIPO_PARTICIPANTE,
                            V.COD_TIPO_DOCUMENTO,
                            V.DES_TIPO_DOCUMENTO,
                            V.DES_NUM_DOCUMENTO,
                            V.DES_TIPO_SEXO,
                            V.IND_ENVIO_CORREO,
                            V.DES_ENVIO_CORREO,
                            V.IND_CERTIFICADO,
                            V.IND_FIRMA_DIGITAL,
                            V.DES_FIRMA_DIGITAL,
                            V.DES_CORREO_ELECTRONICO,
                            V.NUM_SECUENCIA
                     FROM V_EDU_LISTA_PARTICIPANTE V
                     WHERE V.COD_CURSO = '$cod_curso'
                     AND V.COD_PARTICIPANTE LIKE '$cod_participante'
                     ORDER BY V.FEC_REGISTRO DESC";

            $result=oci_parse($conn,$query);
            oci_execute($result,OCI_DEFAULT);

            $dato = array();
            while($data=oci_fetch_array($result,OCI_RETURN_NULLS))
            { 
                $dato[]=$data;
            }
            echo json_encode($dato);
            break;
        case 'registro_servicio':
            $cod_unidad      = $_REQUEST["cod_unidad"];
            $cod_tipo_unidad = $_REQUEST["cod_tipo_unidad"];
            $des_servicio    = $_REQUEST["des_servicio"];
            $cod_usuario     = $_REQUEST["cod_usuario"];
            $ip_maquina      = ObtenerIP();

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_INSERT_SERVICIO(:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8); end;');

            oci_bind_by_name($stid, ':p1', $cod_unidad); //pvi_documento
            oci_bind_by_name($stid, ':p2', $cod_tipo_unidad); //pvi_documento
            oci_bind_by_name($stid, ':p3', $des_servicio); //pvi_documento
            oci_bind_by_name($stid, ':p4', $cod_usuario);      //pvi_documento
            oci_bind_by_name($stid, ':p5', $ip_maquina);       //pvi_documento

            oci_bind_by_name($stid, ':p6', $cod_servicio, 20);    //pdo_cod_error
            oci_bind_by_name($stid, ':p7', $cod_error, 40);    //pdo_cod_error
            oci_bind_by_name($stid, ':p8', $des_error, 100);   //pdo_des_error

            oci_execute($stid);

            echo json_encode(array('cod_servicio'=> $cod_servicio, 'cod_error'=> $cod_error, 'des_error'=> $des_error));
            oci_free_statement($stid);
            oci_close($conn);
            break;
        case 'registro_curso':
            $cod_tipo_unidad = $_REQUEST['rbt_organizador'];
            if($cod_tipo_unidad == '1') {
                $cod_unidad = $_REQUEST['slt_departamento'];

                if(isset($_REQUEST['cbx_servicio']))
                    $cod_unidad_det = $_REQUEST['slt_servicio'];
                else
                    $cod_unidad_det = '';
            }
            else if($cod_tipo_unidad == '2') {
                $cod_unidad = $_REQUEST['slt_escuela'];
                $cod_unidad_det = '';
            }

            $cod_tipo_curso = $_REQUEST['rbt_tipo_curso'];
            $des_nombre_curso = $_REQUEST['txt_nombre_curso'];

            $rbt_fec_duracion = $_REQUEST['rbt_fec_duracion'];

            if($rbt_fec_duracion == '1') { //Fecha Realización
                $fec_realizacion = explode('-', $_REQUEST['date_fec_realizacion']);
                $fec_realizacion = $fec_realizacion[2].'/'.$fec_realizacion[1].'/'.$fec_realizacion[0];
                $fec_inicio = '';
                $fec_fin = '';
            }
            else if($rbt_fec_duracion == '2') { //Fecha de Inicio y Fin
                $fec_inicio = explode('-', $_REQUEST['date_fec_ini']);
                $fec_inicio = $fec_inicio[2].'/'.$fec_inicio[1].'/'.$fec_inicio[0];
                $fec_fin = explode('-', $_REQUEST['date_fec_fin']);
                $fec_fin = $fec_fin[2].'/'.$fec_fin[1].'/'.$fec_fin[0];
                $fec_realizacion = '';
            }

            $fec_emision = explode('-', $_REQUEST['date_fec_emision']);
            $fec_emision = $fec_emision[2].'/'.$fec_emision[1].'/'.$fec_emision[0];

            if(isset($_REQUEST['cbx_ind_horas'])){
                $ind_visualizacion = '1';
                $total_horas = $_REQUEST['txt_horas'];
                $cod_tipo_horas = $_REQUEST['rb_tipo_horas'];
            }
            else {
                $ind_visualizacion = '0';
                $total_horas = '';
                $cod_tipo_horas = '';
            }
            $cod_enlace_fecha = $_REQUEST["slt_conector_fec"];
            $cod_tipo_modalidad = $_REQUEST['slt_modalidad'];
            $cod_usuario   = $_REQUEST["cod_usuario"];
            $ip_maquina    = ObtenerIP();

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_INSERT_CURSO_CAB(:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8, :p9, :p10, :p11, :p12, :p13, :p14, :p15, :p16, :p17, :p18); end;');

            oci_bind_by_name($stid, ':p1', $cod_unidad);          //pvi_cod_unidad (codigo del dpto o escuel)
            oci_bind_by_name($stid, ':p2', $cod_tipo_unidad);     //pvi_cod_tipo_unidad (1->dpto, 2->escuela)
            oci_bind_by_name($stid, ':p3', $cod_unidad_det);      //pvi_cod_unidad_det (codigo de servicio)
            oci_bind_by_name($stid, ':p4', $cod_tipo_curso);      //pvi_cod_tipo_curso (1->curso, 2->taller)
            oci_bind_by_name($stid, ':p5', $des_nombre_curso);    //pvi_des_nombre_curso (Nombre del curso/taller)
            oci_bind_by_name($stid, ':p6', $fec_realizacion);     //pvi_fec_realizacion
            oci_bind_by_name($stid, ':p7', $fec_inicio);          //pvi_fec_inicio
            oci_bind_by_name($stid, ':p8', $fec_fin);             //pvi_fec_fin
            oci_bind_by_name($stid, ':p9', $fec_emision);         //pvi_fec_emision
            oci_bind_by_name($stid, ':p10', $cod_enlace_fecha);   //pvi_cod_enlace_fecha
            oci_bind_by_name($stid, ':p11', $cod_tipo_modalidad); //pvi_cod_tipo_modalidad (1->Presencial, 2->Virtual)
            oci_bind_by_name($stid, ':p12', $total_horas);        //pvi_num_horas
            oci_bind_by_name($stid, ':p13', $cod_tipo_horas);     //pvi_cod_tipo_horas
            oci_bind_by_name($stid, ':p14', $ind_visualizacion);  //pvi_ind_visualizacion (1-> Con Visualizacion de Horas, 0-> Sin visualizacion de Horas)
            oci_bind_by_name($stid, ':p15', $cod_usuario);        //pvi_cod_usuario
            oci_bind_by_name($stid, ':p16', $ip_maquina);         //pvi_ip_maquina

            oci_bind_by_name($stid, ':p17', $cod_error, 40);      //pdo_cod_error
            oci_bind_by_name($stid, ':p18', $des_error, 100);     //pdo_des_error

            oci_execute($stid);

            echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error, 'cod_unidad'=>$cod_unidad, 'cod_tipo_unidad'=>$cod_tipo_unidad, 'cod_unidad_det'=>$cod_unidad_det, 'cod_tipo_curso'=>$cod_tipo_curso, 'des_nombre_curso'=>$des_nombre_curso, 'fec_realizacion'=>$fec_realizacion, 'fec_inicio'=>$fec_inicio, 'fec_fin'=>$fec_fin, 'cod_enlace_fecha' => $cod_enlace_fecha, 'cod_tipo_modalidad'=>$cod_tipo_modalidad, 'total_horas'=>$total_horas, 'cod_tipo_horas'=> $cod_tipo_horas, 'ind_visualizacion'=>$ind_visualizacion, 'cod_usuario'=>$cod_usuario, 'ip_maquina'=>$ip_maquina));
            oci_free_statement($stid);
            oci_close($conn);
            break;
        case 'modifica_curso':
            $cod_curso = $_REQUEST['edit_cod_curso'];
            $cod_tipo_unidad = $_REQUEST['edit_cod_tipo_unidad'];
            $cod_unidad = $_REQUEST['edit_cod_unidad'];
            $cod_tipo_curso = $_REQUEST['rbt_tipo_curso_edit'];
            $des_nombre_curso = $_REQUEST['txt_nombre_curso_edit'];

            $rbt_fec_duracion = $_REQUEST['rbt_fec_duracion_edit'];

            if($rbt_fec_duracion == '1') { //Fecha Realización
                $fec_realizacion = explode('-', $_REQUEST['date_fec_realizacion_edit']);
                $fec_realizacion = $fec_realizacion[2].'/'.$fec_realizacion[1].'/'.$fec_realizacion[0];
                $fec_inicio = '';
                $fec_fin = '';
            }
            else if($rbt_fec_duracion == '2') { //Fecha de Inicio y Fin
                $fec_inicio = explode('-', $_REQUEST['date_fec_ini_edit']);
                $fec_inicio = $fec_inicio[2].'/'.$fec_inicio[1].'/'.$fec_inicio[0];
                $fec_fin = explode('-', $_REQUEST['date_fec_fin_edit']);
                $fec_fin = $fec_fin[2].'/'.$fec_fin[1].'/'.$fec_fin[0];
                $fec_realizacion = '';
            }

            $fec_emision = explode('-', $_REQUEST['date_fec_emision_edit']);
            $fec_emision = $fec_emision[2].'/'.$fec_emision[1].'/'.$fec_emision[0];

            if(isset($_REQUEST['cbx_ind_horas_edit'])) {
                $ind_visualizacion = '1';
                $total_horas = $_REQUEST['txt_horas_edit'];
                $cod_tipo_horas = $_REQUEST['rb_tipo_horas_edit'];
            }
            else {
                $ind_visualizacion = '0';
                $total_horas = '';
                $cod_tipo_horas = '';
            }
            $cod_enlace_fecha = $_REQUEST['slt_conector_fec_edit'];
            $cod_tipo_modalidad = $_REQUEST['slt_modalidad_edit'];
            $cod_usuario   = $_REQUEST["cod_usuario_edit"];
            $ip_maquina    = ObtenerIP();

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_UPDATE_CURSO_CAB(:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8, :p9, :p10, :p11, :p12, :p13, :p14, :p15, :p16, :p17, :p18); end;');

            oci_bind_by_name($stid, ':p1', $cod_curso);           //pvi_cod_unidad (codigo del dpto o escuel)
            oci_bind_by_name($stid, ':p2', $cod_unidad);          //pvi_cod_unidad (codigo del dpto o escuel)
            oci_bind_by_name($stid, ':p3', $cod_tipo_unidad);     //pvi_cod_tipo_unidad (1->dpto, 2->escuela)
            oci_bind_by_name($stid, ':p4', $cod_tipo_curso);      //pvi_cod_tipo_curso (1->curso, 2->taller)
            oci_bind_by_name($stid, ':p5', $des_nombre_curso);    //pvi_des_nombre_curso (Nombre del curso/taller)
            oci_bind_by_name($stid, ':p6', $fec_realizacion);     //pvi_fec_realizacion
            oci_bind_by_name($stid, ':p7', $fec_inicio);          //pvi_fec_inicio
            oci_bind_by_name($stid, ':p8', $fec_fin);             //pvi_fec_fin
            oci_bind_by_name($stid, ':p9', $fec_emision);         //pvi_fec_emision
            oci_bind_by_name($stid, ':p10', $cod_enlace_fecha);    //pvi_cod_enlace_fecha
            oci_bind_by_name($stid, ':p11', $cod_tipo_modalidad); //pvi_cod_tipo_modalidad (1->Presencial, 2->Virtual)
            oci_bind_by_name($stid, ':p12', $total_horas);        //pvi_num_horas
            oci_bind_by_name($stid, ':p13', $cod_tipo_horas);     //pvi_cod_tipo_horas
            oci_bind_by_name($stid, ':p14', $ind_visualizacion);  //pvi_ind_visualizacion (1-> Con Visualizacion de Horas, 0-> Sin visualizacion de Horas)
            oci_bind_by_name($stid, ':p15', $cod_usuario);        //pvi_cod_usuario
            oci_bind_by_name($stid, ':p16', $ip_maquina);         //pvi_ip_maquina

            oci_bind_by_name($stid, ':p17', $cod_error, 40);      //pdo_cod_error
            oci_bind_by_name($stid, ':p18', $des_error, 100);     //pdo_des_error

            oci_execute($stid);

            echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error, 'cod_curso'=>$cod_curso, 'cod_unidad'=>$cod_unidad, 'cod_tipo_unidad'=>$cod_tipo_unidad, 'cod_tipo_curso'=>$cod_tipo_curso, 'des_nombre_curso'=>$des_nombre_curso, 'fec_realizacion'=>$fec_realizacion, 'fec_inicio'=>$fec_inicio, 'fec_fin'=>$fec_fin, 'cod_enlace_fecha'=> $cod_enlace_fecha, 'cod_tipo_modalidad'=>$cod_tipo_modalidad, 'total_horas'=>$total_horas, 'cod_tipo_horas'=> $cod_tipo_horas, 'ind_visualizacion'=>$ind_visualizacion, 'cod_usuario'=>$cod_usuario, 'ip_maquina'=>$ip_maquina));
            oci_free_statement($stid);
            oci_close($conn);
            break;
        case 'modifica_participante':
            $cod_curso             = $_REQUEST['cod_curso_edit'];
            $cod_unidad            = $_REQUEST['cod_unidad_edit'];
            $cod_tipo_unidad       = $_REQUEST['cod_tipo_unidad_edit'];
            $cod_participante      = $_REQUEST['cod_participante_edit'];
            $cod_tipo_participante = $_REQUEST['cod_tipo_edit'];
            $cod_tipo_documento    = $_REQUEST['cod_tipo_documento_edit'];
            $des_num_documento     = $_REQUEST['des_num_documento_edit'];
            $des_ape_paterno       = $_REQUEST['des_ape_paterno_edit'];
            $des_ape_materno       = $_REQUEST['des_ape_materno_edit'];
            $des_nombres           = $_REQUEST['des_nombres_edit'];
            $cod_tipo_sexo         = $_REQUEST['rbt_tipo_sexo_edit'];
            $des_correo            = $_REQUEST['des_correo_edit'];
            $cod_usuario           = $_REQUEST['cod_usuario_edit'];
            $ip_maquina            = ObtenerIP();
            
            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_UPDATE_PARTICIPANTE(:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8, :p9, :p10, :p11, :p12, :p13, :p14, :p15, :p16); end;');

            oci_bind_by_name($stid, ':p1',  $cod_curso);             //pvi_cod_curso
            oci_bind_by_name($stid, ':p2',  $cod_unidad);            //pvi_cod_unidad
            oci_bind_by_name($stid, ':p3',  $cod_tipo_unidad);       //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p4',  $cod_participante);      //pvi_cod_participante
            oci_bind_by_name($stid, ':p5',  $cod_tipo_participante); //pvi_cod_tipo_participante
            oci_bind_by_name($stid, ':p6',  $cod_tipo_documento);    //pvi_cod_tipo_documento
            oci_bind_by_name($stid, ':p7',  $des_num_documento);     //pvi_des_num_documento
            oci_bind_by_name($stid, ':p8',  $des_ape_paterno);       //pvi_des_ape_paterno
            oci_bind_by_name($stid, ':p9',  $des_ape_materno);       //pvi_des_ape_materno
            oci_bind_by_name($stid, ':p10', $des_nombres);           //pvi_des_nombres
            oci_bind_by_name($stid, ':p11', $cod_tipo_sexo);         //pvi_cod_tipo_sexo
            oci_bind_by_name($stid, ':p12', $des_correo);            //pvi_des_correo
            oci_bind_by_name($stid, ':p13', $cod_usuario);           //pvi_cod_usuario
            oci_bind_by_name($stid, ':p14', $ip_maquina);            //pvi_ip_maquina

            oci_bind_by_name($stid, ':p15', $cod_error, 40);         //pdo_cod_error
            oci_bind_by_name($stid, ':p16', $des_error, 100);        //pdo_des_error

            oci_execute($stid);

            echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error, 'cod_curso'=> $cod_curso, 'cod_unidad'=>$cod_unidad, 'cod_tipo_unidad'=>$cod_tipo_unidad, 'cod_participante'=> $cod_participante, 'cod_tipo_participante'=> $cod_tipo_participante,'cod_tipo_documento'=> $cod_tipo_documento, 'des_num_documento'=> $des_num_documento, 'des_ape_paterno'=> $des_ape_paterno, 'des_ape_materno'=>$des_ape_materno, 'des_nombres'=>$des_nombres, 'cod_tipo_sexo'=>$cod_tipo_sexo, 'des_correo'=>$des_correo, 'cod_usuario'=>$cod_usuario, 'ip_maquina'=>$ip_maquina));
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
                echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error, 'data'=> $datos_participante, 'opc'=> 'SP'));
            } else if($cod_error == '300') {
                if($cod_tipo_documento == '01') {
                    include "../../../../Entidades/nusoap.php";

                    $client = new nusoap_client(RENIEC_MINSA, true);
                    $param = array("strDNIAuto" => DNI_AUTORIZADO,"strDNICon" => $des_num_documento);
                    $result = $client->call('GetReniec', $param);
                    $simple = $client->responseData;
                    
                    $p = xml_parser_create();
                    xml_parse_into_struct($p, $simple, $vals, $index);
                    xml_parser_free($p);

                    $data = [['DES_APE_PATERNO' => $vals[5]["value"], 
                              'DES_APE_MATERNO' => $vals[6]["value"], 
                              'DES_NOMBRES'     => $vals[7]["value"],
                              'COD_TIPO_SEXO'   => $vals[21]["value"],
                              'DES_CORREO_ELECTRONICO' => '' ]];

                    $cod_error = $vals[4]["value"];

                    if(is_null($cod_error) or $cod_error==='')
                        echo json_encode(array('cod_error'=> '404', 'des_error'=>'NO HAY WEB SERVICE', 'data'=>'')); 
                    else
                        echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> 'OK', 'data'=>$data, 'opc'=> 'RENIEC')); //No es Paciente 
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
        case 'registro_participante':
            $cod_curso          = $_REQUEST['cod_curso'];
            $cod_unidad         = $_REQUEST['cod_unidad'];
            $cod_tipo_unidad    = $_REQUEST['cod_tipo_unidad'];
            $cod_tipo_documento = $_REQUEST['cod_tipo_documento'];
            $des_num_documento  = $_REQUEST['des_num_documento'];
            $des_ape_paterno    = $_REQUEST['des_ape_paterno'];
            $des_ape_materno    = $_REQUEST['des_ape_materno'];
            $des_nombres        = $_REQUEST['des_nombres'];
            $cod_tipo_sexo      = $_REQUEST['rbt_tipo_sexo'];
            $des_correo         = $_REQUEST['des_correo'];
            $cod_tipo           = $_REQUEST['cod_tipo'];
            $cod_usuario        = $_REQUEST["cod_usuario"];
            $ip_maquina         = ObtenerIP();

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_INSERT_PARTICIPANTE(:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8, :p9, :p10, :p11, :p12, :p13, :p14, :p15); end;');

            oci_bind_by_name($stid, ':p1', $cod_curso);        //pvi_cod_curso
            oci_bind_by_name($stid, ':p2', $cod_unidad);       //pvi_cod_unidad
            oci_bind_by_name($stid, ':p3', $cod_tipo_unidad);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p4', $cod_tipo_documento);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p5', $des_num_documento);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p6', $des_ape_paterno);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p7', $des_ape_materno);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p8', $des_nombres);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p9', $cod_tipo_sexo);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p10', $des_correo);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p11', $cod_tipo);  //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p12', $cod_usuario);      //pvi_cod_usuario
            oci_bind_by_name($stid, ':p13', $ip_maquina);       //pvi_ip_maquina

            oci_bind_by_name($stid, ':p14', $cod_error, 40);    //pdo_cod_error
            oci_bind_by_name($stid, ':p15', $des_error, 100);   //pdo_des_error

            oci_execute($stid);

            echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error));
            oci_free_statement($stid);
            oci_close($conn);
            break;
        case 'anular_participante':
            $cod_curso             = $_REQUEST["cod_curso"];
            $cod_unidad            = $_REQUEST["cod_unidad"];
            $cod_tipo_unidad       = $_REQUEST["cod_tipo_unidad"];
            $cod_participante      = $_REQUEST["cod_participante"];
            $cod_tipo_participante = $_REQUEST["cod_tipo_participante"];
            $cod_usuario           = $_REQUEST["cod_usuario"];
            $ip_maquina            = ObtenerIP();

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_ANULAR_PARTICIPANTE(:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8, :p9); end;');

            oci_bind_by_name($stid, ':p1', $cod_curso);             //pvi_cod_curso
            oci_bind_by_name($stid, ':p2', $cod_unidad);            //pvi_cod_unidad
            oci_bind_by_name($stid, ':p3', $cod_tipo_unidad);       //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p4', $cod_participante);      //pvi_cod_participante
            oci_bind_by_name($stid, ':p5', $cod_tipo_participante); //pvi_cod_tipo_participante
            oci_bind_by_name($stid, ':p6', $cod_usuario);           //pvi_cod_usuario
            oci_bind_by_name($stid, ':p7', $ip_maquina);            //pvi_ip_maquina

            oci_bind_by_name($stid, ':p8', $cod_error, 40);         //pdo_cod_error
            oci_bind_by_name($stid, ':p9', $des_error, 100);        //pdo_des_error

            oci_execute($stid);

            echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error));
            oci_free_statement($stid);
            oci_close($conn);
            break;
        case 'finalizar_curso':
            $cod_curso       = $_REQUEST["cod_curso"];
            $cod_unidad      = $_REQUEST["cod_unidad"];
            $cod_tipo_unidad = $_REQUEST["cod_tipo_unidad"];
            $cod_usuario     = $_REQUEST["cod_usuario"];
            $ip_maquina      = ObtenerIP();

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_FINALIZAR_CURSO(:p1, :p2, :p3, :p4, :p5, :p6, :p7); end;');

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
        case 'update_ind_firma_digital':
            $cod_curso             = $_REQUEST["cod_curso"];
            $cod_unidad            = $_REQUEST["cod_unidad"];
            $cod_tipo_unidad       = $_REQUEST["cod_tipo_unidad"];
            $cod_participante      = $_REQUEST["cod_participante"];
            $cod_tipo_participante = $_REQUEST["cod_tipo_participante"];
            $cod_usuario           = $_REQUEST["cod_usuario"];
            $ip_maquina            = ObtenerIP();

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_UPDATE_IND_FIRMA_DIGITAL(:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8, :p9); end;');

            oci_bind_by_name($stid, ':p1', $cod_curso);             //pvi_cod_curso
            oci_bind_by_name($stid, ':p2', $cod_unidad);            //pvi_cod_unidad
            oci_bind_by_name($stid, ':p3', $cod_tipo_unidad);       //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p4', $cod_participante);      //pvi_cod_participante
            oci_bind_by_name($stid, ':p5', $cod_tipo_participante); //pvi_cod_participante
            oci_bind_by_name($stid, ':p6', $cod_usuario);           //pvi_cod_usuario
            oci_bind_by_name($stid, ':p7', $ip_maquina);            //pvi_ip_maquina

            oci_bind_by_name($stid, ':p8', $cod_error, 40);         //pdo_cod_error
            oci_bind_by_name($stid, ':p9', $des_error, 100);        //pdo_des_error

            oci_execute($stid);

            echo json_encode(array('cod_error'=> $cod_error, 'des_error'=> $des_error));
            oci_free_statement($stid);
            oci_close($conn);
            break;
        case 'update_ind_envio_correo':
            $cod_curso             = $_REQUEST["cod_curso"];
            $cod_unidad            = $_REQUEST["cod_unidad"];
            $cod_tipo_unidad       = $_REQUEST["cod_tipo_unidad"];
            $cod_participante      = $_REQUEST["cod_participante"];
            $cod_tipo_participante = $_REQUEST["cod_tipo_participante"];
            $correo                = strtolower( $_REQUEST["correo"] );
            $correo_cc             = strtolower( implode(",",$_REQUEST["correo_cc"]) );
            $cod_usuario           = $_REQUEST["cod_usuario"];
            $ip_maquina            = ObtenerIP();

            $stid = oci_parse($conn, 'begin PKG_EDU_SGC.SP_UPDATE_IND_ENVIO_CORREO(:p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8, :p9, :p10, :p11); end;');

            oci_bind_by_name($stid, ':p1', $cod_curso);             //pvi_cod_curso
            oci_bind_by_name($stid, ':p2', $cod_unidad);            //pvi_cod_unidad
            oci_bind_by_name($stid, ':p3', $cod_tipo_unidad);       //pvi_cod_tipo_unidad
            oci_bind_by_name($stid, ':p4', $cod_participante);      //pvi_cod_participante
            oci_bind_by_name($stid, ':p5', $cod_tipo_participante); //pvi_cod_participante
            oci_bind_by_name($stid, ':p6', $correo);                //pvi_des_correo
            oci_bind_by_name($stid, ':p7', $correo_cc);             //pvi_des_correo_cc
            oci_bind_by_name($stid, ':p8', $cod_usuario);           //pvi_cod_usuario
            oci_bind_by_name($stid, ':p9', $ip_maquina);            //pvi_ip_maquina
            
            oci_bind_by_name($stid, ':p10', $cod_error, 40);        //pdo_cod_error
            oci_bind_by_name($stid, ':p11', $des_error, 100);       //pdo_des_error

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