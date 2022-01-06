<style type="text/css">
  .menu-active {
    color: #007bff !important;
    border: solid #007bff 0.5px;
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="nav nav-pills" id="ulMenu">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo URL_BASE?>" class="nav-link">Inicio</a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?php echo $user?><i class="fas fa-caret-down ml-2"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="../Entidades/session_destroy.php?url=<?php echo URL_BASE?>" class="dropdown-item text-center">
            <i class="fas fa-sign-out-alt mr-2"></i>Cerrar Sesión
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/redirect/redirect.js"></script>