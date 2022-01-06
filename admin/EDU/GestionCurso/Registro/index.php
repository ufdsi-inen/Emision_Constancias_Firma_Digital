
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Gestión de Cursos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $url_base?>">Inicio</a></li>
              <li class="breadcrumb-item active">Curso</li>
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
                <h3 class="card-title">Cursos</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group mt-3 ml-2 mr-2">
                  <!-- <a class="btn btn-primary" href="registroListaVerificacion.php">Nuevo Registro <i class="fas fa-plus ml-2"></i></a> -->
                  <a class="btn btn-primary" href="" id="btn_new_curso">Nuevo Curso<i class="fas fa-plus ml-2"></i></a>
                </div>
                <div class="card mb-0 pb-2">
                  <!-- CABECERA DE TABS -->
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs d-flex bd-highlight">
                      <li class="nav-item bd-highlight">
                        <a class="nav-item nav-link active" id="id_nav-tab-1" data-toggle="tab" href="#nav-tab-1" role="tab" aria-controls="nav-tab-1" aria-selected="true">Cursos Aperturados</a>
                      </li>
                      <li class="nav-item bd-highlight">
                        <a class="nav-item nav-link" id="id_nav-tab-2" data-toggle="tab" href="#nav-tab-2" role="tab" aria-controls="nav-tab-2" aria-selected="true">Cursos Finalizados</a>
                      </li>                     
                    </ul>
                  </div>
                  <!-- CUERPO DE LOS TABS -->
                  <div class="card-body">
                    <div class="tab-content" id="nav-tabContent">
                      <!-- TAB 1  - CURSOS EN PROCESO-->
                      <div class="tab-pane fade show active" id="nav-tab-1" role="tabpanel" aria-labelledby="id_nav-tab-1">
                        <div class="mt-3 ml-3 mr-3">
                          <!-- TABLA -->
                          <div class="table-responsive">
                            <table id="tb_lista_curso_aperturado" class="table table-striped table-bordered" width="100%">
                              <thead class="bg-azul-inen">
                                <tr>
                                  <th>N°</th>
                                  <th>Curso</th>
                                  <th>Escuela/Dpto</th>
                                  <th>Modalidad</th>
                                  <th>Indicador</th>
                                  <th>Cod Curso</th>
                                  <th>Ver</th>
                                  <th>Editar</th>
                                  <th>Eliminar</th>
                                </tr>
                              </thead>
                            </table>
                          </div>
                        </div>                   
                      </div>
                      <!-- TAB 2 - CURSOS CERRADOS -->
                      <div class="tab-pane fade" id="nav-tab-2" role="tabpanel" aria-labelledby="id_nav-tab-2">
                        <div class="mt-3 ml-3 mr-3">
                          <!-- TABLA -->
                          <div class="table-responsive">
                            <table id="tb_lista_curso_cerrado" class="table table-striped table-bordered" width="100%">
                              <thead class="bg-azul-inen">
                                <tr>
                                  <th>N°</th>
                                  <th>Curso</th>
                                  <th>Escuela/Dpto</th>
                                  <th>Servicio</th>
                                  <th>Modalidad</th>
                                  <th>Tipo Unidad</th>
                                  <th>Cod Unidad</th>
                                  <th>Ver</th>
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

  <!---------------------------------------------------------  MODAL NUEVO CURSO ----------------------------------------------------------->
  <div class="modal-new-curso"> 
    <div class="container p-container">
      <form id="form_curso">
        <!-- Organizado por -->
        <div class="form group row mb-3">
          <div class="d-flex flex-column">
            <label>Organizado por</label>
            <div class="d-flex">
              <!-- Departamento -->
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rbt_organizador" id="rbt_departamento" value="1">
                <label class="form-check-label" for="rbt_departamento">Departamento</label>
              </div>
              <!-- Escuela -->
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rbt_organizador" id="rbt_escuela" value="2">
                <label class="form-check-label" for="rbt_escuela">Escuela</label>
              </div>
            </div>
          </div>
        </div>
        <!-- DEPARTAMENTO -->
        <div class="d-none" id="div_departamento">
          <!-- Departamento -->
          <div class="form-group row">
            <label>Departamento</label>
            <select class="form-control" id="slt_departamento" name="slt_departamento">
            </select>
          </div>
          <!-- Servicio -->
          <div class="form-group row mb-3">
            <div class="form-check"> <!-- form-check-inline -->
              <input type="checkbox" class="form-check-input" name="cbx_servicio" id="cbx_servicio">
              <label class="form-check-label" style="margin-bottom: 8px;"><b>Servicio</b></label>
            </div>
            <div class="input-group">
              <select class="form-control" id="slt_servicio" name="slt_servicio" disabled>
                <option value="" selected disabled>Seleccione</option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-primary" id="btn_add_servicio"><i class="fas fa-plus"></i></button>
              </div>
            </div>
          </div>
          <!-- Nuevo Servicio -->
          <div class="form-group row d-none" id="div_new_servicio">
            <div class="input-group">
              <input type="text" class="form-control" id="txt_new_servicio" name="txt_new_servicio" placeholder="Ingrese Servicio" autocomplete="off">
              <div class="input-group-append">
                <button class="btn btn-primary" id="btn_registro_servicio">Agregar</button>
              </div>
            </div>
          </div>
        </div>
        <!-- ESCUELA -->
        <div class="d-none" id="div_escuela">
          <div class="form-group row">
            <label>Escuela</label>
            <select class="form-control" id="slt_escuela" name="slt_escuela">
            </select>
          </div>
        </div>
        <!-- NOMBRE CURSO / TALLER -->
        <div class="form-group row d-flex">
          <div class="col-sm-2 pl-0">
            <!-- Curso -->
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rbt_tipo_curso" id="rbt_curso" value="1" checked>
              <label class="form-check-label" for="rbt_curso"><b>Curso</b></label>
            </div>
            <!-- Taller -->
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rbt_tipo_curso" id="rbt_taller" value="2">
              <label class="form-check-label" for="rbt_taller"><b>Taller</b></label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="form-group">
              <input type="text" name="txt_nombre_curso" id="txt_nombre_curso" class="form-control" placeholder="Ingrese el nombre del Curso">
            </div>
          </div>
        </div>
        <!-- FECHA REALIZACION - INICIO Y FIN -->
        <div class="form-group row">
          <!-- Fecha de Realización -->
          <div class="col-sm-6 col-xs-12 pl-0">
            <input type="radio" class="form-check-input ml-1" name="rbt_fec_duracion" id="rbt_fec_realizacion" value="1">
            <label class="ml-4">Fecha de Realización</label>
            <input type="date" name="date_fec_realizacion" id="date_fec_realizacion" class="form-control text-center" value="<?php echo date('Y-m-d')?>" disabled>
          </div>
          <!-- Fecha de Inicio y Fin -->
          <div class="col-sm-6 col-xs-12">
            <!-- <input type="checkbox" class="form-check-input ml-1" name="cbx_fec_ini_fin" id="cbx_fec_ini_fin"> -->
            <input type="radio" class="form-check-input ml-1" name="rbt_fec_duracion" id="rbt_fec_ini_fin" value="2">
            <label class="ml-4">Fecha de Inicio y Fin</label>
            <div class="d-flex flex-row">
              <div class="col-sm-5 col-xs-12">
                <input type="date" class="form-control mr-1 text-center" name="date_fec_ini" id="date_fec_ini" value="<?php echo date('Y-m-d')?>" disabled>
              </div>
              <div class="col-sm-2 col-xs-12">
                <select class="form-control" id="slt_conector_fec" name="slt_conector_fec" disabled>
                  <option value="" disabled>Seleccione</option>
                  <option value="01" selected>al</option>
                  <option value="02">y</option>
                </select>
              </div>
              <div class="col-sm-5 col-xs-12">
                <input type="date" class="form-control ml-1 text-center" name="date_fec_fin" id="date_fec_fin" value="<?php echo date('Y-m-d')?>" disabled>
              </div>
            </div>
          </div>
        </div>
        <!-- FECHA EMISION - TOTAL DE HORAS -->
        <div class="form-group row">
          <div class="col-sm-6 col-xs-12 pl-0" style="padding-right: 7.5px;">
            <label class="">Fecha Emisión</label>
            <input type="date" class="form-control mr-1 text-center" name="date_fec_emision" id="date_fec_emision" value="<?php echo date('Y-m-d')?>">
          </div>

          <div class="col-sm-6 col-xs-12 pr-3 pl-3">
            <input type="checkbox" class="form-check-input ml-1" name="cbx_ind_horas" id="cbx_ind_horas">
            <label class="ml-4">Total Horas</label>
            <div class="row">
              <div class="col">
                <input type="number" class="form-control text-center" id="txt_horas" name="txt_horas" value="" disabled>
              </div>
              <div class="col">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="rb_tipo_horas" id="rb_tipo_horas_1" value="01" disabled checked>
                  <label class="form-check-label" for="rb_tipo_horas_1"><b>Pedagógicas</b></label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="rb_tipo_horas" id="rb_tipo_horas_2" value="02" disabled>
                  <label class="form-check-label" for="rb_tipo_horas_2"><b>Cronológicas</b></label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- MODALIDAD -->
        <div class="form-group row">
          <label>Modalidad</label>
          <select class="form-control" id="slt_modalidad" name="slt_modalidad">
            <option value="" disabled selected>Seleccione</option>
            <option value="1">Presencial</option>
            <option value="2">Virtual</option>
          </select>
        </div>
        <div class="form-group row d-none">
          <input type="hidden" name="cod_usuario" id="cod_usuario" value="<?php echo $user?>">
        </div>
        <div class="form-group row">
          <button class="btn btn-primary btn-block" id="btn_registro_curso">AGREGAR CURSO</button>
        </div>
      </form>
    </div>
  </div>

  <!---------------------------------------------------------  MODAL EDITAR DATOS CURSO----------------------------------------------------------->
  <div class="modal-edit-curso"> 
    <div class="container p-container">
      <form id="form_curso_edit">
        <!-- Organizado por -->
        <div class="form group row mb-3">
          <div class="d-flex flex-column">
            <label>Organizado por</label>
            <div class="d-flex">
              <!-- Departamento -->
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rbt_organizador_edit" id="rbt_departamento_edit" value="1">
                <label class="form-check-label" for="rbt_departamento_edit">Departamento</label>
              </div>
              <!-- Escuela -->
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="rbt_organizador_edit" id="rbt_escuela_edit" value="2">
                <label class="form-check-label" for="rbt_escuela_edit">Escuela</label>
              </div>
            </div>
          </div>
        </div>

        <!-- CAMPOS OCULTOS -->
        <div class="d-none">
          <div class="form-group">
            <label>Cod Curso</label>
            <input type="text" name="edit_cod_curso" id="edit_cod_curso">
          </div>
          <div class="form-group">
            <label>Cod Unidad</label>
            <input type="text" name="edit_cod_unidad" id="edit_cod_unidad">
          </div>
          <div class="form-group">
            <label>Cod Tipo Unidad</label>
            <input type="text" name="edit_cod_tipo_unidad" id="edit_cod_tipo_unidad">
          </div>
        </div>
        
        <!-- DEPARTAMENTO -->
        <div id="div_departamento_edit">
          <!-- Departamento -->
          <div class="form-group row">
            <label>Departamento</label>
            <select class="form-control" id="slt_departamento_edit" name="slt_departamento_edit">
            </select>
          </div>
          <!-- Servicio -->
          <div class="form-group row mb-3">
            <div class="form-check"> <!-- form-check-inline -->
              <input type="checkbox" class="form-check-input" name="cbx_servicio_edit" id="cbx_servicio_edit">
              <label class="form-check-label" style="margin-bottom: 8px;"><b>Servicio</b></label>
            </div>
            <div class="input-group">
              <select class="form-control" id="slt_servicio_edit" name="slt_servicio_edit" disabled>
                <option value="" selected disabled>Seleccione</option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-primary" id="btn_add_servicio_edit"><i class="fas fa-plus"></i></button>
              </div>
            </div>
          </div>
          <!-- Nuevo Servicio -->
          <div class="form-group row d-none" id="div_new_servicio_edit">
            <div class="input-group">
              <input type="text" class="form-control" id="txt_new_servicio_edit" name="txt_new_servicio_edit" placeholder="Ingrese Servicio" autocomplete="off">
              <div class="input-group-append">
                <button class="btn btn-primary" id="btn_registro_servicio_edit">Agregar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- ESCUELA -->
        <div class="" id="div_escuela_edit">
          <div class="form-group row">
            <label>Escuela</label>
            <select class="form-control" id="slt_escuela_edit" name="slt_escuela_edit">
            </select>
          </div>
        </div>

        <!-- NOMBRE CURSO / TALLER -->
        <div class="form-group row d-flex">
          <div class="col-sm-2 pl-0">
            <!-- Curso -->
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rbt_tipo_curso_edit" id="rbt_curso_edit" value="1" checked>
              <label class="form-check-label" for="rbt_curso_edit"><b>Curso</b></label>
            </div>
            <!-- Taller -->
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="rbt_tipo_curso_edit" id="rbt_taller_edit" value="2">
              <label class="form-check-label" for="rbt_taller_edit"><b>Taller</b></label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="form-group">
              <input type="text" name="txt_nombre_curso_edit" id="txt_nombre_curso_edit" class="form-control" placeholder="Ingrese el nombre del Curso">
            </div>
          </div>
        </div>
        
        <!-- FECHA REALIZACION - INICIO Y FIN -->
        <div class="form-group row">
          <!-- Fecha de Realización -->
          <div class="col-sm-6 col-xs-12 pl-0">
            <input type="radio" class="form-check-input ml-1" name="rbt_fec_duracion_edit" id="rbt_fec_realizacion_edit" value="1">
            <label class="ml-4">Fecha de Realización</label>
            <input type="date" name="date_fec_realizacion_edit" id="date_fec_realizacion_edit" class="form-control text-center" value="<?php echo date('Y-m-d')?>" disabled>
          </div>
          <!-- Fecha de Inicio y Fin -->
          <div class="col-sm-6 col-xs-12">
            <!-- <input type="checkbox" class="form-check-input ml-1" name="cbx_fec_ini_fin" id="cbx_fec_ini_fin"> -->
            <input type="radio" class="form-check-input ml-1" name="rbt_fec_duracion_edit" id="rbt_fec_ini_fin_edit" value="2">
            <label class="ml-4">Fecha de Inicio y Fin</label>
            <div class="d-flex flex-row">
              <div class="col-sm-5 col-xs-12">
                <input type="date" class="form-control mr-1 text-center" name="date_fec_ini_edit" id="date_fec_ini_edit" value="<?php echo date('Y-m-d')?>" disabled>
              </div>
              <div class="col-sm-2 col-xs-12">
                <select class="form-control" id="slt_conector_fec_edit" name="slt_conector_fec_edit" disabled>
                  <option value="" disabled>Seleccione</option>
                  <option value="01" selected>al</option>
                  <option value="02">y</option>
                </select>
              </div>
              <div class="col-sm-5 col-xs-12">
                <input type="date" class="form-control ml-1 text-center" name="date_fec_fin_edit" id="date_fec_fin_edit" value="<?php echo date('Y-m-d')?>" disabled>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6 col-xs-12 pl-0" style="padding-right: 7.5px;">
            <label class="">Fecha Emisión</label>
            <input type="date" class="form-control mr-1 text-center" name="date_fec_emision_edit" id="date_fec_emision_edit" value="<?php echo date('Y-m-d')?>">
          </div>

          <div class="col-sm-6 col-xs-12 pr-3 pl-3">
              <input type="checkbox" class="form-check-input ml-1" name="cbx_ind_horas_edit" id="cbx_ind_horas_edit">
              <label class="ml-4">Total Horas</label>
              <div class="row">
                <div class="col">
                  <input type="number" class="form-control text-center" id="txt_horas_edit" name="txt_horas_edit" value="" disabled>
                </div>
                <div class="col">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rb_tipo_horas_edit" id="rb_tipo_horas_edit_1" value="01" disabled>
                    <label class="form-check-label" for="rb_tipo_horas_edit_1"><b>Pedagógicas</b></label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rb_tipo_horas_edit" id="rb_tipo_horas_edit_2" value="02" disabled>
                    <label class="form-check-label" for="rb_tipo_horas_edit_2"><b>Cronológicas</b></label>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- MODALIDAD -->
        <div class="form-group row">
          <label>Modalidad</label>
          <select class="form-control" id="slt_modalidad_edit" name="slt_modalidad_edit">
            <option value="" disabled selected>Seleccione</option>
            <option value="1">Presencial</option>
            <option value="2">Virtual</option>
          </select>
        </div>
        <div class="form-group row d-none">
          <input type="hidden" name="cod_usuario_edit" id="cod_usuario_edit" value="<?php echo $user?>">
        </div>
        <div class="form-group row">
          <button class="btn btn-warning btn-block text-bold" id="btn_edit_curso">EDITAR DATOS CURSO</button>
        </div>
      </form>
    </div>
  </div>

  <?php include "layout/footer.php"?>

  <script type="text/javascript">

  (function () {
    let table_curso_aperturado;
    let table_curso_cerrado;
    const cod_usuario = "<?php echo $user?>";
    let direccion = "EDU/GestionCurso";

    $(document).on('closed', '.modal-new-curso', function (e) { //Evento cuando se cierra el modal   '#modal-ver-componente'
      div_departamento.className = "d-none";
      div_escuela.className = "d-none";
      slt_escuela.value = '';
      slt_servicio.value = '';
      slt_servicio.disabled = true;
      btn_add_servicio.disabled = true;
    });

    window.onload = () => {
      $('.modal-new-curso').iziModal();
      $('.modal-edit-curso').iziModal();
      const btn_new_curso   = document.querySelector('#btn_new_curso');
      
      btn_new_curso.addEventListener('click', (e)=>{
        e.preventDefault();
        init_modal('modal-new-curso','Agregar Curso');
      });

      getListaCursoAperturado();
      getListaCursoCerrado();
    }

    const getListaCursoAperturado = () => {
      let url  = `${direccion}/Entidades/model.php?opc=lista_curso`;
      let data = {};
      data.cod_estado = '1';
      data.cod_curso = '%';
      
      $.ajax({
            method: 'POST',
            url: url,
            data: data,
            success: function(resp){
                let obj = JSON.parse(resp);
                let dataTabla = [];
                for(let i=0; i<obj.length; i++) {
                  dataTabla[i] = ['',                           //0
                                  obj[i].DES_NOMBRE_CURSO,      //1
                                  obj[i].DES_UNIDAD_ORGANICA+' - '+ obj[i].DES_SERVICIO, //2
                                  obj[i].DES_MODALIDAD,         //3
                                  obj[i].IND_FIRMA,             //4 INVISIBLE
                                  obj[i].COD_CURSO,             //5 INVISIBLE
                                  obj[i].COD_TIPO_UNIDAD,       //6
                                  obj[i].COD_UNIDAD,            //7
                                  obj[i].COD_CURSO              //8
                                 ];
                } 
                getDataListaCursoAperturado(dataTabla);
            }
      });
    }

    const getDataListaCursoAperturado = (dataTabla) => {
      $("#tb_lista_curso_aperturado").dataTable().fnDestroy();

      table_curso_aperturado = $('#tb_lista_curso_aperturado').DataTable( {
        "pageLength": 10,
        "searching": true,
        //"paging": false,
        "info":     true,
        "order": [[ 5, "desc" ]],
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
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
          {"width":"10%", "targets": [3]}, //DES_MODALIDAD
          {"width":"10%", "targets": [6,7,8]}, //COD_TIPO_UNIDAD COD_UNIDAD COD_CURSO
          {"width":"5%", "targets": [0]},
          {
            "targets": [ 4,5 ],
            "visible": false,
            "searchable": false
          },  
          {
            "className": "text-center",
            "targets": [0,3,6,7,8]
          },
          {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-danger btn-curso-delete'><i class='fas fa-trash-alt'></i></button>" 
          },
          {
            "targets": -2,
            "data": null,
            "defaultContent": "<button class='btn btn-warning btn-curso-edit'><i class='fas fa-edit'></i></button>" 
          },
          {
            "targets": -3,
            "data": null,
            "defaultContent": "<button class='btn btn-success btn-curso-view'><i class='far fa-eye'></i></button>" 
          }
        ],
        "fnRowCallback": ( nRow, aData, iDisplayIndex, iDisplayIndexFull ) => {
          if(aData[4] == '1') { // Con firma Digital
            $('button.btn-curso-edit', nRow).addClass("btn btn-dark");
            $('button.btn-curso-edit', nRow).prop('disabled', true);
          }
          else if(aData[4] == '0') { // No firmado
          }
        }
      });

      table_curso_aperturado.on( 'order.dt search.dt', function () {
        table_curso_aperturado.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = i+1;
        } );
      } ).draw();

      //EDITAR CURSO
      $('#tb_lista_curso_aperturado tbody').on( 'click', 'button.btn-curso-edit', function() { 
        let data = table_curso_aperturado.row( $(this).parents('tr') ).data();
        let cod_curso = data[8];
        getDataCurso(cod_curso);
      });

      //VER CURSO
      $('#tb_lista_curso_aperturado tbody').on( 'click', 'button.btn-curso-view', function() { 
        let data = table_curso_aperturado.row( $(this).parents('tr') ).data();
        let cod_curso = data[8];
        $.redirect(url_base, {'des_url': `${direccion}/Curso`, 'cod_curso': cod_curso, 'cod_estado': '1'}); 
      });

      //ANULAR CURSO
      $('#tb_lista_curso_aperturado tbody').on( 'click', 'button.btn-curso-delete', function() { 
        let data = table_curso_aperturado.row( $(this).parents('tr') ).data();
        let cod_curso = data[8];
        let cod_unidad = data[7];
        let cod_tipo_unidad = data[6];
        let nombre_curso = data[1];

        Swal.fire({
          title: `¿Está seguro de anular el curso ${nombre_curso}?`,
          text: "",
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si',
          cancelButtonText: 'No'
        }).then((result) => {
            if (result.value) {
              anularCurso(cod_curso, cod_unidad, cod_tipo_unidad);
            }
        });
      });
    }

    const getDataCurso = cod_curso => {
      let url  = `${direccion}/Entidades/model.php?opc=lista_curso`;
      let data = {};
      data.cod_estado = '1';
      data.cod_curso = cod_curso;

      $.ajax({
            method: 'POST',
            url: url,
            data: data,
            success: function(resp){
              let obj = JSON.parse(resp);
              let dataTabla = {};
              
                dataTabla = { 'COD_CURSO'          : obj[0].COD_CURSO,               //0
                              'COD_TIPO_UNIDAD'    : obj[0].COD_TIPO_UNIDAD,         //1
                              'COD_UNIDAD'         : obj[0].COD_UNIDAD,              //2
                              'DES_UNIDAD'         : obj[0].DES_UNIDAD_ORGANICA,     //3
                              'COD_SERVICIO'       : obj[0].COD_SERVICIO,            //4
                              'DES_SERVICIO'       : obj[0].DES_SERVICIO,            //5
                              'COD_TIPO_CURSO'     : obj[0].COD_TIPO_CURSO,          //6
                              'DES_NOMBRE_CURSO'   : obj[0].DES_NOMBRE_CURSO,        //7
                              'FEC_REALIZACION'    : obj[0].FEC_REALIZACION,         //8
                              'FEC_INICIO'         : obj[0].FEC_INICIO,              //9
                              'FEC_FIN'            : obj[0].FEC_FIN,                 //10
                              'FEC_EMISION'        : obj[0].FEC_EMISION,             //11
                              'IND_TOTAL_HORAS'    : obj[0].IND_VISUALIZACION_HORAS, //12
                              'NUM_TOTAL_HORAS'    : obj[0].NUM_TOTAL_HORAS,         //13
                              'COD_ENLACE_FECHA'   : obj[0].COD_ENLACE_FECHA,
                              'COD_TIPO_HORAS'     : obj[0].COD_TIPO_HORAS,          //15
                              'COD_TIPO_MODALIDAD' : obj[0].COD_TIPO_MODALIDAD,      //16
                              'DES_MODALIDAD'      : obj[0].DES_MODALIDAD,           //17
                            };
              init_modal('modal-edit-curso','Editar Curso', dataTabla);
            }
      });
    }

    const edit_curso = (param)=> {
      const cod_curso             = document.querySelector('#edit_cod_curso');
      const cod_unidad            = document.querySelector('#edit_cod_unidad');
      const cod_tipo_unidad       = document.querySelector('#edit_cod_tipo_unidad');
      const rbt_organizador       = document.getElementsByName('rbt_organizador_edit');
      const div_departamento      = document.querySelector('#div_departamento_edit');
      const div_escuela           = document.querySelector('#div_escuela_edit');
      const cbx_servicio          = document.querySelector('#cbx_servicio_edit');
      const slt_departamento      = document.querySelector('#slt_departamento_edit');
      const slt_servicio          = document.querySelector('#slt_servicio_edit');
      const slt_escuela           = document.querySelector('#slt_escuela_edit');
      const txt_nombre_curso      = document.querySelector('#txt_nombre_curso_edit');
      const btn_add_servicio      = document.querySelector('#btn_add_servicio_edit');
      const btn_registro_servicio = document.querySelector('#btn_registro_servicio_edit');
      const div_new_servicio      = document.querySelector('#div_new_servicio_edit');
      const rbt_fec_duracion      = document.getElementsByName('rbt_fec_duracion_edit');
      const date_fec_realizacion  = document.querySelector('#date_fec_realizacion_edit');
      const date_fec_ini          = document.querySelector('#date_fec_ini_edit');
      const date_fec_fin          = document.querySelector('#date_fec_fin_edit');
      const date_fec_emision      = document.querySelector('#date_fec_emision_edit');
      const slt_conector_fec      = document.querySelector("#slt_conector_fec_edit");
      const cbx_ind_horas         = document.querySelector('#cbx_ind_horas_edit');
      const txt_horas             = document.querySelector('#txt_horas_edit');
      const slt_modalidad         = document.querySelector('#slt_modalidad_edit');
      const rbt_tipo_curso        = document.getElementsByName('rbt_tipo_curso_edit');
      const txt_new_servicio      = document.querySelector('#txt_new_servicio_edit');
      const btn_registro_curso    = document.querySelector('#btn_edit_curso');
      const form_curso            = document.querySelector('#form_curso_edit');

      cod_curso.value = param.COD_CURSO;
      cod_unidad.value = param.COD_UNIDAD;
      cod_tipo_unidad.value = param.COD_TIPO_UNIDAD;
      slt_conector_fec.value = param.COD_ENLACE_FECHA;

      //Organizado por
      rbt_organizador[0].disabled = true;
      rbt_organizador[1].disabled = true;

      if(param.COD_TIPO_UNIDAD == '1') { //Departamento
        div_escuela.className = "d-none";
        rbt_organizador[0].checked = true;
        slt_departamento.disabled = true;
        slt_servicio.disabled = true;
        btn_add_servicio.disabled = true;
        cbx_servicio.disabled = true;
        getUnidadOrganica('1', slt_departamento, {'cod_selected':param.COD_UNIDAD, 'des_selected':param.DES_UNIDAD});
      } else if(param.COD_TIPO_UNIDAD == '2') { //Escuela
        div_departamento.className = "d-none";
        rbt_organizador[1].checked = true;
        slt_escuela.disabled = true;
        getUnidadOrganica('2', slt_escuela, {'cod_selected':param.COD_UNIDAD, 'des_selected':param.DES_UNIDAD});
      }

      //Departamento
      rbt_organizador[0].addEventListener('click', ()=>{ //DEPARTAMENTO
        slt_departamento.value = '';
        slt_escuela.value = '';
        getUnidadOrganica('1', slt_departamento, {'cod_selected':param.COD_UNIDAD, 'des_selected':param.DES_UNIDAD});
        div_departamento.classList.remove('d-none');
        div_escuela.className = "d-none";
        if(param.COD_SERVICIO != ' ') {
          cbx_servicio.checked = true;
          slt_servicio.disabled = false;
          btn_add_servicio.disabled = false;
          getServicio(param.COD_UNIDAD, slt_servicio, param.COD_SERVICIO);
        }
        else {
          cbx_servicio.checked = false;
          slt_servicio.disabled = true;
          btn_add_servicio.disabled = true;
        }
      });

      //Escuela
      rbt_organizador[1].addEventListener('click', ()=>{ //ESCUELA
        slt_servicio.value = '';
        getUnidadOrganica('2', slt_escuela, {'cod_selected':param.COD_UNIDAD, 'des_selected':param.DES_UNIDAD});
        div_departamento.className = "d-none";
        div_escuela.classList.remove('d-none');
      });

      //Servicio
      slt_departamento.addEventListener('change', ()=>{
        getServicio(slt_departamento.value, slt_servicio);
      });

      if(param.COD_SERVICIO != ' ') {
        getServicio(param.COD_UNIDAD, slt_servicio, param.COD_SERVICIO);
      }

      cbx_servicio.addEventListener('click', ()=>{
        if(cbx_servicio.checked) {
          slt_servicio.disabled = false;
          btn_add_servicio.disabled = false;
        }
        else {
          slt_escuela.value = '';
          slt_servicio.value = '';
          slt_servicio.disabled = true;
          btn_add_servicio.disabled = true;
        }
      });

      btn_add_servicio.addEventListener('click', (e)=>{
          e.preventDefault();
          slt_servicio.disabled = true;
          btn_add_servicio.disabled = true;
          div_new_servicio.classList.remove('d-none');
      });

      btn_registro_servicio.addEventListener('click', (e)=>{
        e.preventDefault();
        Swal.fire({
            title: `¿Está seguro de registrar un nuevo servicio en ${slt_departamento.options[slt_departamento.selectedIndex].text}?`,
            text: "",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
              if (result.value) {
                registroServicio(slt_departamento.value, '1', txt_new_servicio.value, '2');
              }
          });
      });

      //Curso / Taller
      if(param.COD_TIPO_CURSO == '1')
        rbt_tipo_curso[0].checked = true;
      else if(param.COD_TIPO_CURSO == '2')
        rbt_tipo_curso[1].checked = true;

      if(param.DES_NOMBRE_CURSO != ' ') {
        txt_nombre_curso.value = param.DES_NOMBRE_CURSO;
      }

      //Fecha Realizacion / Fecha Inicio y Fin
      rbt_fec_duracion[0].addEventListener('click', (e)=>{
          date_fec_ini.disabled = true;
          date_fec_fin.disabled = true;
          slt_conector_fec.disabled = true;
          date_fec_realizacion.disabled = false;
      });

      rbt_fec_duracion[1].addEventListener('click', (e)=>{
          date_fec_ini.disabled = false;
          date_fec_fin.disabled = false;
          slt_conector_fec.disabled = false;
          date_fec_realizacion.disabled = true;
      });

      if(param.FEC_REALIZACION != ' ') {
        rbt_fec_duracion[0].checked = true;
        date_fec_realizacion.disabled = false;
        let fec_realizacion = param.FEC_REALIZACION;
        fec_realizacion = fec_realizacion.split('/');
        fec_realizacion = `${fec_realizacion[2]}-${fec_realizacion[1]}-${fec_realizacion[0]}`;
        date_fec_realizacion.value = fec_realizacion;
      }
      else if(param.FEC_INICIO != ' ' || param.FEC_FIN != ' ') {
        rbt_fec_duracion[1].checked = true;
        date_fec_ini.disabled = false;
        date_fec_fin.disabled = false;
        slt_conector_fec.disabled = false;
        let fec_ini = param.FEC_INICIO;
        fec_ini = fec_ini.split('/');
        fec_ini = `${fec_ini[2]}-${fec_ini[1]}-${fec_ini[0]}`;
        date_fec_ini.value = fec_ini;
        let fec_fin = param.FEC_FIN;
        fec_fin = fec_fin.split('/');
        fec_fin = `${fec_fin[2]}-${fec_fin[1]}-${fec_fin[0]}`;
        date_fec_fin.value = fec_fin;
      }

      //Fecha de Emisión
      if(param.FEC_EMISION != ' ') {
        let fec_emision = param.FEC_EMISION;
        fec_emision = fec_emision.split('/');
        fec_emision = `${fec_emision[2]}-${fec_emision[1]}-${fec_emision[0]}`;
        date_fec_emision.value = fec_emision;
      }

      //Total Horas
      cbx_ind_horas.addEventListener('click', (e)=>{
        if (cbx_ind_horas.checked) {
          txt_horas.disabled = false;
          rb_tipo_horas_edit_1.disabled = false;
          rb_tipo_horas_edit_2.disabled = false;
        }
        else {
          txt_horas.disabled = true;
          rb_tipo_horas_edit_1.disabled = true;
          rb_tipo_horas_edit_2.disabled = true;
        }
      });

      if(param.NUM_TOTAL_HORAS != ' ') {
        cbx_ind_horas.checked = true;
        txt_horas.disabled = false;
        rb_tipo_horas_edit_1.disabled = false;
        rb_tipo_horas_edit_2.disabled = false;
        txt_horas.value = param.NUM_TOTAL_HORAS;
      } else {
        txt_horas.disabled = true;
        rb_tipo_horas_edit_1.disabled = true;
        rb_tipo_horas_edit_2.disabled = true;
      }

      if(param.COD_TIPO_HORAS != null) {
        if(param.COD_TIPO_HORAS === '01')
          rb_tipo_horas_edit_1.checked = true;
        else if(param.COD_TIPO_HORAS === '02')
          rb_tipo_horas_edit_2.checked = true;
      }

      if(param.COD_TIPO_MODALIDAD != ' ') {
        slt_modalidad.value = param.COD_TIPO_MODALIDAD;
      }
      
      btn_registro_curso.addEventListener('click', (e)=>{
        e.preventDefault();
        if(rbt_organizador[0].checked == false && rbt_organizador[1].checked == false) {
          Swal.fire("Aviso", "Debe indicar el organizador", "info");
        }
        else if(rbt_organizador[0].checked == true && slt_departamento.value == '') { //dpto
            Swal.fire("Aviso", "Debe ingresar el Departamento", "info");
        }
        else if(rbt_organizador[1].checked == true && slt_escuela.value == '') { //escuela
            Swal.fire("Aviso", "Debe ingresar la Escuela", "info");
        }
        else if(txt_nombre_curso.value == '') {
          Swal.fire("Aviso", "Debe ingresar el nombre del Curso", "info");
        }
        else if(rbt_fec_duracion[0].checked == false && rbt_fec_duracion[1].checked == false) {
          Swal.fire("Aviso", "Debe seleccionar Fecha de Realización o Fecha de inicio y fin", "info");
        }
        else if(slt_modalidad.value == '') {
          Swal.fire("Aviso", "Debe ingresar la modalidad", "info");
        }
        else {
          Swal.fire({
              title: `¿Está seguro de editar los datos del curso?`,
              text: "",
              type: 'question',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si',
              cancelButtonText: 'No'
          }).then((result) => {
              if (result.value) {
                editaCurso(form_curso);
              }
          });
        }
      });
    }

    const anularCurso = (cod_curso, cod_unidad, cod_tipo_unidad) => {
      let url  = `${direccion}/Entidades/model.php?opc=anular_curso`;
      let data = {};
      data.cod_curso       = cod_curso;
      data.cod_unidad      = cod_unidad;
      data.cod_tipo_unidad = cod_tipo_unidad;
      data.cod_usuario     = cod_usuario;

      $.ajax({
        method: 'POST',
        url: url,
        data: data,
        success: function(resp){
          let obj = JSON.parse(resp);
          if(obj.cod_error == '1') {
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Se anuló el curso',
                showConfirmButton: false,
                timer: 2000,
            }).then(function () { 
              location.reload();
            });
          } else
            Swal.fire("Aviso",obj.des_error, "info");
        }
      });
    }

    const getListaCursoCerrado = () => {
      let url  =  `${direccion}/Entidades/model.php?opc=lista_curso`;
      let data = {};
      data.cod_estado = '2';
      
      $.ajax({
            method: 'POST',
            url: url,
            data: data,
            success: function(resp){
                let obj = JSON.parse(resp);
                let dataTabla = [];
                for(let i=0; i<obj.length; i++) {
                  dataTabla[i] = ['',                           //0
                                  obj[i].DES_NOMBRE_CURSO,      //1
                                  obj[i].DES_UNIDAD_ORGANICA,   //2
                                  obj[i].DES_SERVICIO,          //3
                                  obj[i].DES_MODALIDAD,         //4
                                  obj[i].COD_TIPO_UNIDAD,       //5
                                  obj[i].COD_UNIDAD,            //6
                                  obj[i].COD_CURSO              //7
                                 ];
                } 
                getDataListaCursoCerrado(dataTabla);
            }
      });
    }

    const getDataListaCursoCerrado = (dataTabla) => {
        $("#tb_lista_curso_cerrado").dataTable().fnDestroy();

        table_curso_cerrado = $('#tb_lista_curso_cerrado').DataTable( {
          "pageLength": 10,
          "searching": true,
          "info":     false,
          language: {
              "decimal": "",
              "emptyTable": "No hay información",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
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
            {"width":"5%", "targets": [0]}, 
            {
              "targets": [ 5,6 ],
              "visible": false,
              "searchable": false
            },
            {"className": "text-center",//"dt-center",
              "targets": [0,2,3,4,5,6,7]
            },
            {
              "targets": -1,
              "data": null,
              "defaultContent": "<button class='btn btn-success btn-curso-view'><i class='far fa-eye'></i></button>" 
            },
          ],
        });

        table_curso_cerrado.on( 'order.dt search.dt', function () {
          table_curso_cerrado.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
          } );
        } ).draw();

        $('#tb_lista_curso_cerrado tbody').on( 'click', 'button.btn-curso-view', function() { 
          let data = table_curso_cerrado.row( $(this).parents('tr') ).data();
          let cod_curso = data[7];
          $.redirect(url_base, {'des_url': `${direccion}/Curso`, 'cod_curso': cod_curso, 'cod_estado': '2'});
        });
    }

    const getUnidadOrganica = (tipo, element, selected={cod_selected:null, des_selected:null}) => {
      let url  = `${direccion}/Entidades/model.php?opc=lista_unidad_organica`;
      let data = {};
      data.cod_tipo_unidad = tipo;
      
      const {cod_selected, des_selected} = selected;  

      $.ajax({
        method: 'POST',
        url: url,
        data: data,
        success: function(resp){
          let obj = JSON.parse(resp);
          let html;
          element.innerHTML = '';
          element.innerHTML = '<option value="" disabled selected>Seleccione</option>';
          const {dato} = obj;
          for(let key in dato) {
            if(dato[key].COD_UNIDAD_ORGANICA === cod_selected)
              html = `<option value=${dato[key].COD_UNIDAD_ORGANICA} selected>${dato[key].DES_UNIDAD_ORGANICA}</option>`;
            else
              html = `<option value=${dato[key].COD_UNIDAD_ORGANICA}>${dato[key].DES_UNIDAD_ORGANICA}</option>`;
            
            element.innerHTML += html;
          }
        }
      });
    }

    const getServicio = (cod_unidad, element, selected='') => {
      if(selected === '') {
        document.querySelector('#cbx_servicio_edit').checked = false;
        document.querySelector('#slt_servicio_edit').disabled = true;
        document.querySelector('#btn_add_servicio_edit').disabled = true;
      }

      let url  = `${direccion}/Entidades/model.php?opc=lista_servicio`;
      let data = {};
      data.cod_unidad = cod_unidad;

      $.ajax({
        method: 'POST',
        url: url,
        data: data,
        success: function(resp){
          let obj = JSON.parse(resp);
          let html;
          element.innerHTML = '';
          element.innerHTML = '<option value="" disabled selected>Seleccione</option>';
          const {dato} = obj;
          for(let key in dato) {
            if(selected != ''){
              if(selected == dato[key].COD_SERVICIO)
                html = `<option value=${dato[key].COD_SERVICIO} selected>${dato[key].DES_SERVICIO}</option>`;
              else
                html = `<option value=${dato[key].COD_SERVICIO}>${dato[key].DES_SERVICIO}</option>`;
            }
            else
              html = `<option value=${dato[key].COD_SERVICIO}>${dato[key].DES_SERVICIO}</option>`;
            
            element.innerHTML += html;
          }
        }
      });
    }

    const registroServicio = (cod_unidad, cod_tipo_unidad, des_servicio, accion='1')=>{ //accion -> 1: Nuevo, 2: Editar
      let data = {};
      data.cod_unidad = cod_unidad;
      data.cod_tipo_unidad = cod_tipo_unidad;
      data.des_servicio = des_servicio;
      data.cod_usuario = cod_usuario;
      let url  = `${direccion}/Entidades/model.php?opc=registro_servicio`;
      $.ajax({
          method: 'POST',
          url: url,
          data: data,
          success: function(resp){
            let obj = JSON.parse(resp);
            if(obj.cod_error == '1'){
              Swal.fire(
                'Aviso',
                `Se agregó el servicio ${des_servicio}`,
                'success'
              ).then((result)=>{
                if(accion == '1') {
                  document.querySelector('#txt_new_servicio').value = '';
                  document.querySelector('#btn_add_servicio').disabled = false;
                  document.querySelector('#slt_servicio').disabled = false;
                  document.querySelector('#cbx_servicio').checked = true;
                  document.querySelector('#div_new_servicio').className = "d-none";

                  getServicio(document.querySelector('#slt_departamento').value, document.querySelector('#slt_servicio'), obj.cod_servicio);
                } else if(accion == '2') {
                  document.querySelector('#txt_new_servicio_edit').value = '';
                  document.querySelector('#btn_add_servicio_edit').disabled = false;
                  document.querySelector('#slt_servicio_edit').disabled = false;
                  document.querySelector('#cbx_servicio_edit').checked = true;
                  document.querySelector('#div_new_servicio_edit').className = "d-none";

                  getServicio(document.querySelector('#slt_departamento_edit').value, document.querySelector('#slt_servicio_edit'), obj.cod_servicio);
                }
              });
            }else{
              Swal.fire({
                type: 'info',
                title: 'Aviso',
                text: obj.des_error
              });
            }
          }
      });
    }

    const registroCurso = (form) => {
        let peticion = new XMLHttpRequest();
        peticion.open('post',`${direccion}/Entidades/model.php?opc=registro_curso`);
        peticion.send(new FormData(form));
        peticion.onload = function() {
            console.log(peticion.response);
            let obj = JSON.parse(peticion.response);
            console.log(obj);
            if(obj.cod_error == '1')
            {
              Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: 'Se agregó el curso',
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

    const editaCurso = (form) => {
        let peticion = new XMLHttpRequest();
        peticion.open('post',`${direccion}/Entidades/model.php?opc=modifica_curso`);
        peticion.send(new FormData(form));
        peticion.onload = function() {
            console.log(peticion.response);
            let obj = JSON.parse(peticion.response);
            console.log(obj);
            if(obj.cod_error == '1')
            {
              Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: 'Se modificaron los datos',
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

    const new_curso = ()=> {
      const rbt_organizador       = document.getElementsByName('rbt_organizador');
      const div_departamento      = document.querySelector('#div_departamento');
      const div_escuela           = document.querySelector('#div_escuela');
      const cbx_servicio          = document.querySelector('#cbx_servicio');
      const slt_departamento      = document.querySelector('#slt_departamento');
      const slt_servicio          = document.querySelector('#slt_servicio');
      const slt_escuela           = document.querySelector('#slt_escuela');
      const btn_add_servicio      = document.querySelector('#btn_add_servicio');
      const btn_registro_servicio = document.querySelector('#btn_registro_servicio');
      const div_new_servicio      = document.querySelector('#div_new_servicio');
      const rbt_fec_duracion      = document.getElementsByName('rbt_fec_duracion');
      const cbx_ind_horas         = document.querySelector('#cbx_ind_horas');
      const date_fec_realizacion  = document.querySelector('#date_fec_realizacion');
      const date_fec_ini          = document.querySelector('#date_fec_ini');
      const date_fec_fin          = document.querySelector('#date_fec_fin');
      const txt_horas             = document.querySelector('#txt_horas');
      const rbt_tipo_curso        = document.getElementsByName('rbt_tipo_curso');
      const txt_new_servicio      = document.querySelector('#txt_new_servicio');
      const btn_registro_curso    = document.querySelector('#btn_registro_curso');
      const form_curso            = document.querySelector('#form_curso');

      btn_add_servicio.disabled = true;
      
      rbt_organizador[0].addEventListener('click', ()=>{ //DEPARTAMENTO
        slt_escuela.value = '';
        getUnidadOrganica('1', slt_departamento);
        div_departamento.classList.remove('d-none');
        div_escuela.className = "d-none";
      });

      slt_departamento.addEventListener('change', ()=>{
        getServicio(slt_departamento.value, slt_servicio);
      });

      rbt_organizador[1].addEventListener('click', ()=>{ //ESCUELA
        slt_servicio.value = '';
        getUnidadOrganica('2', slt_escuela);
        div_escuela.classList.remove('d-none');
        div_departamento.className = "d-none";
      });

      cbx_servicio.addEventListener('click', ()=>{
        if(cbx_servicio.checked) {
          slt_servicio.disabled = false;
          btn_add_servicio.disabled = false;
        }
        else {
          slt_escuela.value = '';
          slt_servicio.value = '';
          slt_servicio.disabled = true;
          btn_add_servicio.disabled = true;
        }
      });

      btn_add_servicio.addEventListener('click', (e)=>{
          e.preventDefault();
          slt_servicio.disabled = true;
          btn_add_servicio.disabled = true;
          div_new_servicio.classList.remove('d-none');
      });

      rbt_fec_duracion[0].addEventListener('click', (e)=>{
          date_fec_ini.disabled = true;
          date_fec_fin.disabled = true;
          slt_conector_fec.disabled = true;
          date_fec_realizacion.disabled = false;
      });

      rbt_fec_duracion[1].addEventListener('click', (e)=>{
          date_fec_ini.disabled = false;
          date_fec_fin.disabled = false;
          slt_conector_fec.disabled = false;
          date_fec_realizacion.disabled = true;
      });

      cbx_ind_horas.addEventListener('click', (e)=>{
        if (cbx_ind_horas.checked) {
          txt_horas.disabled = false;
          rb_tipo_horas_1.disabled = false;
          rb_tipo_horas_2.disabled = false;
        }
        else {
          txt_horas.disabled = true;
          rb_tipo_horas_1.disabled = true;
          rb_tipo_horas_2.disabled = true;
        }
      });

      btn_registro_servicio.addEventListener('click', (e)=>{
        e.preventDefault();
        Swal.fire({
            title: `¿Está seguro de registrar un nuevo servicio en ${slt_departamento.options[slt_departamento.selectedIndex].text}?`,
            text: "",
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
          }).then((result) => {
              if (result.value) {
                registroServicio(slt_departamento.value, '1', txt_new_servicio.value);
              }
          });
      });

      btn_registro_curso.addEventListener('click', (e)=>{
        e.preventDefault();
        if(rbt_organizador[0].checked == false && rbt_organizador[1].checked == false) {
          Swal.fire("Aviso", "Debe indicar el organizador", "info");
        }
        else if(rbt_organizador[0].checked == true && slt_departamento.value == '') { //dpto
            Swal.fire("Aviso", "Debe ingresar el Departamento", "info");
        }
        else if(rbt_organizador[1].checked == true && slt_escuela.value == '') { //escuela
            Swal.fire("Aviso", "Debe ingresar la Escuela", "info");
        }
        else if(txt_nombre_curso.value == '') {
          Swal.fire("Aviso", "Debe ingresar el nombre del Curso", "info");
        }
        else if(rbt_fec_duracion[0].checked == false && rbt_fec_duracion[1].checked == false) {
          Swal.fire("Aviso", "Debe seleccionar Fecha de Realización o Fecha de inicio y fin", "info");
        }
        else if(slt_modalidad.value == '') {
          Swal.fire("Aviso", "Debe ingresar la modalidad", "info");
        }
        else {
          Swal.fire({
              title: `¿Está seguro de agregar el curso?`,
              text: "",
              type: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si',
              cancelButtonText: 'No'
          }).then((result) => {
              if (result.value) {
                registroCurso(form_curso);
              }
          });
        }
      });
    }

    const init_modal =(className, title, param=null) => {
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

      if(className === 'modal-new-curso') {
        new_curso();
      }
      else if(className === 'modal-edit-curso') {
        edit_curso(param);
      }
    }
  })();
</script>