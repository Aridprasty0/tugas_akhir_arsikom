<?php 
$server   = 'localhost';
$user   = 'root';
$pass   = '';
$db     = 'db_reza';

$con    = mysqli_connect($server, $user, $pass) or die('gagal koneksi');
mysqli_select_db($con, $db) or die('gagal database');

?>
<script>
  function initMap() {
    var lokasi = [];
    <?php
    $query="
    SELECT
    namakabupaten,
    COUNT(*) AS jumlah,
    AVG(kedalaman) as rata_kedalaman,
    MAX(kekuatan) as kekuatan_terbesar,
    MIN(kekuatan) as kekuatan_terkecil
    FROM gempa
    JOIN kabupaten USING(idkabupaten)
    WHERE kedalaman >= 300
    GROUP BY namakabupaten
    ";

    if (isset($_POST['tahun']) && !empty($_POST['tahun'])) {
      $tahun = mysqli_escape_string($con, $_POST['tahun']);
      $query="
      SELECT
      namakabupaten,
      COUNT(*) AS jumlah,
      AVG(kedalaman) as rata_kedalaman,
      MAX(kekuatan) as kekuatan_terbesar,
      MIN(kekuatan) as kekuatan_terkecil
      FROM gempa 
      JOIN kabupaten USING(idkabupaten)
      WHERE YEAR(tanggal)={$tahun}
      AND kedalaman >= 300
      GROUP BY namakabupaten
      ";

      if (isset($_POST['bulan']) && !empty($_POST['bulan'])) {
        $bulan = mysqli_escape_string($con, $_POST['bulan']);
        $query="
        SELECT
        namakabupaten,
        COUNT(*) AS jumlah,
        AVG(kedalaman) as rata_kedalaman,
        MAX(kekuatan) as kekuatan_terbesar,
        MIN(kekuatan) as kekuatan_terkecil
        FROM gempa 
        JOIN kabupaten USING(idkabupaten)
        WHERE YEAR(tanggal)={$tahun}
        AND MONTH(tanggal)={$bulan}
        AND kedalaman >= 300
        GROUP BY namakabupaten
        ";
      }
    }

    $a = mysqli_query($con, $query);
    while ($data = mysqli_fetch_assoc($a)) {
      echo "lokasi.push({ nama: '".$data['namakabupaten']."', jumlah: ".$data['jumlah'].", rata_kedalaman: '".$data['rata_kedalaman']."', kekuatan_terbesar: '".$data['kekuatan_terbesar']."', kekuatan_terkecil: '".$data['kekuatan_terkecil']."' });";
    }
    ?>

    var infowindow = new google.maps.InfoWindow();
    var mapOptions = {
     center:new google.maps.LatLng(-8.583333, 117.516667), 
     zoom:8.5,
     mapTypeId:google.maps.MapTypeId.ROADMAP
   };

   var map = new google.maps.Map(document.getElementById("map"),mapOptions);

   map.data.loadGeoJson('../json/Kabupaten Lombok Utara.geojson');
   map.data.loadGeoJson('../json/Kabupaten Lombok Barat.geojson');
   map.data.loadGeoJson('../json/Kabupaten Lombok Tengah.geojson');
   map.data.loadGeoJson('../json/Kabupaten Lombok Timur.geojson');
   map.data.loadGeoJson('../json/Kabupaten Sumbawa.geojson');
   map.data.loadGeoJson('../json/Kabupaten Dompu.geojson');
   map.data.loadGeoJson('../json/Kabupaten Bima.geojson');
   map.data.loadGeoJson('../json/Kabupaten Sumbawa Barat.geojson');
   map.data.loadGeoJson('../json/Kota Mataram.geojson');
   map.data.loadGeoJson('../json/Kota Bima.geojson');

   map.data.setStyle(function(feature) {
    var color = '#000000';

    <?php if (isset($_POST["tahun"]) && !empty($_POST["tahun"])) { ?>
      var kabkot = feature.getProperty('KABKOT');
      color = 'green';

      lokasi.forEach(function(item, index) {
        if (kabkot == item.nama) {
          if (item.jumlah > 100 && item.jumlah <= 200) {
            color = 'yellow';
          } else if (item.jumlah > 200) {
            color = 'red';
          }
        }
      })
      <?php }; ?>

      return {
        fillColor: color,
        strokeColor: color,
        strokeWeight: 1
      };
    });

   map.data.addListener('mouseover', function(event) {
    map.data.revertStyle();
    map.data.overrideStyle(event.feature, {strokeWeight: 3});
      // document.getElementById('info-box').innerHTML  =
      // "Wilayah = "+event.feature.getProperty('name')
      // ;
    });

   map.data.addListener('mouseout', function(event) {
    map.data.revertStyle();
      // document.getElementById('info-box').innerHTML  = "?";
    });


   map.data.addListener('click', function(event) {
    var feature = event.feature
    var nama = event.feature.getProperty('KABKOT')
    var jumlah = 0
    var kekuatan_terbesar = 0.0
    var kekuatan_terkecil = 0.0
    var rata_kedalaman = 0

    lokasi.forEach(function(item, index) {
      if (item.nama == nama) {
        jumlah = item.jumlah
        kekuatan_terkecil = item.kekuatan_terkecil
        kekuatan_terbesar = item.kekuatan_terbesar
        rata_kedalaman = item.rata_kedalaman
      }
    })

    var html = '<span><b>Wilayah</b>: ' + nama + '</span><br />' + '<span><b>Total Kejadian</b>: ' + jumlah + '</span><br />' + '<span><b>Kekuatan Terbesar</b>: ' + kekuatan_terbesar + ' SR</span><br />' + '<span><b>Kekuatan Terkecil</b>: ' + kekuatan_terkecil + ' SR</span><br />' + '<span><b>Rata-Rata Kedalaman</b>: ' + rata_kedalaman + ' KM</span><br />'
    infowindow.setContent(html)
    infowindow.setPosition(event.latLng)
    infowindow.open(map)
  })

 }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWfzKm2hI-mFjdQdHqRzMDFc5svKXBwUg&callback=initMap">
</script> 