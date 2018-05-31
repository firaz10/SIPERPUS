<!DOCTYPE html>
<html>
<head>
  <title>Kelola Pengembalian</title>
</head>
<body>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Kelola Pengembalian </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          Anda dapat mengelola pengembalian buku yang terdaftar di dalam sistem pada halaman ini .
        </p>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Nama Anggota</th>
              <th>Judul Buku</th>
              <th>Tanggal Kembali</th>
              <th>Denda</th>
              <th>Status</th>
              <th style="width:15%">Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $i = 1;
            foreach ($pengembalian as $key => $value) {
              ?>
            <tr>
              <td><?php echo $value['nama']; ?></td>
              <td><?php echo $value['judul_buku']; ?></td>
              <td><?php echo $value['tgl_kembali']; ?></td>
              <td><?php
              $date1 = date('Y-m-d');
              $date2 = $value['tgl_kembali'];
              $diff = abs(strtotime($date2) - strtotime($date1));
              $years   = floor($diff / (365*60*60*24));
              $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
              $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
              $jumDenda = $days-7;
              if ($jumDenda==0) {
                  echo '<button type="button" class="btn btn-info btn-xs">Tidak ada</button>';
              }
              else {
                  $bayar =500*$jumDenda;
                  echo "Rp. ".number_format($bayar,2);
              } ?></td>
              <td>
                <?php
                if ($value['status_kem']==0) {
                  echo '<button type="button" class="btn btn-warning btn-xs">Belum Dikembalikan</button>';
                }
                elseif ($value['status_kem']==5) {
                  echo '<button type="button" class="btn btn-danger btn-xs">Hilang</button>';
                }
                else {
                  echo '<button type="button" class="btn btn-info btn-xs">Dikembalikan</button>';
                }
                ?>
                </td>
              <td style="text-align:center">
                <?php
                if ($value['status_kem']==0) {
                echo '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#rincian'.$value['id_pengembalian'].'"><i class="fa fa-check"></i> Proses</button>';
                }

                else {
                echo '<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#rincian'.$value['id_pengembalian'].'"><i class="fa fa-table"></i> Rincian</button>';
                }
                ?>
                <form class="form-horizontal form-label-left" action="<?php echo base_url(); ?>kel_pengembalian/hapPengembalian" method="post">
                  <input type="hidden" name="id_pengembalian" value="<?php echo $value['id_pengembalian']?>">
                  <input type="hidden" name="id_buku" value="<?php echo $value['id_buku']?>">
                  <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-trash"></i> Hapus</button>
                </form>
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
  foreach ($pengembalian as $key => $value) {
    ?>
  <div class="modal fade" id="rincian<?php echo $value['id_pengembalian'] ?>" tabindex="-1" role="dialog" aria-labelledby="rincianLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true"?>&times</span></button>
          <h4 class="modal-title" id="rincianLabel">Rincian Pengembalian</h4>
        </div>
        <div class="modal-body">
          <div class="col-sm-4">
            <div class="profile_img">
                <div id="crop-avatar">
                  <img class="img-responsive avatar-view" src="assets/images/<?php echo $value['foto'] ?>" alt="Avatar" title="Change the avatar">
                </div>
            </div>
              <h3><?php echo $value['nama'] ?></h3>
          </div>
          <div class="col-sm-8">
              <ul class="list-unstyled user_data">
              <div class="container-fluid">
              <div class="row">
                <li><div class="col-sm-4"><i class="fa fa-home user-profile-icon"> Alamat </i></div><div class="col-sm-8">: <?php echo $value['alamat'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-4"><i class="fa fa-phone user-profile-icon"> Telepon </i></div><div class="col-sm-8">: <?php echo $value['telp'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-4"><i class="fa fa-book user-profile-icon"> Judul Buku </i></div><div class="col-sm-8">: <?php echo $value['judul_buku'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-4"><i class="fa fa-circle user-profile-icon"> Jenis </i></div><div class="col-sm-8">: <?php echo $value['jenis_buku'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-4"><i class="fa fa-calendar user-profile-icon"> Tanggal Pinjam </i></div><div class="col-sm-8">: <?php echo $value['tgl_proses'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-4"><i class="fa fa-calendar user-profile-icon"> Tanggal Kembali </i></div><div class="col-sm-8">: <?php echo $value['tgl_kembali']?>
                </div></li>
              </div>
              <div class="row">
                <?php $date1 = date('Y-m-d');
                $date2 = $value['tgl_kembali'];
                $diff = abs(strtotime($date2) - strtotime($date1));
                $years   = floor($diff / (365*60*60*24));
                $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                $jumDenda = $days-7;?>
                  <li><div class="col-sm-4"><i class="fa fa-hourglass user-profile-icon"> Keterlambatan </i></div><div class="col-sm-8">:
                    <?php if ($jumDenda==0) {
                    echo " - ";
                  }
                  else {
                    echo $jumDenda." hari";
                  } ?></div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-4"><i class="fa fa-money user-profile-icon"> Denda </i></div><div class="col-sm-8">: <?php
                $bayar =500*$jumDenda;
                echo "Rp. ".number_format($bayar,2);
                ?>
                </div></li>
              </div>
              </div>
              </ul>
          </div>
            &nbsp
        </div>
         &nbsp &nbsp &nbsp
        <div class="modal-footer">
          <form class="form-horizontal form-label-left" action="kel_pengembalian/proses" method="post">
            <input type="hidden" name="id_pengembalian" value="<?php echo $value['id_pengembalian']?>">
            <input type="hidden" name="id_buku" value="<?php echo $value['id_buku']?>">
            <?php
            if ($value['status_kem']==0) {
          echo '<button type="submit" class="btn btn-success"> Proses </button>';?>
          </form>
          <form class="form-horizontal form-label-left" action="kel_pengembalian/hilang" method="post">
            <input type="hidden" name="id_pengembalian" value="<?php echo $value['id_pengembalian']?>">
            <input type="hidden" name="id_buku" value="<?php echo $value['id_buku']?>">
          <?php
          echo '<button type="submit" class="btn btn-warning"> Hilang </button>'; }?>
          <button type="button" class="btn btn-danger" data-dismiss="modal"> Tutup </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php $i++;} ?>
</body>
</html>
