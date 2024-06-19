<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

$query="
SELECT namakabupaten,COUNT(*) AS jumlah FROM gempa 
JOIN kabupaten USING(idkabupaten)
WHERE kekuatan >= 3 AND kekuatan < 5
GROUP BY namakabupaten 
ORDER BY count(*)
DESC
";

if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
	$tahun = $mysqli->real_escape_string($_GET['tahun']);
	$query="
	SELECT namakabupaten,COUNT(*) AS jumlah FROM gempa 
	JOIN kabupaten USING(idkabupaten)
	WHERE kekuatan >= 3 AND kekuatan < 5
	AND YEAR(tanggal)={$tahun}
	GROUP BY namakabupaten 
	ORDER BY count(*)
	DESC
	";

	if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
	$bulan = $mysqli->real_escape_string($_GET['bulan']);
	$query="
	SELECT namakabupaten,COUNT(*) AS jumlah FROM gempa 
	JOIN kabupaten USING(idkabupaten)
	WHERE kekuatan >= 3 AND kekuatan < 5
	AND YEAR(tanggal)={$tahun}
	AND MONTH(tanggal)={$bulan}
	GROUP BY namakabupaten 
	ORDER BY count(*)
	DESC
	";
}
}

$result=$mysqli->query($query);
$num_result=$result->num_rows;
$rows = array();
if ($num_result > 0 ) { 
	while ($data=mysqli_fetch_assoc($result)) {
		extract($data);

		$row[0] = $namakabupaten;
		$row[1] = round($jumlah,2);
		array_push($rows,$row);
	}}

	print json_encode($rows, JSON_NUMERIC_CHECK);