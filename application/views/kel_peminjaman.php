<!DOCTYPE html>
<html>
<head>
  <title>Kelola Peminjaman</title>
</head>
<body>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Kelola Peminjaman </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          Anda dapat mengelola peminjaman yang terdaftar dalam sistem di halaman ini.
        </p>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

          <thead>
            <tr>
              <th>Nama Anggota</th>
              <th>Judul Buku</th>
              <th>Tanggal Pinjam</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $i = 1;
            foreach ($peminjaman as $key => $value) {
              ?>
            <tr>
              <td><?php echo $value['nama']; ?></td>
              <td><?php echo $value['judul_buku']; ?></td>
              <td><?php echo $value['tgl_pinjam']; ?></td>
              <td>
                <?php
                if ($value['status']==0) {
                  echo '<button type="button" class="btn btn-warning btn-xs">Belum Diproses</button>';
                }
                elseif ($value['status']==1) {
                  echo '<button type="button" class="btn btn-info btn-xs">Terproses</button>';
                }
                elseif ($value['status']==5) {
                  echo '<button type="button" class="btn btn-info btn-xs">Dibatalkan</button>';
                }
                else {
                  echo '<button type="button" class="btn btn-danger btn-xs">Kedaluwarsa</button>';
                }
                ?>
                </td>
              <td style="text-align:center">
                <?php
                if ($value['status']==0) {
                echo '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#rincian'.$value['id_pinjaman'].'"><i class="fa fa-check"></i> Proses </button>';
                }
                else {
                echo '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#rincian'.$value['id_pinjaman'].'"><i class="fa fa-table"></i> Rincian </button>';
                }
                ?>
                <?php if ($value['status']!=5&&$value['status']!=1) : ?>

                <form class="form-horizontal form-label-left" action="<?php echo base_url(); ?>kel_peminjaman/hapPeminjaman" method="post">
                  <input type="hidden" name="id_pinjaman" value="<?php echo $value['id_pinjaman']?>">
                  <input type="hidden" name="id_buku" value="<?php echo $value['id_buku']?>">
                  <button type="submit" class="btn btn-success"> Batal </button>
                </form>
              <?php endif; ?>
              </td>
            </tr>
              <?php $i++;} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php
  $i = 1;
  foreach ($peminjaman as $key => $value) {
    ?>
  <div class="modal fade" id="rincian<?php echo $value['id_pinjaman'] ?>" tabindex="-1" role="dialog" aria-labelledby="rincianLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true"?>&times</span></button>
          <h4 class="modal-title" id="rincianLabel">Rincian Peminjaman</h4>
        </div>
        <div class="modal-body">
          <div class="col-sm-3">
            <div class="profile_img">
                <div id="crop-avatar">
                  <img class="img-responsive avatar-view" src="assets/images/<?php echo $value['foto'] ?>" alt="Avatar" title="Change the avatar">
                </div>
            </div>
              <h3><?php echo $value['nama'] ?></h3>
          </div>
          <div class="col-sm-9">
              <ul class="list-unstyled user_data">
              <div class="container-fluid">
              <div class="row">
                <li><div class="col-sm-3"><i class="fa fa-home user-profile-icon"> Alamat </i></div><div class="col-sm-9">: <?php echo $value['alamat'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-3"><i class="fa fa-phone user-profile-icon"> Telepon </i></div><div class="col-sm-9">: <?php echo $value['telp'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-3"><i class="fa fa-map-book user-profile-icon"> Judul Buku </i></div><div class="col-sm-9">: <?php echo $value['judul_buku'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-3"><i class="fa fa-circle user-profile-icon"> Jenis </i></div><div class="col-sm-9">: <?php echo $value['jenis_buku'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-3"><i class="fa fa-calendar user-profile-icon"> Tanggal Pinjam </i></div><div class="col-sm-9">: <?php echo $value['tgl_pinjam'] ?>
                </div></li>
              </div>
              <?php
              if ($value['status']==1) {
                echo '<div class="row">
                  <li><div class="col-sm-3"><i class="fa fa-calendar user-profile-icon"> Tanggal Proses </i></div><div class="col-sm-9">: '.$value['tgl_proses'].'</div></li>
                </div>';
              }
              ?>
              </div>
              </ul>
          </div>
            &nbsp
        </div>
         &nbsp &nbsp &nbsp
        <div class="modal-footer">
          <form class="form-horizontal form-label-left" action="kel_peminjaman/proses" method="post">
            <input type="hidden" name="id_pinjaman" value="<?php echo $value['id_pinjaman']?>">
            <?php
            if ($value['status']==0) {
          echo '<button type="submit" class="btn btn-success"> Proses </button>'; }?>
          <button type="button" class="btn btn-danger" data-dismiss="modal"> Tutup </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php $i++;} ?>
</body>
</html>
