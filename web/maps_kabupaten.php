<?php
$_SESSION['kabupaten']=$_GET['id'];
?>

<script src="grafik/jquery-2.1.4.min.js"></script>
<script src="grafik/highcharts.js"></script>
<!-- <script src="lib/jquery/jquery.min.js"></script>
-->
<section id="contact" class="wow fadeInUp">
  <div class="container">
    <div class="section-header">
      <?php
      $kode=$mysqli->real_escape_string($_GET['id']);
      $namakabupaten=caridata($mysqli,"select namakabupaten from kabupaten where idkabupaten='$kode'");
      ?>
      <h2>Kabupaten : <?php  echo $namakabupaten; ?></h2>

    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="card" style="width: 100%;">
        <div class="card-header">
         <form class="form-inline pull-right" id="tahunJumlahKejadianForm">
           <input type="hidden" name="hal" value="maps_kabupaten">
           <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
           <div class="form-group mb-2">
            <select id="pickYear" class="form-control" name="tahun">
              <option value="">-Pilih Tahun-</option>
              <?php
              $result = $mysqli->query("
                SELECT DISTINCT YEAR(tanggal) as tahun FROM gempa
                ORDER BY YEAR(tanggal)
                ");
                while ($data=mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $data['tahun']; ?>" <?php if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                  if ($data['tahun'] == $_GET['tahun']) { echo "selected"; }
                } ?>><?= $data['tahun'] ?></option>
                <?php } ?>
              </select>
            </div>

            <?php if (isset($_GET["tahun"]) && !empty($_GET["tahun"])) { ?>
            <div class="form-group mx-sm-2 mb-2">
              <label for="staticEmail2" class="sr-only">Bulan</label>
              <select id="pickMonth" class="form-control" name="bulan">
                <option value="">-Pilih Bulan-</option>
                <option value="1" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '1') { echo "selected"; }
                } ?>>Januari</option>
                <option value="2" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '2') { echo "selected"; }
                } ?>>Februari</option>
                <option value="3" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '3') { echo "selected"; }
                } ?>>Maret</option>
                <option value="4" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '4') { echo "selected"; }
                } ?>>April</option>
                <option value="5" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '5') { echo "selected"; }
                } ?>>Mei</option>
                <option value="6" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '6') { echo "selected"; }
                } ?>>Juni</option>
                <option value="7" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '7') { echo "selected"; }
                } ?>>Juli</option>
                <option value="8" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '8') { echo "selected"; }
                } ?>>Agustus</option>
                <option value="9" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '9') { echo "selected"; }
                } ?>>September</option>
                <option value="10" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '10') { echo "selected"; }
                } ?>>Oktober</option>
                <option value="11" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '11') { echo "selected"; }
                } ?>>November</option>
                <option value="12" <?php if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                  if ($_GET['bulan'] == '12') { echo "selected"; }
                } ?>>Desember</option>
              </select>
            </div>
            <?php }; ?>
          </form>
        </div>
        <div class="card-body">

          <div class="col-12">
            <div class="panel panel-primary">
              <div class="panel-heading" style="color: white;">Data Dalam Bentuk Grafik</div>
              <div class="panel-body">
               <div id ="mygraph"></div>
             </div>
           </div>
         </div>

         <div class="col-12">
          <div class="panel panel-primary">
            <div class="panel-heading" style="color: white;">Data Dalam Bentuk Tabel</div>
            <div class="panel-body">
              <table id="datatable" class="table table-striped table-bordered" style="width: 100%">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Kabupaten</th>
                    <th>Keterangan</th>
                    <th>Kedalaman</th>
                    <th>Kekuatan</th>
                    <th>Lat</th>
                    <th>Long</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $kode=$mysqli->real_escape_string($_GET['id']);
                  $query="
                  SELECT g.tanggal, g.jam, k.namakabupaten, g.detail, g.kedalaman, g.kekuatan, g.lat, g.longi
                  from gempa g
                  join kabupaten k on k.idkabupaten=g.idkabupaten
                  where g.idkabupaten=$kode
                  order by g.tanggal";

                  if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                    $tahun = $mysqli->real_escape_string($_GET['tahun']);
                    $query="
                    SELECT g.tanggal, g.jam, k.namakabupaten, g.detail, g.kedalaman, g.kekuatan, g.lat, g.longi
                    from gempa g
                    join kabupaten k on k.idkabupaten=g.idkabupaten
                    where g.idkabupaten=$kode
                    AND YEAR(g.tanggal)=$tahun
                    order by g.tanggal";

                    if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                      $bulan = $mysqli->real_escape_string($_GET['bulan']);
                      $query="
                      SELECT g.tanggal, g.jam, k.namakabupaten, g.detail, g.kedalaman, g.kekuatan, g.lat, g.longi
                      from gempa g
                      join kabupaten k on k.idkabupaten=g.idkabupaten
                      where g.idkabupaten=$kode
                      AND YEAR(g.tanggal)=$tahun
                      AND MONTH(g.tanggal)=$bulan
                      order by g.tanggal";
                    }
                  }

                  $result=$mysqli->query($query);
                  $num_result=$result->num_rows;
                  if ($num_result > 0 ) { 
                    while ($data=mysqli_fetch_assoc($result)) {
                      extract($data);
                      ?>
                      <tr>
                        <td><?php echo $tanggal; ?></td>
                        <td><?php echo $jam; ?></td>
                        <td><?php echo $namakabupaten; ?></td>
                        <td><?php echo $detail; ?></td>
                        <td><?php echo $kedalaman; ?></td>
                        <td><?php echo $kekuatan; ?></td>
                        <td><?php echo $lat; ?></td>
                        <td><?php echo $longi; ?></td>
                      </tr>
                      <?php }} ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <?php if ($_GET['id']!=1){?>
            <div style="display: flex; padding-top: 10px; margin-bottom: 16px;">
              <div style="display: flex; margin-right: 16px;">
                <img style="height: 18px;" src="http://maps.google.com/mapfiles/ms/icons/green-dot.png" alt="marker-hijau" />

                <div style="font-size: 12px;">
                  Magnitudo gempa 1 - 2.9 SR
                </div>
              </div>

              <div style="display: flex; margin-right: 16px;">
                <img style="height: 18px;" src="http://maps.google.com/mapfiles/ms/icons/yellow-dot.png" alt="marker-hijau" />

                <div style="font-size: 12px;">
                  Magnitudo gempa 3 - 5.9 SR
                </div>
              </div>

              <div style="display: flex;">
                <img style="height: 18px;" src="http://maps.google.com/mapfiles/ms/icons/red-dot.png" alt="marker-hijau" />

                <div style="font-size: 12px;">
                  Magnitudo gempa >= 6 SR
                </div>
              </div>
            </div>

            <div id="map" style="width:100%;height:550px;">
            </div> 
            <?php } ?>
          </div>

        </div>
      </div>
    </div>

  </section><!-- #contact -->

  <script>
    $( document ).ready(function() {
      $('#pickYear').on('change', function() {
        $('#tahunJumlahKejadianForm').submit()
      })

      $('#pickMonth').on('change', function() {
        $('#tahunJumlahKejadianForm').submit()
      })


      cari();
    });

    function cari(){
      var seriesData = []
      var options = {
        chart: {
          type: 'line',
          renderTo: 'mygraph',
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false
        },

        title: {
          <?php if (isset($_GET['tahun']) && !empty($_GET['tahun'])) { ?>
            text: 'Sejarah Jumlah Kejadian Gempa Dalam Bulan'
            <?php } else { ?>
              text: 'Sejarah Jumlah Kejadian Gempa Dalam Tahun'
              <?php } ?>
            },

            yAxis: {
              min: 0,
              allowDecimals: false,
              title: {
                text: 'Jumlah Kejadian'
              }
            },

            xAxis: {
              title: {
               <?php if (isset($_GET['tahun']) && !empty($_GET['tahun'])) { ?>
                text: 'Bulan'
                <?php } else { ?>
                  text: 'Tahun'
                  <?php } ?>
                },
                allowDecimals: false,
                labels: {
                  enabled: true,
                  formatter: function() {
                    <?php if (isset($_GET['tahun']) && !empty($_GET['tahun'])) { ?>
                      return seriesData[this.value][0];
                      <?php } else { ?>
                        return this.value;
                        <?php } ?>
                      }
                    }
                  },

                  tooltip: {
                    formatter: function() {
                      console.log(this.y)
                      return '<b>'+ this.key +'</b><br> '+ this.y;
                    }
                  },

                  legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                  },

                  plotOptions: {
                    series: {
                      label: {
                        connectorAllowed: false
                      }
                    }

                  },
                  series: [{
                    name: 'Informasi Data',
                    data: []
                  }]
                }

                var url = 'grafik_kabupaten.php';

                <?php if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                  $tahun = $_GET['tahun'];
                  echo "url += '?tahun={$tahun}';";

                  if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                    $bulan = $_GET['bulan'];
                    echo "url += '&bulan={$bulan}'";
                  }
                } ?>

                $.getJSON(url, function(json) {
                  seriesData=json
                  options.series[0].data = json;
                  chart = new Highcharts.Chart(options);
                });

                <?php if($_SESSION['kabupaten'] != 1) { ?>
                  $.ajax({
                    type    : 'POST',
                    url     : '../ajax/maps_kabupaten.php',
                    data    : $('#tahunJumlahKejadianForm').serialize(),
                    success : function (hasil){
                      $('#map').html(hasil);
                    }
                  })
                  <?php } ?>

                }
              </script>