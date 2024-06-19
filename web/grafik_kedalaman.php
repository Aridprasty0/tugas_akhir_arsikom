<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

$query="
SELECT info, COUNT(*) AS jumlah FROM infokedalaman 
GROUP BY info
";

if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
	$tahun = $mysqli->real_escape_string($_GET['tahun']);
	$query="
	SELECT info, COUNT(*) AS jumlah FROM infokedalaman
	WHERE YEAR(tanggal)=$tahun 
	GROUP BY info
	";

	if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
		$bulan = $mysqli->real_escape_string($_GET['bulan']);
		$query="
		SELECT info, COUNT(*) AS jumlah FROM infokedalaman
		WHERE YEAR(tanggal)=$tahun
		AND MONTH(tanggal)=$bulan
		GROUP BY info
		";
	}
}

$result=$mysqli->query($query);
$num_result=$result->num_rows;
$rows = array();
if ($num_result > 0 ) { 
	while ($data=mysqli_fetch_assoc($result)) {
		extract($data);

		switch ($info) {
			case 'Dalam':
			$info = "$info (> 299 KM)";
			break;
			case 'Menengah':
			$info = "$info (60 - 299 KM)";
			break;
			case 'Dangkal':
			$info = "$info (< 60 KM)";
			break;
		}

		$row[0] = $info;
		$row[1] = round($jumlah,2);
		array_push($rows,$row);
	}}

	print json_encode($rows, JSON_NUMERIC_CHECK);