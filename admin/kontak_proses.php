<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_GET['hapus'])){

	$stmt = $mysqli->prepare("DELETE FROM kontak where idkontak=?");
	$stmt->bind_param("s",mysqli_real_escape_string($mysqli, $_GET['hapus'])); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data Kontak Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=kontak';</script>";	
	} else {
		echo "<script>alert('Data Kontak Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>