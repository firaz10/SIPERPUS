<!DOCTYPE html>
<html>
<head>
  <title>Kelola Anggota</title>
</head>
<body>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Daftar Pengguna </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <p class="text-muted font-13 m-b-30">
          Anda dapat mengelola pengguna yang terdaftar dalam sistem di halaman ini.
        </p>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <button class="btn btn-primary buttons-print btn-sm" tabindex="0" aria-controls="datatable-buttons" data-toggle="modal" data-target="#tamUser"><span>Tambah Anggota</span></buttons>
          <thead>
            <tr>
              <th>Nama</th>
              <th>Tanggal Lahir</th>
              <th>Alamat</th>
              <th>Kontak</th>
              <th>Hak Akses</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($anggota as $key => $value) {
              ?>
            <tr>
              <td><?php echo $value['nama']; ?></td>
              <td><?php echo $value['tgl_lahir']; ?></td>
              <td><?php echo $value['alamat']; ?></td>
              <td><?php echo $value['telp']; ?></td>
              <td><?php if ( $value['level'] == "admin") {
                echo "Admin";
              }
              else {
              echo "Anggota";
            }?></td>
              <td style="text-align:center">
                <button class="btn btn-info btn-xs" data-toggle="modal" data-target="#edit<?php echo $value['id_user'] ?>"><i class="fa fa-pencil"></i> Edit </button>
                <a href="kel_anggota/hapUser?id=<?php echo $value['id_user']?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
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
  foreach ($anggota as $key => $value) {
    ?>
  <div class="modal fade" id="edit<?php echo $value['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="rincianLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true"?>&times</span></button>
          <h4 class="modal-title" id="rincianLabel">Edit Rincian Anggota</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-label-left" action="kel_anggota/edUser" method="post" enctype="multipart/form-data">
            <p>Silahkan isi form berikut dengan data anggota terbaru</p>
            <input type="hidden" name="id_user" value="<?php echo $value['id_user']?>">
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="nama" class="form-control col-md-7 col-xs-12" name="nama"  required="required" type="text" value="<?php echo $value['nama'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="alamat" name="alamat" required="required" class="form-control col-md-7 col-xs-12" ><?php echo $value['alamat'] ?></textarea>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_lahir">Tanggal Lahir <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <fieldset>
                            <div class="control-group">
                              <div class="controls">
                                <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                                  <input type="text" name="tgl_lahir" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal Akhir" aria-describedby="inputSuccess2Status2">
                                  <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                  <span id="inputSuccess2Status" class="sr-only">(success)</span>
                                </div>
                              </div>
                            </div>
                </fieldset>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telp">Telepon <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="telp" name="telp" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $value['telp'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="username" class="form-control col-md-7 col-xs-12" name="username"  required="required" type="text" value="<?php echo $value['username'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label for="password" class="control-label col-md-3">Password</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="passbaru2" type="text" name="passbaru2" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $value['password'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Ulangi Password</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="password2" type="text" name="password2" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $value['password'] ?>">
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level">Hak Akses <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="level" name="level" class="form-control col-md-7 col-xs-12">
                  <option value="<?php echo $value['level'] ?>"><?php echo $value['level'] ?></option>
                  <option value="admin">Admin</option>
                  <option value="anggota">Anggota</option>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Foto <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" id="foto" name="foto" value="<?php echo $value['foto'] ?>">
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
    <div class="modal fade" id="tamUser" tabindex="-1" role="dialog" aria-labelledby="tamUserLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true"?>&times</span></button>
            <h4 class="modal-title" id="tamUserLabel">Anggota Baru</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal form-label-left" action="kel_anggota/tamUser" method="post" novalidate enctype="multipart/form-data">
              <p>Silahkan isi form berikut dengan data anggota baru</a>
              </p>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="nama" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" name="nama"  required="required" type="text">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="alamat" name="alamat" required="required" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tgl_lahir">Tanggal Lahir <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <fieldset>
                              <div class="control-group">
                                <div class="controls">
                                  <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                                    <input type="text" name="tgl_lahir" class="form-control has-feedback-left" id="single_cal2" placeholder="Tanggal Awal" aria-describedby="inputSuccess2Status2">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                  </div>
                                </div>
                              </div>
                  </fieldset>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telp">Telepon <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="telp" name="telp" required="required" class="form-control col-md-7 col-xs-12" data-validate-length-range="8,13">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="username" class="form-control col-md-7 col-xs-12" data-validate-length-range="6,10"  name="username"  required="required" type="text">
                </div>
              </div>
              <div class="item form-group">
                <label for="password" class="control-label col-md-3">Password</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="passbaru" type="password" name="passbaru" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                </div>
              </div>
              <div class="item form-group">
                <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Ulangi Password</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="password2" type="password" name="password2" data-validate-linked="passbaru" class="form-control col-md-7 col-xs-12" required="required">
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level">Hak Akses <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="level" name="level" class="form-control col-md-7 col-xs-12">
                    <option value="admin">Admin</option>
                    <option value="anggota">Anggota</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Foto <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="foto" name="foto"  required="required">
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