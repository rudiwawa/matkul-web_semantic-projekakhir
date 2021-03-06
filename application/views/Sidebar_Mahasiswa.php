<?php
$loc = base_url() . '/assets/';
?>
<div class="wrapper">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fas fa-user"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.html" class="brand-link">
    <span class="brand-text font-weight-light">FILKOM - PKL</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= $loc ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="profil.html" class="d-block"><?php echo $this->session->userdata('name') ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= base_url('Mahasiswa/daftarPKL') ?>" class="nav-link">
            <i class="nav-icon far fa-edit"></i>
            <p>
              Pendaftaran PKL
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('Mahasiswa/progresPKL') ?>" class="nav-link">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Pelaksanaan PKL
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('Mahasiswa/laporanPKL') ?>" class="nav-link">
            <i class="nav-icon far fa-file"></i>
            <p>
              Pelaporan PKL
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="<?= base_url('Mahasiswa/logout') ?>" class="nav-link">
            <i class="nav-icon far fa-file"></i>
            <p>
            Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
