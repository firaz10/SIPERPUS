<!DOCTYPE html>
<html>
<head>
  <title>Daftar Buku</title>
</head>
<body>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Buku</h2>

        <div class="title_right">
        <form action="<?php echo base_url('daftar_buku/search_keyword');?>" method = "post">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" name="keyword" placeholder="Cari buku berdasarkan attribut buku (e.g. judul, index, penerbit)..">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Cari</button>
                    </span>
                  </div>
                </div>
              </form>
              </div>

        <div class="clearfix"></div>
      </div>

      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          Anda dapat melihat daftar buku yang anda ingin cari dan pinjam pada halaman ini.
        </p>

        <?php
        $i = 1;
        foreach ($buku as $key => $value) {
          ?>
        <div class="col-md-55">
          <div class="thumbnail">
              <div class="image view view-first">
                  <img style="width: 100%; display: block;" src="<?php echo base_url(); ?>assets/images/buku/<?php echo $value['sampul'];?>" alt="image" />
                  <div class="mask">
                    <p><?php echo $value['sinopsis']; ?></p>
                    <div class="tools tools-bottom">
                      <a data-toggle="modal" data-target="#rincian<?php echo $value['id_buku'] ?>"><i class="fa fa-pencil"></i></a>
                    </div>
                  </div>
              </div>
              <div class="caption">
                  <p><?php echo $value['judul_buku']; ?></p>
              </div>
          </div>
        </div>
          <?php $i++;} ?>
      </div>
    </div>
  </div>
  <?php
  $i = 1;
  foreach ($buku as $key => $value) {
    ?>
  <div class="modal fade" id="rincian<?php echo $value['id_buku'] ?>" tabindex="-1" role="dialog" aria-labelledby="rincianLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true"?>&times</span></button>
          <h4 class="modal-title" id="rincianLabel">Rincian Buku</h4>
        </div>
        <div class="modal-body">
          <div class="col-sm-3">
            <div class="profile_img">
                <div id="crop-avatar">
                  <img class="img-responsive avatar-view" src="<?php echo base_url(); ?>assets/images/buku/<?php echo $value['sampul'] ?>" alt="Avatar" title="Change the avatar">
                </div>
            </div>
              <h3><?php echo $value['judul_buku'] ?></h3>
          </div>
          <div class="col-sm-9">
              <ul class="list-unstyled user_data">
              <div class="container-fluid">
              <div class="row">
                <li><div class="col-sm-3"> Pengarang </i></div><div class="col-sm-9">: <?php echo $value['pengarang'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-3"> Jenis Buku </i></div><div class="col-sm-9">: <?php echo $value['jenis_buku'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-3"> Penerbit </i></div><div class="col-sm-9">: <?php echo $value['penerbit'] ?>
\                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-3"> Tahun </i></div><div class="col-sm-9">: <?php echo $value['tahun'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-3"> Tempat </i></div><div class="col-sm-9">: <?php echo $value['tempat'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-3"> Jumlah </i></div><div class="col-sm-9">: <?php echo $value['jumlah'] ?>
                </div></li>
              </div>
              <div class="row">
                <li><div class="col-sm-3"> Sinopsis </i></div><div class="col-sm-9">: <?php echo $value['sinopsis'] ?>
                </div></li>
              </div>
              </div>
              </ul>
          </div>
            &nbsp
            <?php if ($value['dipinjam']==$value['jumlah']) {
                echo '<div class="alert alert-info role="alert style="text-align:center">Stok buku habis, anda dapat mencoba meminjam buku lainnya </div>';
              }
              elseif ($statuspinjam==1) {
                echo '<div class="alert alert-info role="alert style="text-align:center">Anda sedang dalam proses peminjaman </div>';
              }
              elseif ($statuskembali==1) {
                echo '<div class="alert alert-info role="alert style="text-align:center">Anda belum mengembalikan buku yang dipinjam </div>';
              }?>
        </div>
        <div class="modal-footer">
          <form class="form-horizontal form-label-left" action="daftar_buku/pinjam" method="post">
            <input type="hidden" name="id_buku" value="<?php echo $value['id_buku']?>">
            <input type="hidden" name="id_user" value="<?php echo $user['id_user']?>">
            <?php
            if ($value['dipinjam']<$value['jumlah']) {
              if ($statuspinjam==0&&$statuskembali==0) {
                echo '<button type="submit" class="btn btn-success"> Pinjam </button>';
              }
           }?>
          <button type="button" class="btn btn-danger" data-dismiss="modal"> Tutup </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php $i++;} ?>
</body>
</html>
