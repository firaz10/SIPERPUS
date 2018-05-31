<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <link rel="icon" type="image/png" href="assets/login/images/icons/favicon.ico"/>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url(); ?>assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet">
  </head>
  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url(); ?>hal_user" class="site_title"><i class="fa fa-book"></i> <span>E-Perpus</span></a>
            </div>
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php base_url(); ?> assets/images/admin.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat datang,</span>

                <h2><?php echo $user['nama']; ?></h2>

              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <?php if ($user['level']=='admin'): ?>
              <!-- sidebar menu -->
              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                  <h3>Menu Utama</h3>
                  <ul class="nav side-menu">
                    <li><a href="<?php echo base_url(); ?>hal_user"><i class="fa fa-home"></i>Beranda</a></li>
                    <li><a href="<?php echo base_url(); ?>kel_anggota"><i class="fa fa-user"></i>Kelola Anggota</a></li>
                    <li><a href="<?php echo base_url(); ?>kel_buku"><i class="fa fa-book"></i>Kelola Buku</a></li>
                    <li><a href="<?php echo base_url(); ?>kel_peminjaman"><i class="fa fa-upload"></i>Peminjaman
                      <?php if ($pinjam>=1) {
                      echo '<span class="badge bg-green">'. $pinjam;
                    } ?></span></a></li>
                    <li><a href="<?php echo base_url(); ?>kel_pengembalian"><i class="fa fa-download"></i>Pengembalian
                      <?php if ($kembali>=1) {
                      echo '<span class="badge bg-red">'. $kembali;
                    } ?></span></a></li>
                  </div>
                </div>
                <!-- /sidebar menu -->
              <?php else: ?>
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                  <div class="menu_section">
                    <h3>Menu Utama</h3>
                    <ul class="nav side-menu">
                      <li><a href="<?php echo base_url(); ?>hal_user"><i class="fa fa-home"></i>Beranda</a></li>
                      <li><a href="<?php echo base_url(); ?>daftar_buku"><i class="fa fa-book"></i>Pinjam Buku</a></li>
                  </div>
                </div>
                <!-- /sidebar menu -->
            <?php endif; ?>
          </div>
          </div>

          <!-- top navigation -->
          <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>assets/images/<?php echo $user['foto']; ?>" alt=""><?php echo $user['nama']; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url(); ?>hal_utama/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

              </ul>
            </nav>
          </div>
          </div>
          <!-- /top navigation -->

                  <!-- page content -->
                  <div class="right_col" role="main">
