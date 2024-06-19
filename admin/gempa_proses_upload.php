<?php 
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';
require_once '../setting/excel_reader.php';

$target = basename($_FILES['berkas_gempa']['name']) ;
move_uploaded_file($_FILES['berkas_gempa']['tmp_name'], $target);

chmod($_FILES['berkas_gempa']['name'], 0755);

$data = new Spreadsheet_Excel_Reader($_FILES['berkas_gempa']['name'], false);
$jumlah_baris = $data->rowcount($sheet_index=0);

if ($jumlah_baris > 0) {
	$result = $mysqli->query("SELECT idkabupaten, lat, longi, luas_area FROM kabupaten WHERE NOT idkabupaten = 1");
	$kabupaten = array();

	if ($result->num_rows > 0 ) { 
		while ($each=mysqli_fetch_assoc($result)) {
			array_push($kabupaten, $each);
		}
	}

	$query = "INSERT INTO gempa (tanggal,jam,detail,lat,longi,kedalaman,kekuatan,idkabupaten) VALUES";

	for ($i=2;$i<$jumlah_baris;$i++) {
		$idKabupaten = 1;
		$minDistance = null;

		$tanggal = date("Y-m-d", strtotime($data->val($i, 2)));
		$jam = $data->val($i, 3);
		$lat = $data->val($i, 4);
		$longi = $data->val($i, 5);
		$kedalaman = $data->val($i, 6);
		$kekuatan = $data->val($i, 7);
		$detail = $data->val($i, 8);

		foreach ($kabupaten as $value) {
			$latFrom = deg2rad($lat);
			$longiFrom = deg2rad($longi);
			$latTo = deg2rad($value["lat"]);
			$longiTo = deg2rad($value["longi"]);
			$longiDelta = $longiTo - $longiFrom;
			$a = pow(cos($latTo) * sin($longiDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($longiDelta), 2);
			$b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($longiDelta);
			$angle = atan2(sqrt($a), $b);
			$distance = $angle * 6371;
			$radius = sqrt($value["luas_area"] / 3.14);

			if (is_null($minDistance) || $distance <= $minDistance) {
				if ($distance <= $radius) {
					$idKabupaten = $value["idkabupaten"];
					$minDistance = $distance;
				}
			}
		}

		$query = "{$query} ('${tanggal}', '${jam}', '{$detail}', '{$lat}', '{$longi}', '{$kedalaman}', '{$kekuatan}', {$idKabupaten}),";
	}

	$query = rtrim($query, ",");
	$stmt = $mysqli->prepare($query);

	if ($stmt->execute()) { 
		echo "<script>alert('Data gempa Berhasil Disimpan')</script>";
		echo "<script>window.location='index.php?hal=gempa';</script>";	
	} else {
		echo "<script>alert('Data gempa Gagal Disimpan')</script>";
		echo "<script>window.location='javascript:history.go(-1)';</script>";
	}
}

?>