<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Instituto Nacional de Enfermedades Neoplásicas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="shortcut icon" href="../images/icons/Logo-inen.png" type="image/png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-5.14.0/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <link rel="stylesheet" href="dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.css">
  <link href="plugins/iziModal/css/iziModal.css" rel="stylesheet">
  <!-- select 2 and select2-bootstrap4-theme -->
  <link href="plugins/select2/css/select2.min.css" rel="stylesheet">
  <link href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style type="text/css">
    .box-item .card-body {
      overflow-x: hidden;
      padding: 0;
      position: relative;
    }

    .bg-azul-inen {
      background-color: rgb(46, 82, 148);
      color: white;
    }

    .p-container {
      padding: 10px 40px;
    }

    .label-style {
      height: calc(2.25rem + 2px);
      padding: .375rem .75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: .25rem;
      box-shadow: inset 0 0 0 transparent;
      transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
  </style>
  <script type="text/javascript">
    const cod_usuario         = "<?php echo $user?>";
    const des_url             = "<?php echo $des_url?>";
    const url_base            = "<?php echo URL_BASE?>";
  </script>
</head>