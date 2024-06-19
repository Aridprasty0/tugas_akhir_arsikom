<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_reza';

// Menggunakan mysqli_connect untuk koneksi database yang lebih aman
$con = mysqli_connect($server, $user, $pass, $db);
if (!$con) {
  die('Gagal koneksi: ' . mysqli_connect_error());
}

session_start();
if (isset($_POST['bulan']) && isset($_POST['tahun'])) {
  $_SESSION['bulan'] = $_POST['bulan'];
  $_SESSION['tahun'] = $_POST['tahun'];

  $bulan = mysqli_real_escape_string($con, $_POST['bulan']);
  $tahun = mysqli_real_escape_string($con, $_POST['tahun']);

  $sql = "SELECT * FROM gempa WHERE MONTH(tanggal) = ? AND YEAR(tanggal) = ?";
  $stmt = mysqli_prepare($con, $sql);
  mysqli_stmt_bind_param($stmt, "ss", $bulan, $tahun);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $lokasi = [];
  while ($data = mysqli_fetch_assoc($result)) {
    $lokasi[] = [
      'idgempa' => $data['idgempa'],
      'tanggal' => $data['tanggal'],
      'lat' => $data['lat'],
      'longi' => $data['longi'],
      'detail' => $data['detail'],
      'kedalaman' => $data['kedalaman'],
      'kekuatan' => $data['kekuatan']
    ];
  }
  mysqli_stmt_close($stmt);
} else {
  echo "<script>console.log('No month and year data received.');</script>";
}
?>
<script>
  function initMap() {
    var lokasi = <?php echo json_encode($lokasi); ?>;
    var mapOptions = {
      center: new google.maps.LatLng(-8.583333, 117.516667),
      zoom: 8.5,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

    lokasi.forEach(function (data) {
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(data.lat, data.longi),
        map: map,
        icon: data.kekuatan < 3 ? 'http://maps.google.com/mapfiles/ms/icons/green-dot.png' :
          data.kekuatan < 6 ? 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png' :
            'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
      });

      google.maps.event.addListener(marker, 'click', function () {
        var infowindow = new google.maps.InfoWindow({
          content: '<b>' + data.tanggal + '</b><br>' +
            'Kedalaman: ' + data.kedalaman + ' KM<br>' +
            'Kekuatan: ' + data.kekuatan + ' SR<br>' +
            'Keterangan: ' + data.detail
        });
        infowindow.open(map, marker);
      });
    });

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

    map.data.setStyle(function (feature) {
      return {
        fillColor: '#000000',
        strokeColor: '#000000',
        strokeWeight: 1
      };
    });

    map.data.addListener('mouseover', function (event) {
      map.data.revertStyle();
      map.data.overrideStyle(event.feature, { strokeWeight: 3 });
    });

    map.data.addListener('mouseout', function (event) {
      map.data.revertStyle();
    });

    map.data.addListener('click', function (event) {
      var feature = event.feature;
      var html = '<span><b>' + feature.getProperty('KABKOT') + '</b></span>';
      var infowindow = new google.maps.InfoWindow({
        content: html
      });
      infowindow.setPosition(event.latLng);
      infowindow.open(map);
    });
  }
</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWfzKm2hI-mFjdQdHqRzMDFc5svKXBwUg&callback=initMap"></script>