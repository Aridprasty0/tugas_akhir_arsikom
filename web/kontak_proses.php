<?php
session_start();
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';


$stmt = $mysqli->prepare("INSERT INTO kontak 
	(nama,email,pesan,tanggal) 
	VALUES (?,?,?,?)");

$stmt->bind_param("ssss", 
	mysqli_real_escape_string($mysqli, $_POST['nama']),
	mysqli_real_escape_string($mysqli, $_POST['email']),
	mysqli_real_escape_string($mysqli, $_POST['pesan']),
	mysqli_real_escape_string($mysqli, date('Y-m-d h:i:s')));	

if ($stmt->execute()) { 
	echo "<script>alert('Terima Kasih, Pesan anda berhasil dikirim')</script>";
	echo "<script>window.location='index.php?hal=beranda';</script>";	
} else {
	echo "<script>alert('Pesan anda gagal dikirim')</script>";
	echo "<script>window.location='javascript:history.go(-1)';</script>";
}

	

?>