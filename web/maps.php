<script src="lib/jquery/jquery.min.js"></script>

<section id="about" class="wow fadeInUp">
  <div class="container">
    <div class="row">
      <div class="card" style="width: 100%;">
        <div class="card-header">
          <div class="pull-left" style="display: flex; padding-top: 10px;">
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

          <form class="form-inline pull-right" id="carimaps">
            <div class="form-group mb-2">
              <label for="staticEmail2" class="sr-only">Email</label>
              <span class="primary">Periode Gempa</span>
            </div>

            <div class="form-group mx-sm-2 mb-2">
              <label for="staticEmail2" class="sr-only">Tahun</label>
              <select class="form-control" name="tahun">
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

              <div class="form-group mx-sm-2 mb-2">
                <label for="staticEmail2" class="sr-only">Bulan</label>
                <select class="form-control" name="bulan">
                  <option value="">-Pilih Bulan-</option>
                  <option value="1">Januari</option>
                  <option value="2">Februari</option>
                  <option value="3">Maret</option>
                  <option value="4">April</option>
                  <option value="5">Mei</option>
                  <option value="6">Juni</option>
                  <option value="7">Juli</option>
                  <option value="8">Agustus</option>
                  <option value="9">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Desember</option>
                </select>
              </div>

              <div class="form-group mx-sm-2 mb-2">
                <a href="javascript:void(0)" onclick="return cari()" class="btn btn-primary">Cari</a>
              </div>

            </form>
          </div>
          <div class="card-body">
            <div id="map" style="width:100%;height:550px;">
            </div> 
          </div>

        </div>
      </div>
    </div>
  </section>

  <script>
    $( document ).ready(function() {
      cari();
    });

    function cari(){
      $.ajax({
        type    : 'POST',
        url     : '../ajax/maps.php',
        data    : $('#carimaps').serialize(),
        success : function (hasil){
          $('#map').html(hasil);
        }
      })
    }
  </script>