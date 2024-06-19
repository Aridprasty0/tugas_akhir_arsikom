<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

if(isset($_POST['tambah']))
{

	$stmt = $mysqli->prepare("INSERT INTO gempa 
		(tanggal,jam,detail,lat,longi,kedalaman,kekuatan,idkabupaten) 
		VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

	$stmt->bind_param("ssssssss",
		mysqli_real_escape_string($mysqli, $_POST['tanggal']),
		mysqli_real_escape_string($mysqli, $_POST['jam']),
		mysqli_real_escape_string($mysqli, $_POST['keterangan']),
		mysqli_real_escape_string($mysqli, $_POST['lat']),
		mysqli_real_escape_string($mysqli, $_POST['longi']),
		mysqli_real_escape_string($mysqli, $_POST['kedalaman']),
		mysqli_real_escape_string($mysqli, $_POST['kekuatan']), 
		mysqli_real_escape_string($mysqli, $_POST['kabupaten']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data gempa Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=gempa';</script>";	
	} else {
		echo "<script>alert('Data gempa Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_POST['ubah'])){


	$stmt = $mysqli->prepare("UPDATE gempa  SET 
		tanggal=?,
		jam=?,
		detail=?,
		lat=?,
		longi=?,
		kedalaman=?,
		kekuatan=?,
		idkabupaten=?
		where idgempa=?");
	$stmt->bind_param("sssssssss",
		mysqli_real_escape_string($mysqli, $_POST['tanggal']),
		mysqli_real_escape_string($mysqli, $_POST['jam']),
		mysqli_real_escape_string($mysqli, $_POST['keterangan']),
		mysqli_real_escape_string($mysqli, $_POST['lat']),
		mysqli_real_escape_string($mysqli, $_POST['longi']),
		mysqli_real_escape_string($mysqli, $_POST['kedalaman']),
		mysqli_real_escape_string($mysqli, $_POST['kekuatan']), 
		mysqli_real_escape_string($mysqli, $_POST['kabupaten']),
		mysqli_real_escape_string($mysqli, $_POST['kode']));	

	if ($stmt->execute()) { 
		echo "<script>alert('Data gempa Berhasil Diubah')</script>";
		echo "<script>window.location='index.php?hal=gempa';</script>";	
	} else {
		echo "<script>alert('Data gempa Gagal Diubah')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}else if(isset($_GET['hapus'])){

	$stmt = $mysqli->prepare("DELETE FROM gempa where idgempa=?");
	$stmt->bind_param("s",mysqli_real_escape_string($mysqli, $_GET['hapus'])); 

	if ($stmt->execute()) { 
		echo "<script>alert('Data gempa Berhasil Dihapus')</script>";
		echo "<script>window.location='index.php?hal=gempa';</script>";	
	} else {
		echo "<script>alert('Data gempa Gagal Dihapus')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}

}
?>