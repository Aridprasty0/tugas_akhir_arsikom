<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sistem Informasi Pemetaan Gempa NTB</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- DataTables -->
  <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>

<!-- =======================================================
Theme Name: Reveal
Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
Author: BootstrapMade.com
License: https://bootstrapmade.com/license/
======================================================= -->
</head>
<body id="body">

<!--==========================
Top Bar
============================-->
<!--   <section id="topbar" class="d-none d-lg-block">
<div class="container clearfix">
<div class="contact-info float-left">
<i class="fa fa-envelope-o"></i> <a href="mailto:contact@example.com">contact@example.com</a>
<i class="fa fa-phone"></i> +1 5589 55488 55
</div>
<div class="social-links float-right">
<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
<a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
</div>
</div>
</section> -->

<!--==========================
Header
============================-->
<header id="header">
  <div class="container">

    <div id="logo" class="pull-left">
      <h1 style="font-size: 25px;!important"><img src="../assets/logo.png" height="60px" style="margin: 0px;"><a href="#body" class="scrollto">Provinsi <span> NTB</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
    </div>

    <?php
    $hal='beranda';

    if (isset($_GET['hal'])) {
      switch ($_GET['hal']) {
        case 'beranda':
        $hal = 'beranda';
        break;
        case 'maps':
        $hal = 'maps';
        break;
        case 'maps_kabupaten':
        $hal = 'maps_kabupaten';
        break;
        case 'kontak':
        $hal = 'kontak';
        break;
        default:
        $hal = 'statistik';
        break;
      }
    }
    ?>

    <nav id="nav-menu-container">
      <ul class="nav-menu">
        <li class="<?php if ($hal == 'beranda') { echo 'menu-active'; } ?>"><a href="?hal=beranda">Home</a></li>
        <li class="<?php if ($hal == 'maps') { echo 'menu-active'; } ?>"><a href="?hal=maps">Persebaran Gempa</a></li>
        <li class="menu-has-children <?php if ($hal == 'statistik') { echo 'menu-active'; } ?>"><a href="#">Statistik Gempa</a>
          <ul>
            <li><a href="?hal=maps_kejadian">Jumlah Kejadian</a></li>
            <li class="menu-has-children">
              <a href="?hal=maps_kedalaman">Per-Kedalaman</a>
              <ul>
                <li><a href="?hal=maps_kedalaman_dangkal">Kedalaman Dangkal Per-Kabupaten</a></li>
                <li><a href="?hal=maps_kedalaman_menengah">Kedalaman Menengah Per-Kabupaten</a></li>
                <li><a href="?hal=maps_kedalaman_dalam">Kedalaman Dalam Per-Kabupaten</a></li>
              </ul>
            </li>
            <li>
              <a href="?hal=maps_kekuatan">Per-Kekuatan</a>
              <ul>
                <li><a href="?hal=maps_kekuatan_tidak_terasa">Kekuatan Gempa Tidak Terasa Per-Kabupaten</a></li>
                <li><a href="?hal=maps_kekuatan_kerusakan_kecil">Kekuatan Gempa Kerusakan Kecil Per-Kabupaten</a></li>
                <li><a href="?hal=maps_kekuatan_kerusakan_cukup_besar">Kekuatan Gempa Kerusakan Cukup Besar Per-Kabupaten</a></li>
                <li><a href="?hal=maps_kekuatan_kerusakan_serius">Kekuatan Gempa Kerusakan Serius Per-Kabupaten</a></li>
              </ul>
            </li>
          </ul>
        </li>
<!--           <li><a href="#portfolio">Portfolio</a></li>
  <li><a href="#team">Team</a></li> -->
  <li class="menu-has-children <?php if ($hal == 'maps_kabupaten') { echo 'menu-active'; } ?>"><a href="#">Gempa - Per Kabupaten</a>
    <ul>
      <?php
      $query="SELECT * from kabupaten";
      $result=$mysqli->query($query);
      $num_result=$result->num_rows;
      if ($num_result > 0 ) { 
        while ($data=mysqli_fetch_assoc($result)) {
          extract($data);
          ?>
          <li><a href="?hal=maps_kabupaten&id=<?php echo $idkabupaten ?>"><?php echo $namakabupaten; ?></a></li>
          <?php }} ?>
        </ul>
      </li>
      
      <li class="<?php if ($hal == 'kontak') { echo 'menu-active'; } ?>"><a href="?hal=kontak">Kontak Kami</a></li>
      <li><a href="../login.php">Login</a></li>
    </ul>
  </nav><!-- #nav-menu-container -->
</div>
</header><!-- #header -->
<main id="main">
  <?php
  $hal = @$_GET['hal'];
  $modul = "";
  $default = $modul."beranda.php";
  if(!$hal){
    require_once "$default";
  }else{
    switch($hal){
      case $hal:
      if(is_file($modul.$hal.".php"))
      {
        require_once $modul.$hal.".php";
      }
      else
      {
        require_once "$default";
      }
      break;
      default:
      require_once "$default";
    }
  }
  ?>

</main>
<!--==========================
Footer
============================-->
<footer id="footer">
  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong>Aridianprastyo</strong>. All Rights Reserved
    </div>
    <div class="credits">
<!--
All the links in the footer should remain intact.
You can delete the links only if you purchased the pro version.
Licensing information: https://bootstrapmade.com/license/
Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
-->
Designed by <a href="https://bootstrapmade.com/">Aridianprastyo</a>
</div>
</div>
</footer><!-- #footer -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript Libraries -->
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/superfish/hoverIntent.js"></script>
<script src="lib/superfish/superfish.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/magnific-popup/magnific-popup.min.js"></script>
<script src="lib/sticky/sticky.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<!-- init -->
<script src="../assets/pages/jquery.datatables.init.js"></script>

<!-- Contact Form JavaScript File -->
<script src="contactform/contactform.js"></script>

<!-- Template Main Javascript File -->
<script src="js/main.js"></script>

</body>
</html>
