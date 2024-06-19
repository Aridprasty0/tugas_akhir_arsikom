    <!--==========================
      Selamat Datang
      ============================-->
<!--     <section id="about" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="img/about-img.jpg" alt="">
          </div>

          <div class="col-lg-6 content">
            <h2>Selamat Datang..</h2>
            <h3>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h3>

            <ul>
              <li><i class="ion-android-checkmark-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="ion-android-checkmark-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
              <li><i class="ion-android-checkmark-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
            </ul>

          </div>
        </div>

      </div>
    </section> -->
    <!-- #Selamat Datang -->

    <!--==========================
     Peta
     ============================-->
     <section id="contact" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Peta Provinsi NTB</h2>
          <p>Nusa Tenggara Barat ialah sebuah provinsi di Indonesia yang berada pada bagian barat Kepulauan Nusa Tenggara. Provinsi ini beribu kota di Mataram dan memiliki 10 Kabupaten dan Kota.</p>
        </div>
      </div>
    </div>

    <div class="container mb-12">
     <div id="map" style="width:100%;height:550px;">
     </div> 
   </div>
 </section>

 <script>
  function initMap() {
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
    return {
      fillColor: '#000000',
      strokeColor: '#000000',
      strokeWeight: 1
    };
  });

   map.data.addListener('mouseover', function(event) {
    map.data.revertStyle();
    map.data.overrideStyle(event.feature, {strokeWeight: 3});
  });

   map.data.addListener('mouseout', function(event) {
    map.data.revertStyle();
  });


   map.data.addListener('click', function(event) {
    var feature = event.feature
    var html = '<span><b>' + event.feature.getProperty('KABKOT') + '</b></span>'

    infowindow.setContent(html)
    infowindow.setPosition(event.latLng)
    infowindow.open(map)
  })

 }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWfzKm2hI-mFjdQdHqRzMDFc5svKXBwUg&callback=initMap">
</script> 

    <!-- #contact -->