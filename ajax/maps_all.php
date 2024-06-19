<?php 
$server   = 'localhost';
$user   = 'root';
$pass   = '';
$db     = 'db_reza';

$con    = mysql_connect($server, $user, $pass) or die('gagal koneksi');
mysql_select_db($db, $con) or die('gagal database');

?>
<script>
  function initMap() {
    var lokasi = [
    <?php
    $sql = "SELECT * from gempa";
                //$sql = "SELECT * from gempa";

    $a = mysql_query($sql);
    while ($data = mysql_fetch_object($a)) {
      echo "['$data->idgempa',";
      echo "'$data->tanggal',";
      echo "$data->lat,"; 
      echo "$data->longi,"; 
      echo "'$data->detail',"; 
      echo "$data->kedalaman,"; 
      echo "'$data->kekuatan'],"; 
    }
    ?>
    ];

    var infowindow = new google.maps.InfoWindow();
    var mapOptions = {
     center:new google.maps.LatLng(-8.5830695,116.3202515), 
     zoom:8,
     mapTypeId:google.maps.MapTypeId.ROADMAP
   };

   var map = new google.maps.Map(document.getElementById("map"),mapOptions);
   var marker,i;

   for (i = 0; i<lokasi.length; i++) {
    // var url;

    if (lokasi[i][6] < 3) {
      url = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
    } else if (lokasi[i][6] < 6) {
      url = 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png'
    } else {
      url = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
    }

    marker = new google.maps.Marker({
      icon: {
        url: url,
      },
      position: new google.maps.LatLng(lokasi[i][2],lokasi[i][3]),
      map:map
    });
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent('<a <b>'+lokasi[i][1]+'</b></a><br><div class="panel"> Kedalaman = '+lokasi[i][5]+'<br> Kekuatan = '+lokasi[i][6]+'<br>Keterangan = '+lokasi[i][4]+'</div>');
        infowindow.open(map, marker);
      }
    })(marker, i));
  }

  map.data.loadGeoJson('../json/5201.geojson');
  map.data.loadGeoJson('../json/5202.geojson');
  map.data.loadGeoJson('../json/5203.geojson');
  map.data.loadGeoJson('../json/5204.geojson');
  map.data.loadGeoJson('../json/5205.geojson');
  map.data.loadGeoJson('../json/5206.geojson');
  map.data.loadGeoJson('../json/5207.geojson');
  map.data.loadGeoJson('../json/5271.geojson');
  map.data.loadGeoJson('../json/5272.geojson');

    map.data.setStyle(function(feature) { // memberikan style pada setiap garis
    var color = feature.getProperty('color'); // color mengambil dari property json
    return {
      fillColor: color,
      strokeWeight: 1
    };
  });

    map.data.addListener('mouseover', function(event) {
      map.data.revertStyle();
      map.data.overrideStyle(event.feature, {strokeWeight: 4});
      document.getElementById('info-box').innerHTML  =
      "Wilayah = "+event.feature.getProperty('name')
      ;
    });

    map.data.addListener('mouseout', function(event) {
      map.data.revertStyle();
      document.getElementById('info-box').innerHTML  = "?";
    });
    
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWfzKm2hI-mFjdQdHqRzMDFc5svKXBwUg&callback=initMap">
</script> 