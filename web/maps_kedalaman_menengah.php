<script src="grafik/jquery-2.1.4.min.js"></script>
<script src="grafik/highcharts.js"></script>
<!-- <script src="lib/jquery/jquery.min.js"></script>
-->
<section id="contact" class="wow fadeInUp">
  <div class="container">
    <div class="section-header">
      <h2>Informasi Jumlah Kejadian Gempa Dengan Kedalaman Menengah (60 - 299 KM)</h2>

    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="card" style="width: 100%;">
        <div class="card-header">
          <form class="form-inline pull-right" id="tahunJumlahKejadianForm">
            <input type="hidden" name="hal" value="maps_kedalaman_menengah">
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
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nama Kabupaten</th>
                      <th>Jumlah Kejadian Gempa</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query="
                    SELECT kabupaten.idkabupaten, namakabupaten, COUNT(*) AS jumlah FROM gempa 
                    JOIN kabupaten USING(idkabupaten)
                    WHERE kedalaman >= 60 AND kedalaman < 300
                    GROUP BY namakabupaten,kabupaten.idkabupaten 
                    ORDER BY count(*)
                    DESC
                    ";

                    if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                      $tahun = $mysqli->real_escape_string($_GET['tahun']);
                      $query="
                      SELECT kabupaten.idkabupaten,namakabupaten,COUNT(*) AS jumlah FROM gempa 
                      JOIN kabupaten USING(idkabupaten)
                      WHERE kedalaman >= 60 AND kedalaman < 300
                      AND YEAR(tanggal)={$tahun}
                      GROUP BY namakabupaten,kabupaten.idkabupaten 
                      ORDER BY count(*)
                      DESC
                      ";

                      if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                        $bulan = $mysqli->real_escape_string($_GET['bulan']);
                        $query="
                        SELECT kabupaten.idkabupaten,namakabupaten,COUNT(*) AS jumlah FROM gempa 
                        JOIN kabupaten USING(idkabupaten)
                        WHERE kedalaman >= 60 AND kedalaman < 300
                        AND YEAR(tanggal)={$tahun}
                        AND MONTH(tanggal)={$bulan}
                        GROUP BY namakabupaten,kabupaten.idkabupaten 
                        ORDER BY count(*)
                        DESC
                        ";
                      }
                    }

                    $result=$mysqli->query($query);
                    $num_result=$result->num_rows;
                    if ($num_result > 0 ) { 
                      while ($data=mysqli_fetch_assoc($result)) {
                        extract($data);
                        ?>
                        <tr>
                          <td><?php echo $namakabupaten; ?></td>
                          <td><?php echo $jumlah; ?></td>                        
                        </tr>
                        <?php }} ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <?php if (isset($_GET["tahun"]) && !empty($_GET["tahun"])) { ?>
              <div style="display: flex; padding-top: 10px; margin-bottom: 10px;">
                <div style="display: flex; margin-right: 16px;">
                  <div style="height: 18px; width: 18px; background-color: #00ff00; margin-right: 8px;"></div>

                  <div style="font-size: 12px;">
                    Jumlah kejadian < 101
                  </div>
                </div>

                <div style="display: flex; margin-right: 16px;">
                  <div style="height: 18px; width: 18px; background-color: #ffff00; margin-right: 8px;"></div>

                  <div style="font-size: 12px;">
                    Jumlah kejadian 101 - 200
                  </div>
                </div>

                <div style="display: flex;">
                  <div style="height: 18px; width: 18px; background-color: #ff0000; margin-right: 8px;"></div>

                  <div style="font-size: 12px;">
                    Jumlah kejadian > 200
                  </div>
                </div>
              </div>
              <?php }; ?>

              <div id="map" style="width:100%;height:550px;">
              </div> 
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
        var options = {
          chart: {
            renderTo: 'mygraph',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
          },
          title: {
            text: 'Presentase Kejadian Gempa Berdasarkan Kedalaman Menengah'
          },
          tooltip: {
            formatter: function() {
              return '<b>'+ this.point.name +'</b><br> '+ this.percentage +' %';
            }
          },
          plotOptions: {
           pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: true,
              color: '#000000',
              connectorColor: 'green',
              formatter: function() 
              {
                return '<b>' + this.point.name + '</b><br> (' + Highcharts.numberFormat(this.percentage, 2) +') % ';
              }
            }, 
            showInLegend: true
          }
        },
        series: [{
          type: 'pie',
          name: 'Informasi Data',
          data: []
        }]
      }

      var url = 'grafik_kedalaman_menengah.php';

      <?php if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
        $tahun = $_GET['tahun'];
        echo "url += '?tahun={$tahun}';";

        if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
          $bulan = $_GET['bulan'];
          echo "url += '&bulan={$bulan}'";
        }
      } ?>

      $.getJSON(url, function(json) {
        options.series[0].data = json;
        chart = new Highcharts.Chart(options);
      });

      $.ajax({
        type    : 'POST',
        url     : '../ajax/maps_kedalaman_menengah.php',
        data    : $('#tahunJumlahKejadianForm').serialize(),
        success : function (hasil){
          $('#map').html(hasil);
        }
      })
    }
  </script>