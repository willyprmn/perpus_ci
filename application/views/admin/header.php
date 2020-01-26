<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - Aplikasi Perpustakaan</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css' ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/datatable/datatables.css' ?>">
  <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'; ?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'; ?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/datatable/jquery.dataTables.js'; ?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/datatable/datatables.js'; ?>"></script>
</head>
<body>
  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toogle get group for better mobile dsiplay -->
      <div class="navbar-header">
        <button type="button" class="navbar-togglecollapsed" data-toogle="collapse" data-target="#bs-example-navbarcollapse-1" aria-expanded="false">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">Perpustakaan</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-examplenavbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="<?php echo base_url().'admin'; ?>"><span class="glyphicon glyphicon-home"></span> Dashboard<span class="sronly"> (current)</span></a></li>
          <li><a href="<?php echo base_url().'admin/buku'; ?>"><span class="glyphicon glyphicon-folder-open"></span> Data Buku</a></li>
          <li><a href="<?php echo base_url().'admin/anggota'; ?>"><span class="glyphicon glyphicon-user"></span> Data Anggota</a></li>
          <li><a href="<?php echo base_url().'admin/kategori'; ?>"><span class="glyphicon glyphicon-folder-close"></span> Data Kategori</a></li>
          <li><a href="<?php echo base_url().'admin/peminjaman'; ?>"><span class="glyphicon glyphicon-sort"></span> Transaksi Peminjaman</a></li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" ariaexpanded="false"><span class="glyphicon glyphicon-list-alt"></span> Laporan<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url().'admin/cetak_laporan_buku' ?>"><i class="glyphicon glyphicon-lock"></i> Laporan Data Buku</a></li>
              <li><a href="<?php echo base_url().'admin/cetak_laporan_anggota' ?>"><i class="glyphicon glyphicon-lock"></i> Laporan Data Anggota</a></li>
              <li><a href="<?php echo base_url().'admin/laporan_transaksi' ?>"><i class="glyphicon glyphicon-lock"></i> Laporan Data Transaksi</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" ariaexpanded="false"><?php echo "Halo, <b>".$this->session->userdata('nama'); ?></b><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url().'admin/ganti_profile' ?>"><i class="glyphicon glyphicon-edit"></i> Edit Profile</a></li>
              <li><a href="<?php echo base_url().'admin/logout'; ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <div class="container">