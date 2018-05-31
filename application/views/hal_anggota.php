<!DOCTYPE html>
<html>
<head>
  <title>Halaman Angoota</title>
</head>
<body>
                  <!-- top tiles -->
                  <div class="row tile_count">
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                      <span class="count_top"><i class="fa fa-user"></i> Jumlah Peminjaman</span>
                      <div class="count"><?php echo $injam;?></div>
                      <span class="count_bottom">Peminjaman</span>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                      <span class="count_top"><i class="fa fa-book"></i> Jumlah Pengembalian </span>
                      <div class="count"><?php echo $balik;?></div>
                      <span class="count_bottom">Pengembalian</span>
                    </div>
                  </div>
                  <!-- /top tiles -->
  </body>
</html>
