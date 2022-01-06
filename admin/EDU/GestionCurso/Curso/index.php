  <?php 
    $cod_curso  = $_REQUEST['cod_curso'];
    $cod_estado = $_REQUEST['cod_estado'];
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Datos Curso</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $url_base?>">Curso</a></li>
              <li class="breadcrumb-item active">Registro</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary">
              <div class="card-header bg-azul-inen">
                <h3 class="card-title"><span id="title_curso"></span></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body">
                <!-- Organizador -->
                <div class="form-group row ml-3 mr-3">
                  <div class="col pr-1 pl-1">
                    <label>Organizador</label>
                    <input type="text" class="form-control" name="des_organizador" id="des_organizador" disabled>
                  </div>
                </div>
                <!-- Servicio - Modalidad -->
                <div class="form-group row ml-3 mr-3">
                  <!-- Servicio -->
                  <div class="col-sm-6 pr-1 pl-1">
                    <label>Servicio</label>
                    <input type="text" class="form-control" name="des_servicio" id="des_servicio" disabled>
                  </div>
                  <!-- Modalidad -->
                  <div class="col-sm-6 pr-1 pl-1">
                    <label>Modalidad</label>
                    <input type="text" class="form-control" name="des_modalidad" id="des_modalidad" disabled>
                  </div>
                </div>
                <!-- Total Horas - Fecha de Realización - Fecha de Inicio -->
                <div class="form-group row ml-3 mr-3">
                  <!-- Total Horas -->
                  <div class="col-sm-3 pl-1 pr-1">
                    <label>Total Horas</label>
                    <input type="text" class="form-control" name="des_num_horas" id="des_num_horas" disabled>
                  </div>
                  <!-- Fecha de Realización -->
                  <div class="col-sm-3 pl-1 pr-1">
                    <label>Fecha de Realización</label>
                    <input type="text" class="form-control text-center" name="fec_realizacion" id="fec_realizacion" disabled>
                  </div>
                  <!-- Fecha de Inicio -->
                  <div class="col-sm-2 pl-1 pr-1">
                    <label>Fecha de Inicio</label>
                    <input type="text" class="form-control text-center" name="fec_inicio" id="fec_inicio" disabled>
                  </div>
                  <div class="col-sm-2 pl-1 pr-1 d-flex align-items-end">
                    <input type="text" class="form-control text-center" name="fec_enlace" id="fec_enlace" disabled>
                  </div>
                  <!-- Fecha de Fin -->
                  <div class="col-sm-2 pl-1 pr-1">
                    <label>Fecha de Fin</label>
                    <input type="text" class="form-control text-center" name="fec_fin" id="fec_fin" disabled>
                  </div>
                </div>

                <div class="d-flex flex-row ml-3">
                  <a class="btn btn-primary mr-3" href="" id="btn_new_curso">Agregar Participante<i class="fas fa-plus ml-2 mr-2"></i></a>
                  <a class="btn btn-danger mr-3" href="" id="btn_fin_curso">Finalizar Curso<i class="fas fa-plus ml-2 mr-2"></i></a>
                </div>

                <div class="card mb-0 pb-2">
                  <!-- CABECERA DE TABS -->
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs d-flex bd-highlight">
                      <li class="nav-item bd-highlight">
                        <a class="nav-item nav-link active" id="id_nav-tab-1" data-toggle="tab" href="#nav-tab-1" role="tab" aria-controls="nav-tab-1" aria-selected="true">Participantes</a>
                      </li>                  
                    </ul>
                  </div>
                  <!-- CUERPO DE LOS TABS -->
                  <div class="card-body">
                    <div class="tab-content" id="nav-tabContent">
                      <!-- TAB 1 -->
                      <div class="tab-pane fade show active" id="nav-tab-1" role="tabpanel" aria-labelledby="id_nav-tab-1">
                        <div class="mt-3 ml-3 mr-3">
                          <!-- TABLA -->
                          <div class="table-responsive">
                            <table id="tb_lista_participante" class="table table-striped table-bordered" width="100%">
                              <thead class="bg-azul-inen">
                                <tr>
                                  <th>Nº Constancia</th> <!-- Correlativo -->
                                  <th>Nombre</th>
                                  <th>Cod. Tipo Participante</th>
                                  <th>Tipo</th>
                                  <th>Nro Doc.</th>
                                  <th>Correo</th>
                                  <th>Firmado Digital</th>
                                  <th>Envío Correo</th>
                                  <th>Ind Correo</th>
                                  <th>Nombre Curso</th>
                                  <th>N° Constancia</th>
                                  <th>Enviar Correo</th>
                                  <th>Firmar Certificado</th>
                                  <th>Ver Certificado</th>
                                  <th>Editar</th>
                                  <th>Eliminar</th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>                   
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>

  <!---------------------------------------------------------  MODAL AGREGAR PARTICIPANTE ----------------------------------------------------------->
  <div class="modal-new-participante"> 
    <div class="container p-container">
      <form id="form_participante">
        <input type="hidden" name="cod_curso" id="cod_curso" value="<?php echo $cod_curso?>">
        <input type="hidden" name="cod_unidad" id="cod_unidad">
        <input type="hidden" name="cod_tipo_unidad" id="cod_tipo_unidad">
        <div class="form-group row">
          <label>Tipo Documento</label>
          <select class="form-control" name="cod_tipo_documento" id="cod_tipo_documento">
            <option value="" disabled>Seleccione</option>
            <option value="01" selected>DNI</option>
            <option value="05">C.E.</option>
            <option value="04">PASS</option>
          </select>
        </div>

        <div class="form-group row">
          <label>Nro Documento</label>
          <div class="input-group">
            <input type="text" class="form-control" name="des_num_documento" id="des_num_documento">
            <div class="input-group-append">
              <button class="btn btn-info" type="button" name="btn_buscar_participante" id="btn_buscar_participante"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>

        <div class="form-group row" id="div_des_nombre_completo">
          <label>Nombre</label>
          <input type="text" class="form-control" name="des_nombre_completo" id="des_nombre_completo" disabled>
        </div>

        <div class="form-group row d-none" id="div_des_ape_paterno">
          <label>Apellido Paterno</label>
          <input type="text" class="form-control" name="des_ape_paterno" id="des_ape_paterno">
        </div>

        <div class="form-group row d-none" id="div_des_ape_materno">
          <label>Apellido Materno</label>
          <input type="text" class="form-control" name="des_ape_materno" id="des_ape_materno">
        </div>

        <div class="form-group row d-none" id="div_des_nombres">
          <label>Nombres</label>
          <input type="text" class="form-control" name="des_nombres" id="des_nombres">
        </div>

        <div class="form-group row mb-0">
            <label class="">Sexo</label>
        </div>

        <div class="form-group row d-flex">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rbt_tipo_sexo" id="rbt_masculino" value="1" checked>
              <label class="form-check-label" for="rbt_curso"><b>Masculino</b></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rbt_tipo_sexo" id="rbt_femenino" value="2">
              <label class="form-check-label" for="rbt_taller"><b>Femenino</b></label>
            </div>
        </div>

        <div class="form-group row">
          <label>Correo</label>
          <input type="text" class="form-control" name="des_correo" id="des_correo">
        </div>

        <div class="form-group row">
          <label>Tipo</label>
          <select class="form-control" name="cod_tipo" id="cod_tipo">
            <option value="" disabled selected>Seleccione</option>
            <option value="1">Participante</option>
            <option value="2">Ponente</option>
            <option value="3">Organizador(a)</option>
            <option value="4">Moderador(a)</option>
          </select>
        </div>

        <input type="hidden" name="cod_usuario" id="cod_usuario" value="<?php echo $user?>">

        <div class="form-group row">
          <button class="btn btn-primary btn-block" name="btn_registro_participante" id="btn_registro_participante">AGREGAR PARTICIPANTE</button>
        </div>
      </form>
    </div>
  </div>

  <!---------------------------------------------------------  MODAL EDITAR PARTICIPANTE ----------------------------------------------------------->
  <div class="modal-edit-participante"> 
    <div class="container p-container">
      <form id="form_participante_edit">
        <input type="hidden" name="cod_curso_edit" id="cod_curso_edit">
        <input type="hidden" name="cod_unidad_edit" id="cod_unidad_edit">
        <input type="hidden" name="cod_tipo_unidad_edit" id="cod_tipo_unidad_edit">
        <input type="hidden" name="cod_participante_edit" id="cod_participante_edit">
        <div class="form-group row">
          <label>Tipo Documento</label>
          <select class="form-control" name="cod_tipo_documento_edit" id="cod_tipo_documento_edit">
            <option value="" disabled>Seleccione</option>
            <option value="01" selected>DNI</option>
            <option value="05">C.E.</option>
            <option value="04">PASS</option>
          </select>
        </div>

        <div class="form-group row" id="div_nro_documento_edit">
          <label>Nro Documento</label>
          <div class="input-group">
            <input type="text" class="form-control" name="des_num_documento_edit" id="des_num_documento_edit" disabled>
            <div class="input-group-append">
              <button class="btn btn-info" type="button" name="btn_buscar_participante_edit" id="btn_buscar_participante_edit" disabled><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>

        <div class="form-group row" id="div_des_nombre_completo_edit">
          <label>Nombre</label>
          <input type="text" class="form-control" name="des_nombre_completo_edit" id="des_nombre_completo_edit" disabled>
        </div>

        <div class="form-group row d-none" id="div_des_ape_paterno_edit">
          <label>Apellido Paterno</label>
          <input type="text" class="form-control" name="des_ape_paterno_edit" id="des_ape_paterno_edit">
        </div>

        <div class="form-group row d-none" id="div_des_ape_materno_edit">
          <label>Apellido Materno</label>
          <input type="text" class="form-control" name="des_ape_materno_edit" id="des_ape_materno_edit">
        </div>

        <div class="form-group row d-none" id="div_des_nombres_edit">
          <label>Nombres</label>
          <input type="text" class="form-control" name="des_nombres_edit" id="des_nombres_edit">
        </div>

        <div class="form-group row mb-0">
            <label class="">Sexo</label>
        </div>

        <div class="form-group row d-flex">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rbt_tipo_sexo_edit" id="rbt_masculino_edit" value="1" disabled>
              <label class="form-check-label" for="rbt_curso_edit"><b>Masculino</b></label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rbt_tipo_sexo_edit" id="rbt_femenino_edit" value="2" disabled>
              <label class="form-check-label" for="rbt_taller_edit"><b>Femenino</b></label>
            </div>
        </div>

        <div class="form-group row">
          <label>Correo</label>
          <input type="text" class="form-control" name="des_correo_edit" id="des_correo_edit">
        </div>

        <div class="form-group row">
          <label>Tipo</label>
          <select class="form-control" name="cod_tipo_edit" id="cod_tipo_edit">
            <option value="" disabled selected>Seleccione</option>
            <option value="1">Participante</option>
            <option value="2">Ponente</option>
            <option value="3">Organizador(a)</option>
            <option value="4">Moderador(a)</option>
          </select>
        </div>

        <input type="hidden" name="cod_usuario_edit" id="cod_usuario_edit" value="<?php echo $user?>">

        <div class="form-group row">
          <button class="btn btn-warning btn-block text-bold" name="btn_registro_participante_edit" id="btn_registro_participante_edit">EDITAR DATOS PARTICIPANTE</button>
        </div>
      </form>
    </div>
  </div>

  <!-- MODAL CORREO -->
  <div class="modal-correo">
    <div class="container p-container">
      <form id="form_correo">
        <div class="form-group row">
          <label>Para:</label>
          <input type="text" name="mail_participante" id="mail_participante" class="form-control" disabled>
        </div>
        <div class="form-group row">
          <div>
            <label class="mr-2">CC:</label>
            <button class="btn btn-info py-0 px-2" id="btn_add_mail_cc"><i class="fas fa-plus"></i></button>
            <button class="btn btn-danger py-0 px-2 d-none" id="btn_delete_mail_cc"><i class="fas fa-trash-alt"></i></button>
          </div> 
        </div>
        <div class="form-group row" id="div_add_mail">
        </div>
        <div class="form-group row">
          <button class="btn btn-primary" id="btn_registro_mail_cc"><i class='fas fa-envelope mr-2'></i>Enviar Correo</button>
        </div>
      </form>
    </div>
  </div>

  <a id="signedDocument" class="btn btn-default d-none" href="#" role="button">Ver último documento firmado</a>  
  <input type="hidden" id="argumentos" value=""/>
  <div id="addComponent"></div>
  <div class="d-none">
    <input type="text" name="pdfFirma" id="pdfFirma">
  </div>
  <?php include "layout/footer.php"?>
  <script type="text/javascript"src="https://dsp.reniec.gob.pe/refirma_invoker/resources/js/clientclickonce.js"></script>

  <script type="text/javascript">

  (function () {
    let table_participante;
    let global_cod_unidad;
    let global_cod_tipo_unidad;
    let global_cod_participante;
    let global_cod_tipo_participante;
    let cod_usuario = '<?php echo $user?>';
    let cod_curso = '<?php echo $cod_curso?>';
    let cod_estado = '<?php echo $cod_estado?>';
    let direccion = "EDU/GestionCurso";

    //<![CDATA[
    let documentName_ = null;
    //
    window.addEventListener('getArguments', function (e) {                
      type = e.detail;          
      if(type === 'W'){
        ObtieneArgumentosParaFirmaDesdeLaWeb(); // Llama a getArguments al terminar.
      }else if(type === 'L'){
          ObtieneArgumentosParaFirmaDesdeArchivoLocal(); // Llama a getArguments al terminar.
      }             
    });

    const getArguments = ()=> {  
      arg = document.getElementById("argumentos").value;        
      dispatchEventClient('sendArguments', arg);                                
    }
    
    window.addEventListener('invokerOk', function (e) { 
      type = e.detail;       
      if(type === 'W'){
        MiFuncionOkWeb(); 
        }else if(type === 'L'){
          MiFuncionOkLocal(); 
        } 
    });
    
    window.addEventListener('invokerCancel', function (e) {    
      MiFuncionCancel();  
    });

    //::LÓGICA DEL PROGRAMADOR::      
    const ObtieneArgumentosParaFirmaDesdeLaWeb = ()=> {
      document.getElementById("signedDocument").href="#";
      let namePdf = document.getElementById('pdfFirma').value;
      $.get(`<?php echo $url_base?>${direccion}/Entidades/firmaDigital.php?opc=getArguments&name=${namePdf}`, {}, function(data, status) {     
        documentName_ = data; 
        let parametros = ['W', documentName_, namePdf];
        //Obtiene argumentos
        $.post(`<?php echo $url_base?>${direccion}/Entidades/firmaDigital.php?opc=postArguments&parametro=${parametros}`, {
          type : "W",
          documentName : documentName_
        }, (data, status) => {         
          document.getElementById("argumentos").value = data;
          getArguments();
        });           
      });       
    }

    const ObtieneArgumentosParaFirmaDesdeArchivoLocal = ()=> {
      document.getElementById("signedDocument").href="#";
      let namePdf = document.getElementById('pdfFirma').value;
      $.get(`<?php echo $url_base?>${direccion}/Entidades/firmaDigital.php?opc=getArguments&name=${namePdf}`, {}, function(data, status) {     
        documentName_ = data;
        let parametros = ['L', documentName_, namePdf];
        //Obtiene argumentos
        $.post(`<?php echo $url_base?>${direccion}/Entidades/firmaDigital.php?opc=postArguments&parametro=${parametros}`, {
          type : "L",
          documentName : documentName_
        }, (data, status) => {
          document.getElementById("argumentos").value = data;
          getArguments();
        });
                        
      });
    }
    
    const MiFuncionOkWeb = ()=> {
      Swal.fire({
          position: 'center',
          type: 'success',
          title: 'Documento firmado desde una URL correctamente.',
          showConfirmButton: false,
          timer: 2000,
      }).then( () => {
        document.getElementById("signedDocument").href=`<?php echo $url_base?>${direccion}/Entidades/firmaDigital.php?opc=getFile&documentName=${documentName_}`;
        updateIndFirmaDigital(); 
      }); 
    }

    const MiFuncionOkLocal = ()=> {
      Swal.fire({
          position: 'center',
          type: 'success',
          title: 'Documento firmado desde la PC correctamente.',
          showConfirmButton: false,
          timer: 2000,
      }).then( () => {
        document.getElementById("signedDocument").href=`<?php echo $url_base?>${direccion}/Entidades/firmaDigital.php?opc=getFile&documentName=${documentName_}`;
        updateIndFirmaDigital(); 
      }); 
    }
    
    const MiFuncionCancel = ()=> {
      Swal.fire({
          position: 'center',
          type: 'info',
          title: 'El proceso de firma digital fue cancelado.',
          showConfirmButton: false,
          timer: 2000,
      }).then( () => {
          document.getElementById("signedDocument").href="#";
      });
    } 

    const getListaParticipante = () => {
      let url  = `${direccion}/Entidades/model.php?opc=lista_participante`;
      let data = {};
      data.cod_curso = cod_curso;
      
      $.ajax({
            method: 'POST',
            url: url,
            data: data,
            success: function(resp){
                let obj = JSON.parse(resp);
                let dataTabla = [];
                for(let i=0; i<obj.length; i++)
                {
                  dataTabla[i] = [obj[i].NUM_SECUENCIA,          //0 NUM_ORDEN
                                  obj[i].DES_NOMBRE_COMPLETO,    //1
                                  obj[i].COD_TIPO_PARTICIPANTE,  //2 INVISIBLE
                                  obj[i].DES_TIPO_PARTICIPANTE,  //3
                                  obj[i].DES_TIPO_DOCUMENTO+' - '+obj[i].DES_NUM_DOCUMENTO, //4
                                  obj[i].DES_CORREO_ELECTRONICO, //5
                                  obj[i].DES_FIRMA_DIGITAL,      //6 INVISIBLE
                                  obj[i].DES_ENVIO_CORREO,       //7 INVISIBLE                      
                                  obj[i].IND_ENVIO_CORREO,       //8 INVISIBLE
                                  title_curso.innerText,         //9 INVISIBLE
                                  obj[i].NUM_SECUENCIA,          //10 INVISIBLE
                                  obj[i].COD_CURSO,              //11 BOTÓN ENVIAR CORRE
                                  obj[i].COD_UNIDAD,             //12 BOTÓN FIRMAR CERTIFICADO
                                  obj[i].IND_FIRMA_DIGITAL,      //13 BOTÓN VER CERTIFICADO 
                                  obj[i].COD_TIPO_UNIDAD,        //14 BOTÓN EDITAR
                                  obj[i].COD_PARTICIPANTE        //15 BOTÓN ELIMINAR
                                 ];
                }

                let fec_curso;
                if(fec_realizacion.value != " "){
                  fec_curso = fec_realizacion.value;
                }
                else {
                  if(fec_inicio.value != " ")
                    fec_curso = fec_inicio.value;

                  if(fec_fin.value != " ")
                    fec_curso = fec_curso+" "+fec_enlace.value+" "+fec_fin.value;
                }
                const title = des_organizador.value+' '+fec_curso.replace(/\//g,".");
                getDataListaParticipante(dataTabla, title);
            }
      });
    }

    const getDataListaParticipante = (dataTabla, title) => {
        $("#tb_lista_participante").dataTable().fnDestroy();

        table_participante = $('#tb_lista_participante').DataTable( {
          "pageLength": 10,
          "searching": true,
          //"paging": true,
          "info":     true,
          "order": [[ 0, "desc" ]],
          language: {
              "decimal": "",
              "emptyTable": "No hay información",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ participantes",
              "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
              "infoFiltered": "(Filtrado de _MAX_ total registros)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Mostrar _MENU_ Registros",
              "loadingRecords": "Cargando...",
              "processing": "Procesando...",
              "search": "Buscar:",
              "zeroRecords": "Sin resultados encontrados",
              "paginate": {
                  "first": "Primero",
                  "last": "Ultimo",
                  "next": "Siguiente",
                  "previous": "Anterior"
              }
          },
          data: dataTabla,
          "columnDefs": [
            {
              "targets": [ 2,6,7,8,9,10 ],
              "visible": false,
              "searchable": false
            },
            { "className": "text-center",
              "targets": [0,2,3,4,5,11,12,13,14,15]
            },
            {
              "targets": -1,
              "data": null,
              "defaultContent": "<button class='btn btn-danger btn-curso-delete'><i class='fas fa-trash-alt'></i></button>" 
            },
            {
              "targets": -2,
              "data": null,
              "defaultContent": "<button class='btn btn-warning btn-participante-edit'><i class='fas fa-edit'></i></button>"
            },
            {
              "targets": -3,
              "data": null,
              "defaultContent": "<button class='btn btn-success btn-curso-certificado'><i class='fas fa-file-pdf'></i></button>" 
            },
            {
              "targets": -4,
              "data": null,
              "defaultContent": "<button class='btn btn-info btn-curso-firma'><i class='fas fa-file-signature'></i></button>"
            },
            {
              "targets": -5,
              "data": null,
              "defaultContent": "<button class='btn btn-primary btn-curso-mail'><i class='fas fa-envelope'></i></button>"  
            }
          ],
          dom: 'Bfrtip',
          buttons: [ {
              text: 'Exportar&nbsp;&nbsp;<img src="img/excel.png" width="25px">',
              extend: 'excelHtml5',
              autoFilter: true,
              sheetName: 'Reporte Participantes',
              title: title,
              className: 'btn btn-success white',
              exportOptions: {
                  columns: [1,3,4,5,6,7,9,10]
              }
          } ],
          "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {  
            if(aData[13] == '1') { // Con firma Digital - IND_FIRMA_DIGITAL
              $('button.btn-curso-firma', nRow).addClass("btn btn-dark");
              $('button.btn-curso-firma', nRow).prop('disabled', true);
              
              $('button.btn-curso-delete', nRow).addClass("btn btn-dark");
              $('button.btn-curso-delete', nRow).prop('disabled', true);

              $('button.btn-participante-edit', nRow).addClass("btn btn-dark");
              $('button.btn-participante-edit', nRow).prop('disabled', true);
            }
            else if(aData[13] == '0') { // No firmado
              $('button.btn-curso-mail', nRow).addClass("btn btn-dark");
              $('button.btn-curso-mail', nRow).prop('disabled', true);
            }

            if(aData[8] == '1') { //IND_ENVIO_CORREO
              // $('button.btn-evaluar', nRow).addClass("btn btn-outline-success");
              $('td', nRow).css('background-color', '#fcc6c5'); /*#FAA09F */
              $('td', nRow).css('color', 'black');
              //$('td', nRow).css('font-weight', 'bold');
            }
            else if(aData[8] == '0') {
              $('td', nRow).css('background-color', 'white');
            }
          }
        });
        //EDITAR PARTICIPANTE
        $('#tb_lista_participante tbody').on( 'click', 'button.btn-participante-edit', function() { 
          let data = table_participante.row( $(this).parents('tr') ).data();
          let cod_curso = data[11];
          let cod_participante = data[15];
          getDataParticipante(cod_curso, cod_participante);
        });
        // ELIMINAR PARTICIPANTE
        $('#tb_lista_participante tbody').on( 'click', 'button.btn-curso-delete', function() { 
          let data = table_participante.row( $(this).parents('tr') ).data();
          let nom_participante      = data[1];
          let cod_tipo_participante = data[2];
          let cod_unidad            = data[12];
          let cod_tipo_unidad       = data[14];
          let cod_participante      = data[15];

          Swal.fire({
              title: `¿Está seguro de eliminar al participante ${nom_participante}?`,
              text: "",
              type: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si',
              cancelButtonText: 'No'
            }).then((result) => {
                if (result.value) {
                  anularParticipante(cod_curso, cod_unidad, cod_tipo_unidad, cod_participante, cod_tipo_participante);
                }
            });
        });
        // VER CERTIFICADO
        $('#tb_lista_participante tbody').on( 'click', 'button.btn-curso-certificado', function() { 
          let data = table_participante.row( $(this).parents('tr') ).data();
          let cod_tipo_participante = data[2];
          let cod_unidad            = data[12];
          let ind_firma             = data[13];
          let cod_tipo_unidad       = data[14];
          let cod_participante      = data[15];
          
          if(ind_firma == '1')
            window.open(`<?php echo $url_base?>${direccion}/documents/conFirma/${cod_curso}${cod_participante}${cod_tipo_participante}F.pdf`, '_blank');
          else if(ind_firma == '0')
            $.redirect(`<?php echo $url_base?>${direccion}/PDF/index.php`, {'opc': '1', 'cod_curso': cod_curso, 'cod_unidad': cod_unidad, 'cod_tipo_unidad': cod_tipo_unidad, 'cod_participante': cod_participante, 'cod_tipo_participante': cod_tipo_participante}, 'POST', '_blank'); 
        });
        // FIRMAR CERTIFICADO
        $('#tb_lista_participante tbody').on( 'click', 'button.btn-curso-firma', function() { 
          let data = table_participante.row( $(this).parents('tr') ).data();
          let nom_participante = data[1];
          let cod_tipo_participante = data[2];
          let cod_unidad = data[12];
          let cod_tipo_unidad = data[14];
          let cod_participante = data[15];

          Swal.fire({
              title: `¿Está seguro de firmar el certificado de ${nom_participante}?`,
              text: "",
              type: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si',
              cancelButtonText: 'No'
          }).then((result) => {
              if (result.value) {
                firmarCertificado(cod_curso, cod_unidad, cod_tipo_unidad, cod_participante, cod_tipo_participante);
              }
          });
        });
        // ENVIAR CORREO
        $('#tb_lista_participante tbody').on( 'click', 'button.btn-curso-mail', function() { 
          let data = table_participante.row( $(this).parents('tr') ).data();
          let nom_participante      = data[1];
          let cod_tipo_participante = data[2];
          let correo                = data[5];
          let cod_participante      = data[15];
          
          let pdfDigital = cod_curso+cod_participante+cod_tipo_participante;
          let nom_curso = title_curso.innerHTML;
          global_cod_participante = cod_participante;
          global_cod_tipo_participante = cod_tipo_participante;
          const data_mail = {
            'nom_participante': nom_participante,
            'cod_participante': cod_participante,
            'cod_tipo_participante': cod_tipo_participante,
            'correo': correo,
            'pdf_digital': pdfDigital,
            'nom_curso': nom_curso,
          }
          init_modal('modal-correo','Enviar Correo', data_mail);
        });
    }

    const firmarCertificado = (cod_curso, cod_unidad, cod_tipo_unidad, cod_participante, cod_tipo_participante) => {
      let url  = `<?php echo $url_base?>${direccion}/PDF/index.php`;
      let data = {};
      global_cod_participante = cod_participante;
      global_cod_tipo_participante = cod_tipo_participante;

      data.cod_curso = cod_curso;
      data.cod_unidad = cod_unidad;
      data.cod_tipo_unidad = cod_tipo_unidad;
      data.cod_participante = cod_participante;
      data.cod_tipo_participante = cod_tipo_participante;
      data.opc = '2';

      $.ajax({
        method: 'POST',
        url: url,
        data: data,
        success: function(resp){
          document.getElementById("pdfFirma").value = resp+".pdf";
          initInvoker('W');    
        }
      });
    }

    const enviarCorreo = (correo, correo_cc, pdfDigital, nom_curso, nom_participante) => {
      let url  = `<?php echo $url_base?>${direccion}/Mail/index.php`;
      let data = {};
      data.mail = correo;
      data.mail_cc = correo_cc;
      data.pdfDigital = pdfDigital;
      data.nom_curso = nom_curso;
      data.nom_participante = nom_participante;
      $.ajax({
        method: 'POST',
        url: url,
        data: data,
        success: function(resp){
          if(resp) {
            updateEnvioCorreo(correo, correo_cc);
          }
          else
            Swal.fire("Aviso",obj.des_error, "info");
        }
      });
    }

    const updateIndFirmaDigital = () => {
      let url  = `${direccion}/Entidades/model.php?opc=update_ind_firma_digital`;
      let data = {};
      data.cod_curso             = cod_curso;
      data.cod_unidad            = global_cod_unidad;
      data.cod_tipo_unidad       = global_cod_tipo_unidad;
      data.cod_participante      = global_cod_participante;
      data.cod_tipo_participante = global_cod_tipo_participante;
      data.cod_usuario           = cod_usuario;
      $.ajax({
        method: 'POST',
        url: url,
        data: data,
        success: function(resp){
          console.log({resp});
          let obj = JSON.parse(resp);
          console.log('obj.dato: '+obj.dato);
          if(obj.cod_error == '1')
          {
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Se firmó el certificado',
                showConfirmButton: false,
                timer: 2000,
            }).then(function () { 
              location.reload();
            });
          }
          else
            Swal.fire("Aviso",obj.des_error, "info");
        }
      });
    }

    const updateEnvioCorreo = (correo, correo_cc) => {
      let url  = `${direccion}/Entidades/model.php?opc=update_ind_envio_correo`;
      let data = {};
      data.cod_curso             = cod_curso;
      data.cod_unidad            = global_cod_unidad;
      data.cod_tipo_unidad       = global_cod_tipo_unidad;
      data.cod_participante      = global_cod_participante;
      data.cod_tipo_participante = global_cod_tipo_participante;
      data.correo                = correo;
      data.correo_cc             = correo_cc;
      data.cod_usuario           = cod_usuario;

      $.ajax({
        method: 'POST',
        url: url,
        data: data,
        success: function(resp){
          //console.log({resp});
          let obj = JSON.parse(resp);
          if(obj.cod_error == '1')
          {
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Se envió el correo satisfactoriamente.',
                showConfirmButton: false,
                timer: 2000,
            }).then(function () { 
              location.reload();
            });
          }
          else
            Swal.fire("Aviso",obj.des_error, "info");
        }
      });
    }
    
    const anularParticipante = (cod_curso, cod_unidad, cod_tipo_unidad, cod_participante, cod_tipo_participante) => {
      let url  = `${direccion}/Entidades/model.php?opc=anular_participante`;
      let data = {};

      data.cod_curso             = cod_curso;
      data.cod_unidad            = cod_unidad;
      data.cod_tipo_unidad       = cod_tipo_unidad;
      data.cod_participante      = cod_participante;
      data.cod_tipo_participante = cod_tipo_participante;
      data.cod_usuario           = cod_usuario;

      $.ajax({
        method: 'POST',
        url: url,
        data: data,
        success: function(resp){
          console.log({resp});
          let obj = JSON.parse(resp);
          console.log('obj.dato: '+obj.dato);
          if(obj.cod_error == '1')
          {
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Se anuló al participante',
                showConfirmButton: false,
                timer: 2000,
            }).then(function () { 
              location.reload();
            });
          }
          else
            Swal.fire("Aviso",obj.des_error, "info");
        }
      });
    }

    const filtroServicio = (date) => {
        let data = {};
        const url = `${direccion}/Entidades/model.php?opc=filtro_list_estacion`;
        data.fec_reporte = date;

        $.ajax({
            method: 'POST',
            url: url,
            data: data,
            success: function(resp){

                let obj = JSON.parse(resp);
                let miSelect=document.getElementById("slt_servicio");
                miSelect.innerHTML = "<option value='' disabled>Seleccione</option><option value='%' selected>TODOS</option>";
                let html ="";
                for(let i=0; i < obj.length; i++)
                {
                    html = "<option value='"+obj[i].COD_SERVICIO+"'>"+obj[i].DES_SERVICIO+"</option>";
                    miSelect.innerHTML += html;
                }
                
            }
        });
    }

    const dataCurso = ()=>{
      let url  = `${direccion}/Entidades/model.php?opc=lista_curso`;
      let data = {};
      data.cod_curso = cod_curso;
      data.cod_estado = cod_estado;
      
      $.ajax({
            method: 'POST',
            url: url,
            data: data,
            success: function(resp){
                let obj = JSON.parse(resp);
                let dataTabla = [];
                title_curso.innerHTML  = obj[0].DES_NOMBRE_CURSO.toUpperCase();
                des_organizador.value  = obj[0].DES_UNIDAD_ORGANICA;
                des_servicio.value     = obj[0].DES_SERVICIO;
                des_modalidad.value    = obj[0].DES_MODALIDAD;
                des_num_horas.value    = obj[0].NUM_TOTAL_HORAS;
                fec_realizacion.value  = obj[0].FEC_REALIZACION;
                fec_inicio.value       = obj[0].FEC_INICIO;  
                fec_fin.value          = obj[0].FEC_FIN;
                global_cod_unidad      = obj[0].COD_UNIDAD;
                global_cod_tipo_unidad = obj[0].COD_TIPO_UNIDAD;
                if(obj[0].FEC_INICIO != ' ' && obj[0].FEC_FIN != ' '){
                  if( obj[0].DES_ENLACE_FECHA != undefined )
                    fec_enlace.value       = obj[0].DES_ENLACE_FECHA.toLowerCase();
                  else {
                    const day1 = new Date(obj[0].FEC_INICIO.split('/').reverse().join('-'));
                    const day2 = new Date(obj[0].FEC_FIN.split('/').reverse().join('-'));
                    const diff = (day2.getTime()-day1.getTime())/(1000*60*60*24) ;
                    if(diff <= 1) {
                      fec_enlace.value = 'y';
                    }else
                      fec_enlace.value = 'al';
                  }
                }
            }
      });
    }

    const getDataParticipante = (cod_curso, cod_participante) => {
      let url  = `${direccion}/Entidades/model.php?opc=lista_participante`;
      let data = {};
      data.cod_estado = '1';
      data.cod_curso = cod_curso;
      data.cod_participante = cod_participante;

      $.ajax({
            method: 'POST',
            url: url,
            data: data,
            success: function(resp){
              let obj = JSON.parse(resp);
              let dataTabla = {};
              
                dataTabla = { 'COD_CURSO' : obj[0].COD_CURSO, //0
                              'COD_UNIDAD' : obj[0].COD_UNIDAD, //1
                              'COD_TIPO_UNIDAD' : obj[0].COD_TIPO_UNIDAD, //2
                              'COD_PARTICIPANTE' : obj[0].COD_PARTICIPANTE, //3
                              'COD_TIPO_PARTICIPANTE' : obj[0].COD_TIPO_PARTICIPANTE,   //4
                              'COD_TIPO_DOCUMENTO': obj[0].COD_TIPO_DOCUMENTO,          //5
                              'DES_NUM_DOCUMENTO' : obj[0].DES_NUM_DOCUMENTO,           //6
                              'DES_NOMBRE_COMPLETO' : obj[0].DES_NOMBRE_COMPLETO,       //7
                              'DES_NOMBRES' : obj[0].DES_NOMBRES,                       //8
                              'DES_APE_PATERNO' : obj[0].DES_APE_PATERNO,               //9
                              'DES_APE_MATERNO' : obj[0].DES_APE_MATERNO,               //10
                              'DES_TIPO_SEXO' : obj[0].DES_TIPO_SEXO,                   //11
                              'DES_CORREO' : obj[0].DES_CORREO_ELECTRONICO,             //12
                            };
              init_modal('modal-edit-participante','Editar Participante', dataTabla);
            }
      });
    }

    const new_participante = () => {
      const cod_tipo_documento        = document.querySelector('#cod_tipo_documento');
      const des_num_documento         = document.querySelector('#des_num_documento');
      const des_nombre_completo       = document.querySelector('#des_nombre_completo');
      const des_ape_paterno           = document.querySelector('#des_ape_paterno');
      const des_ape_materno           = document.querySelector('#des_ape_materno');
      const des_nombres               = document.querySelector('#des_nombres');
      const rbt_tipo_sexo             = document.getElementsByName('rbt_tipo_sexo');
      const rbt_masculino             = document.querySelector('#rbt_masculino');
      const rbt_femenino              = document.querySelector('#rbt_femenino');
      const des_correo                = document.querySelector('#des_correo');
      const des_modalidad             = document.querySelector('#des_modalidad');
      const btn_buscar_participante   = document.querySelector('#btn_buscar_participante');
      const btn_registro_participante = document.querySelector('#btn_registro_participante');
      const form_participante         = document.querySelector('#form_participante');
      const hdn_cod_unidad            = document.querySelector('#cod_unidad');
      const hdn_cod_tipo_unidad       = document.querySelector('#cod_tipo_unidad');
      const div_des_nombre_completo   = document.querySelector('#div_des_nombre_completo');
      const div_des_ape_paterno       = document.querySelector('#div_des_ape_paterno');
      const div_des_ape_materno       = document.querySelector('#div_des_ape_materno');
      const div_des_nombres           = document.querySelector('#div_des_nombres');
      const cod_tipo                  = document.querySelector('#cod_tipo');

      hdn_cod_unidad.value = global_cod_unidad;
      hdn_cod_tipo_unidad.value = global_cod_tipo_unidad;

      div_des_ape_paterno.className = "form-group row d-none";
      div_des_ape_materno.className = "form-group row d-none";
      div_des_nombres.className = "form-group row d-none";
      div_des_nombre_completo.classList.remove('d-none');
      btn_buscar_participante.disabled = false;

      cod_tipo_documento.addEventListener('change', ()=>{
        if(cod_tipo_documento.value == '01') { //DNI
          div_des_ape_paterno.className = "form-group row d-none";
          div_des_ape_materno.className = "form-group row d-none";
          div_des_nombres.className = "form-group row d-none";
          div_des_nombre_completo.classList.remove('d-none');
          btn_buscar_participante.disabled = false;
          des_num_documento.value = "";
          des_nombre_completo.value = "";
          des_ape_paterno.value = "";
          des_ape_materno.value = "";
          des_nombres.value = "";
        } 
        else { //04->PASAPORTE 05->CE 
          div_des_ape_paterno.classList.remove('d-none');
          div_des_ape_materno.classList.remove('d-none');
          div_des_nombres.classList.remove('d-none');
          div_des_nombre_completo.className = "form-group row d-none";
          btn_buscar_participante.disabled = true;
          des_num_documento.value = "";
          des_nombre_completo.value = "";
          des_ape_paterno.value = "";
          des_ape_materno.value = "";
          des_nombres.value = "";
        }
      });

      btn_buscar_participante.addEventListener('click', (e)=>{
        e.preventDefault();
        buscarParticipante(cod_tipo_documento.value, des_num_documento.value);
      });

      btn_registro_participante.addEventListener('click', (e)=>{
        e.preventDefault();
        if(des_num_documento.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Nº de Documento", "info");
        }
        else if(des_nombres.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Nombre del Participante", "info");
        } 
        else if(des_ape_paterno.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Apellido Paterno del Participante", "info");
        }
        else if(des_ape_materno.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Apellido Materno del Participante", "info");
        }
        else if(des_correo.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Correo del Participante", "info");
        }
        else if(cod_tipo.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Tipo", "info");
        }
        else {
          Swal.fire({
              title: `¿Desea agregar a ${des_nombre_completo.value} al curso?`,
              text: "",
              type: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si',
              cancelButtonText: 'No'
          }).then((result) => {
              if (result.value) {
                registroParticipante(form_participante);
              }
          });
        }
      });
    }

    const edit_participante = param => {
      const cod_curso                 = document.querySelector('#cod_curso_edit');
      const cod_unidad                = document.querySelector('#cod_unidad_edit');
      const cod_tipo_unidad           = document.querySelector('#cod_tipo_unidad_edit');
      const cod_participante          = document.querySelector('#cod_participante_edit');
      const cod_tipo_documento        = document.querySelector('#cod_tipo_documento_edit');
      const des_num_documento         = document.querySelector('#des_num_documento_edit');
      const des_nombre_completo       = document.querySelector('#des_nombre_completo_edit');
      const des_ape_paterno           = document.querySelector('#des_ape_paterno_edit');
      const des_ape_materno           = document.querySelector('#des_ape_materno_edit');
      const des_nombres               = document.querySelector('#des_nombres_edit');
      const rbt_tipo_sexo             = document.getElementsByName('rbt_tipo_sexo_edit');
      const rbt_masculino             = document.querySelector('#rbt_masculino_edit');
      const rbt_femenino              = document.querySelector('#rbt_femenino_edit');
      const des_correo                = document.querySelector('#des_correo_edit');
      const des_modalidad             = document.querySelector('#des_modalidad_edit');
      const btn_buscar_participante   = document.querySelector('#btn_buscar_participante_edit');
      const btn_registro_participante = document.querySelector('#btn_registro_participante_edit');
      const form_participante         = document.querySelector('#form_participante_edit');
      const div_des_nombre_completo   = document.querySelector('#div_des_nombre_completo_edit');
      const div_des_ape_paterno       = document.querySelector('#div_des_ape_paterno_edit');
      const div_des_ape_materno       = document.querySelector('#div_des_ape_materno_edit');
      const div_des_nombres           = document.querySelector('#div_des_nombres_edit');
      const div_nro_documento         = document.querySelector('#div_nro_documento_edit');
      const cod_tipo                  = document.querySelector('#cod_tipo_edit');

      cod_curso.value           = param.COD_CURSO;
      cod_unidad.value          = param.COD_UNIDAD;
      cod_tipo_unidad.value     = param.COD_TIPO_UNIDAD;
      cod_participante.value    = param.COD_PARTICIPANTE;
      cod_tipo.value            = param.COD_TIPO_PARTICIPANTE;
      cod_tipo_documento.value  = param.COD_TIPO_DOCUMENTO;
      des_num_documento.value   = param.DES_NUM_DOCUMENTO;
      des_nombre_completo.value = param.DES_NOMBRE_COMPLETO;
      des_ape_paterno.value     = param.DES_APE_PATERNO;
      des_ape_materno.value     = param.DES_APE_MATERNO;
      des_nombres.value         = param.DES_NOMBRES;
      if(param.DES_TIPO_SEXO === 'M')
        rbt_tipo_sexo[0].checked = true;
      else if(param.DES_TIPO_SEXO === 'F')
        rbt_tipo_sexo[1].checked = true;
      des_correo.value = param.DES_CORREO;

      if(param.COD_TIPO_DOCUMENTO != '01'){
        des_num_documento.disabled = false;
        div_des_ape_paterno.classList.remove('d-none');
        div_des_ape_materno.classList.remove('d-none');
        div_des_nombres.classList.remove('d-none');
        div_des_nombre_completo.className = "form-group row d-none";
        rbt_masculino.disabled = false;
        rbt_femenino.disabled = false;
      }

      cod_tipo_documento.addEventListener('change', ()=>{
        if(cod_tipo_documento.value == '01') { //DNI
          div_des_ape_paterno.className = "form-group row d-none";
          div_des_ape_materno.className = "form-group row d-none";
          div_des_nombres.className = "form-group row d-none";
          div_des_nombre_completo.classList.remove('d-none');
          btn_buscar_participante.disabled = false;
          des_num_documento.value = "";
          des_nombre_completo.value = "";
          des_ape_paterno.value = "";
          des_ape_materno.value = "";
          des_nombres.value = "";
        } 
        else { //04->PASAPORTE 05->CE 
          div_des_ape_paterno.classList.remove('d-none');
          div_des_ape_materno.classList.remove('d-none');
          div_des_nombres.classList.remove('d-none');
          div_des_nombre_completo.className = "form-group row d-none";
          btn_buscar_participante.disabled = true;
          rbt_masculino.disabled = false;
          rbt_femenino.disabled = false;
          des_num_documento.disabled = false;
          des_num_documento.value = "";
          des_nombre_completo.value = "";
          des_ape_paterno.value = "";
          des_ape_materno.value = "";
          des_nombres.value = "";
        }
      });

      btn_buscar_participante.addEventListener('click', (e)=>{
        e.preventDefault();
        buscarParticipante(cod_tipo_documento.value, des_num_documento.value, '2');
      });

      btn_registro_participante.addEventListener('click', (e)=>{
        e.preventDefault();
        if(des_num_documento.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Nº de Documento", "info");
        }
        else if(des_nombres.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Nombre del Participante", "info");
        } 
        else if(des_ape_paterno.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Apellido Paterno del Participante", "info");
        }
        else if(des_ape_materno.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Apellido Materno del Participante", "info");
        }
        else if(des_correo.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Correo del Participante", "info");
        }
        else if(cod_tipo.value == '') {
          Swal.fire("Aviso", "Debe ingresar el Tipo", "info");
        }
        else {
          Swal.fire({
              title: `¿Desea modificar los datos de ${des_nombre_completo.value}?`,
              text: "",
              type: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si',
              cancelButtonText: 'No'
          }).then((result) => {
              if (result.value) {
                rbt_masculino.disabled = false;
                rbt_femenino.disabled = false;
                des_num_documento.disabled = false;
                modificaParticipante(form_participante);
              }
          });
        }
      });
    }

    const init_modal = (className, title, param=null) => {
      /////////////////////////////////////////////////////////// IZIMODAL ///////////////////////////////////////////////////////
      $('.'+className).iziModal('destroy');
      $('.'+className).iziModal();
      $('.'+className).iziModal('setHeader', true);
      $('.'+className).iziModal('setHeaderColor',  '#2e5294');
      $('.'+className).iziModal('setTitle', title);
      $('.'+className).iziModal('setTop', '4%'); 
      $('.'+className).iziModal('setWidth', '65%');
      $('.'+className).iziModal('setTransitionIn', 'fadeInDown'); // comingIn, bounceInDown, bounceInUp, fadeInDownfadeInUp, fadeInLeft, fadeInRight, flipInX
      $('.'+className).iziModal('setTransitionOut', 'fadeOutUp');
      // comingOut, bounceOutDown, bounceOutUp, fadeOutDown, fadeOutUp, , fadeOutLeft, fadeOutRight, flipOutX
      $('.'+className).iziModal('open');
      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      if(className == 'modal-new-participante') {
        new_participante();
      } else if(className == 'modal-edit-participante') {
        edit_participante(param);
      } else if(className == 'modal-correo') {
        mail_participante.value = param.correo;

        btn_add_mail_cc.addEventListener('click', event => {
          event.preventDefault();
          btn_delete_mail_cc.classList.remove('d-none');
          if (div_add_mail.hasChildNodes()) {
            const children = div_add_mail.childNodes;
            let number = 1;
            for (let i = 0; i < children.length; i++) {
              if(children[i].nodeName == 'INPUT') {
                number = parseInt(children[i].id.substring(8,9))+1;
              }
            }
            createElement('input', 'div_add_mail', `mail_cc_${number}`);
          }
          else {
            console.log('Error.NoHasChildNodes');
          }
        });

        btn_delete_mail_cc.addEventListener('click', event => {
          event.preventDefault();
          if (div_add_mail.hasChildNodes()) {
            const children = div_add_mail.childNodes;
            let number = 1;

            for (let i = 0; i < children.length; i++) {
              if(children[i].nodeName == 'INPUT') {
                number = parseInt(children[i].id.substring(8,9));
              }
            }
            if(number == 1) 
              btn_delete_mail_cc.classList.add('d-none');
              
            div_add_mail.removeChild(document.querySelector(`#mail_cc_${number}`));
          }
          else {
            console.log('Error.NoHasChildNodes');
          }
        });

        btn_registro_mail_cc.addEventListener('click', event => {
          event.preventDefault();
          let number;
          const correo_cc = [];
          if(div_add_mail.hasChildNodes()) {
            const children = div_add_mail.childNodes;
            for (let i = 0; i < children.length; i++) {
              if(children[i].nodeName == 'INPUT') {
                number = parseInt(children[i].id.substring(8,9));
                correo_cc[number-1] = document.querySelector(`#mail_cc_${number}`).value;
              }
            }
          }
          else {
            console.log('Error.NoHasChildNodes');
          }
          const validate = true;
          for(let i=0; i < form_correo.elements.length; i++) { //agrega a todo el formulario el validar
            let input = form_correo.elements[i];
            if(input.hidden == false && input.disabled == false && input.type != 'button' && input.required ==true) { 
              //valida que sea requido,no cuente los valores ocultos, desabled y inputs tipo boton  
              input.parentElement.classList.add("was-validated");
              if(input.value == '') {
                validate = false;
                input.focus();
              }
            }
          }

          if(validate) {
            Swal.fire({
              title: `¿Está seguro de enviar el certificado a ${param.nom_participante}?`,
              text: "",
              type: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si',
              cancelButtonText: 'No'
            }).then((result) => {
              if (result.value) {
                enviarCorreo(param.correo, correo_cc, param.pdf_digital, param.nom_curso, param.nom_participante);
              }
            });
          } 
        });

        $(document).on('closed', '.modal-correo', function (e) {
            let number;
            if(div_add_mail.hasChildNodes()) {
              const children = div_add_mail.childNodes;
              for (let i = 0; i < children.length; i++) {
                if(children[i].nodeName == 'INPUT') {
                  number = parseInt(children[i].id.substring(8,9));
                  div_add_mail.removeChild(document.querySelector(`#mail_cc_${number}`));
                }
              }
            }
            else {
              console.log('Error.NoHasChildNodes');
            }
        });
      }
    }

    const createElement = (type, elementParent, elementChild) => {
      const div = document.querySelector(`#${elementParent}`);
      const elementType = document.createElement(type);
      div.appendChild(elementType);
      elementType.type = 'text';
      elementType.className = "form-control mb-2";
      elementType.id = elementChild;
      elementType.name = elementChild;
      elementType.required = true;
    }

    const modificaParticipante = form => {
      let peticion = new XMLHttpRequest();
      peticion.open('post',  `${direccion}/Entidades/model.php?opc=modifica_participante`);
      peticion.send(new FormData(form));
      peticion.onload = function() {
          console.log(peticion.response);
          let obj = JSON.parse(peticion.response);
          console.table(obj);
          if(obj.cod_error == '1') {
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Se modificó los datos del participante al curso',
                showConfirmButton: false,
                timer: 2000,
            }).then(function () { 
              location.reload();
            });
          }
          else
            Swal.fire("Aviso",obj.des_error, "info");
      };
    }

    const registroParticipante = (form) => {
      let peticion = new XMLHttpRequest();
      peticion.open('post',  `${direccion}/Entidades/model.php?opc=registro_participante`);
      peticion.send(new FormData(form));
      peticion.onload = function() {
        let obj = JSON.parse(peticion.response);
        if(obj.cod_error == '1') {
          Swal.fire({
              position: 'center',
              type: 'success',
              title: 'Se agregó al participante al curso',
              showConfirmButton: false,
              timer: 2000,
          }).then(function () { 
            location.reload();
          });
        }
        else
          Swal.fire("Aviso",obj.des_error, "info");
      };
    }

    const buscarParticipante = (cod_tipo_documento, des_num_documento, accion='1')=>{ //accion: 1-> Nuevo, 2-> Editar
      let url  = `${direccion}/Entidades/model.php?opc=buscar_participante`;
      let data = {};
      data.cod_tipo_documento = cod_tipo_documento;
      data.des_num_documento  = des_num_documento;
      
      $.ajax({
            method: 'POST',
            url: url,
            data: data,
            success: function(resp){
              let obj = JSON.parse(resp);
              if(accion === '1') {
                document.querySelector('#des_nombre_completo').value = obj.data[0].DES_APE_PATERNO+' '+obj.data[0].DES_APE_MATERNO+' '+obj.data[0].DES_NOMBRES;
                document.querySelector('#des_ape_paterno').value     = obj.data[0].DES_APE_PATERNO;
                document.querySelector('#des_ape_materno').value     = obj.data[0].DES_APE_MATERNO;
                document.querySelector('#des_nombres').value         = obj.data[0].DES_NOMBRES;

                if(obj.data[0].COD_TIPO_SEXO == '1')
                  document.querySelector('#rbt_masculino').checked = true;
                else if(obj.data[0].COD_TIPO_SEXO == '2'){
                  document.querySelector('#rbt_femenino').checked = true;
                }
                if(obj.data[0].DES_CORREO_ELECTRONICO != null)
                  document.querySelector('#des_correo').value        = obj.data[0].DES_CORREO_ELECTRONICO;
              }
              else if(accion === '2') {
                document.querySelector('#des_nombre_completo_edit').value = obj.data[0].DES_APE_PATERNO+' '+obj.data[0].DES_APE_MATERNO+' '+obj.data[0].DES_NOMBRES;
                document.querySelector('#des_ape_paterno_edit').value     = obj.data[0].DES_APE_PATERNO;
                document.querySelector('#des_ape_materno_edit').value     = obj.data[0].DES_APE_MATERNO;
                document.querySelector('#des_nombres_edit').value         = obj.data[0].DES_NOMBRES;

                if(obj.data[0].COD_TIPO_SEXO == '1')
                  document.querySelector('#rbt_masculino_edit').checked = true;
                else if(obj.data[0].COD_TIPO_SEXO == '2'){
                  document.querySelector('#rbt_femenino_edit').checked = true;
                }
                if(obj.data[0].DES_CORREO_ELECTRONICO != null)
                  document.querySelector('#des_correo_edit').value        = obj.data[0].DES_CORREO_ELECTRONICO;
              }
            }
      });
    }

    const finalizarCurso = (cod_curso, cod_unidad, cod_tipo_unidad)=>{
      let url  = `${direccion}/Entidades/model.php?opc=finalizar_curso`;
      let data = {};
      data.cod_curso       = cod_curso;
      data.cod_unidad      = global_cod_unidad;
      data.cod_tipo_unidad = global_cod_tipo_unidad;
      data.cod_usuario     = cod_usuario;
      $.ajax({
        method: 'POST',
        url: url,
        data: data,
        success: function(resp){
          console.table(resp);
          let obj = JSON.parse(resp);
          if(obj.cod_error == '1')
          {
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Se finalizó el curso',
                showConfirmButton: false,
                timer: 2000,
            }).then(function () { 
              location.href = "<?php echo $url_base?>";
            });
          }
          else
            Swal.fire("Aviso",obj.des_error, "info");
        }
      });
    }

    window.onload = () => {
      $('.modal-new-participante').iziModal();
      $('.modal-edit-participante').iziModal();
      $('.modal-correo').iziModal();

      const btn_new_curso   = document.querySelector('#btn_new_curso');
      const btn_fin_curso   = document.querySelector('#btn_fin_curso');
      const des_organizador = document.querySelector('#des_organizador');
      const des_servicio    = document.querySelector('#des_servicio');
      const des_modalidad   = document.querySelector('#des_modalidad');
      const des_num_horas   = document.querySelector('#des_num_horas');
      const fec_realizacion = document.querySelector('#fec_realizacion');
      const fec_inicio      = document.querySelector('#fec_inicio');
      const fec_fin         = document.querySelector('#fec_fin');
      const title_curso     = document.querySelector('#title_curso');
      
      dataCurso();
      getListaParticipante();

      btn_new_curso.addEventListener('click', (e)=>{
        e.preventDefault();
        init_modal('modal-new-participante','Agregar Participante');
      });

      btn_fin_curso.addEventListener('click', (e)=>{
        e.preventDefault();
        Swal.fire({
            title: `¿Está seguro de finalizar el curso ${title_curso.innerHTML}?`,
            text: "",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
              if (result.value) {
                finalizarCurso(cod_curso, cod_unidad, cod_tipo_unidad);
              }
          });
      });
    }
  })();
</script>