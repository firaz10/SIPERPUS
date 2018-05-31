<!DOCTYPE html>
<html>
<head>
  <title>Kelola Buku</title>
</head>
<body>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Buku</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">  Anda dapat mengelola pengguna yang terdaftar dalam sistem di halaman ini.</p>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">

            <a class="btn btn-primary buttons-print btn-sm" tabindex="0" aria-controls="datatable-buttons"data-toggle="modal" data-target="#tamBuku"><span>Tambah Buku</span></a>
          <thead>
            <tr>
              <th>Judul</th>
              <th>Pengarang</th>
              <th>Tahun</th>
              <th>Penerbit</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($buku as $key => $value) {
              ?>
            <tr>
              <td><?php echo $value['judul_buku']; ?></td>
              <td><?php echo $value['pengarang']; ?></td>
              <td><?php echo $value['tahun']; ?></td>
              <td><?php echo $value['penerbit']; ?></td>
              <td style="text-align:center">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit<?php echo $value['id_buku'] ?>"><i class="fa fa-pencil"></i> Edit </button>
                <a href="kel_buku/hapBuku?id=<?php echo $value['id_buku']?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
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
  foreach ($buku as $key => $value) {
    ?>
  <div class="modal fade" id="edit<?php echo $value['id_buku'] ?>" tabindex="-1" role="dialog" aria-labelledby="editLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true"?>&times</span></button>
          <h4 class="modal-title" id="editLabel">Edit Rincian Buku</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-label-left" action="kel_buku/edBuku" method="post" novalidate enctype="multipart/form-data">
            <p>Silahkan isi form berikut dengan data anggota terbaru</p>
            <input type="hidden" name="id_buku" value="<?php echo $value['id_buku']?>">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="judul_buku">Judul Buku <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="judul_buku" class="form-control col-md-7 col-xs-12" name="judul_buku"  required="required" type="text" value="<?php echo $value['judul_buku'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenis_buku">Jenis Buku <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="jenis_buku" class="form-control col-md-7 col-xs-12" name="jenis_buku"  required="required" type="text" value="<?php echo $value['jenis_buku'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pengarang">Pengarang <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="pengarang" class="form-control col-md-7 col-xs-12" name="pengarang"  required="required" type="text" value="<?php echo $value['pengarang'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="penerbit">Penerbit <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="penerbit" class="form-control col-md-7 col-xs-12" name="penerbit"  required="required" type="text" value="<?php echo $value['penerbit'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun">Tahun <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="tahun" class="form-control col-md-7 col-xs-12" name="tahun"  required="required" type="text" value="<?php echo $value['tahun'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tempat">Tempat <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="tempat" class="form-control col-md-7 col-xs-12" name="tempat"  required="required" type="text" value="<?php echo $value['tempat'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sinopsis">Sinopsis <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="sinopsis" name="sinopsis" required="required" class="form-control col-md-7 col-xs-12" ><?php echo $value['sinopsis'] ?></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="jumlah" class="form-control col-md-7 col-xs-12" name="jumlah"  required="required" type="text" value="<?php echo $value['jumlah'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sampul">Cover <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" id="sampul" name="sampul"  >
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button type="submit" class="btn btn-success">Perbarui</button>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer"></div>
      </div>
    </div>
  </div>
    <?php $i++;} ?>
    <div class="modal fade" id="tamBuku" tabindex="-1" role="dialog" aria-labelledby="tamBukuLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true"?>&times</span></button>
            <h4 class="modal-title" id="tamBukuLabel">Buku Baru</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left" action="kel_buku/tamBuku" method="post" novalidate enctype="multipart/form-data">
              <p>Silahkan isi form berikut dengan data buku baru</a>
              </p>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="judul_buku">Judul Buku <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="judul_buku" class="form-control col-md-7 col-xs-12" name="judul_buku"  required="required" type="text" >
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenis_buku">Jenis Buku <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="jenis_buku" class="form-control col-md-7 col-xs-12" name="jenis_buku"  required="required" type="text" >
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pengarang">Pengarang <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="pengarang" class="form-control col-md-7 col-xs-12" name="pengarang"  required="required" type="text" >
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="penerbit">Penerbit <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="penerbit" class="form-control col-md-7 col-xs-12" name="penerbit"  required="required" type="text" >
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun">Tahun <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="tahun" class="form-control col-md-7 col-xs-12" name="tahun"  required="required" type="text" >
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tempat">Tempat <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="tempat" class="form-control col-md-7 col-xs-12" name="tempat"  required="required" type="text">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sinopsis">Sinopsis <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="sinopsis" name="sinopsis" required="required" class="form-control col-md-7 col-xs-12" ></textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="jumlah" class="form-control col-md-7 col-xs-12" name="jumlah"  required="required" type="text" >
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sampul">Cover <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="sampul" name="sampul"  required="required">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <button type="reset" class="btn btn-warning">Reset</button>
                  <button id="send" type="submit" class="btn btn-success">Proses</button>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
</body>
</html>
