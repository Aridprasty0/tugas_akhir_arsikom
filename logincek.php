<?php
session_start();
require_once 'setting/crud.php';
require_once 'setting/koneksi.php';
require_once 'setting/tanggal.php';

	$user=$_POST['username'];
	$pass=$_POST['password']; 

	//Pengecekan ada data dalam login tidak
	$sqladmin="Select idadmin from admin where username='$user' and password='$pass'";

	if (cekdata($mysqli,$sqladmin)== true){
		
		//JIka data ditemukan
		$_SESSION['admin']=caridata($mysqli,$sqladmin);
		echo "<script>alert('Anda login sebagai Admin')</script>";
		echo "<script>window.location='admin/index.php?hal=beranda';</script>";	

	}else{
		//Jika tidak ditemukan
		echo "<script>alert('Username atau password tidak terdaftar')</script>";
		echo "<script>window.location='index.php';</script>";
	
	}

?>