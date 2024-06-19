<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{

	$stmt = $mysqli->prepare("INSERT INTO kabupaten 
		(namakabupaten) 
		VALUES (?)");

	$stmt->bind_param("s", 
		mysqli_real_escape_string($mysqli, $_POST['namakabupaten']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data kabupaten Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=kabupaten';</script>";	
	} else {
		echo "<script>alert('Data kabupaten Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){

	$stmt = $mysqli->prepare("UPDATE kabupaten  SET 
		namakabupaten=?
		where idkabupaten=?");
	$stmt->bind_param("ss",
		mysqli_real_escape_string($mysqli, $_POST['namakabupaten']), 
		mysqli_real_escape_string($mysqli, $_POST['idkabupaten']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data kabupaten Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=kabupaten';</script>";	
	} else {
		echo "<script>alert('Data kabupaten Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){

	$stmt = $mysqli->prepare("DELETE FROM kabupaten where idkabupaten=?");
	$stmt->bind_param("s",mysqli_real_escape_string($mysqli, $_GET['hapus'])); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data kabupaten Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=kabupaten';</script>";	
	} else {
		echo "<script>alert('Data kabupaten Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>