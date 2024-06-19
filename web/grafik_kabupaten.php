<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';
session_start();

$idkabupaten=$mysqli->real_escape_string($_SESSION['kabupaten']);
$query="
SELECT YEAR(tanggal) AS label, COUNT(*) AS nilai FROM gempa
WHERE idkabupaten=$idkabupaten
GROUP BY YEAR(tanggal)
ORDER BY YEAR(tanggal)
";

$labels=[];

if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
	$labels=[
	"1" => 'Januari',
	"2" => 'Februari',
	"3" => 'Maret',
	"4" => 'April',
	"5" => 'Mei',
	"6" => 'Juni',
	"7" => 'Juli',
	"8" => 'Agustus',
	"9" => 'September',
	"10" => 'Oktober',
	"11" => 'November',
	"12" => 'Desember',
	];

	$tahun=$mysqli->real_escape_string($_GET['tahun']);
	$query="
	SELECT MONTH(tanggal) AS label, COUNT(*) AS nilai FROM gempa
	WHERE idkabupaten=$idkabupaten
	AND YEAR(tanggal)=$tahun
	GROUP BY MONTH(tanggal)
	ORDER BY MONTH(tanggal)
	";
} else {
	$result = $mysqli->query("
		SELECT DISTINCT YEAR(tanggal) as tahun FROM gempa
		ORDER BY YEAR(tanggal)
		");

	while ($data=mysqli_fetch_assoc($result)) {
		$labels[$data['tahun']] = $data['tahun'];
	}
}

$result=$mysqli->query($query);
$num_result=$result->num_rows;
$rows = [];
while ($data=mysqli_fetch_assoc($result)) {
	$rows[$data['label']] = $data['nilai'];
}

$toJSON = array();
foreach ($labels as $key => $value) {
	$json[0] = $value;

	if (array_key_exists($key, $rows)) {
		$json[1] = $rows[$key];
	} else {
		$json[1] = 0;
	}

	array_push($toJSON, $json);
}

print json_encode($toJSON, JSON_NUMERIC_CHECK);