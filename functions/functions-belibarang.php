<?php

$conn = mysqli_connect("localhost", "root", "", "kpdiana");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function tambahbelibarang($data) {
	global $conn;

	$kodebarang = htmlspecialchars($data["kodebarang"]);
	$namabarang = htmlspecialchars($data["namabarang"]);
	$unit = htmlspecialchars($data["unit"]);
	$hargabeli = htmlspecialchars($data["hargabeli"]);
	$hargajual = htmlspecialchars($data["hargajual"]);

	$query = "INSERT INTO identitas_barang
				VALUES
			  ('$kodebarang', '$namabarang', '$unit', '$hargabeli', '$hargajual', null, null, CURRENT_TIMESTAMP() ,0)
			";
			// var_dump($query);die;
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapusbarang($kodebarang) {
	global $conn;
	$query = "UPDATE identitas_barang SET deleted = 1 WHERE Kode_Barang = '$kodebarang'";
	// var_dump($query);die;
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function ubahbarang($data) {
	global $conn;

	$kodebarang = $data["kodebarang"];
	$namabarang = htmlspecialchars($data["namabarang"]);
	$unit = htmlspecialchars($data["unit"]);
	$hargabeli = htmlspecialchars($data["hargabeli"]);
	$hargajual = htmlspecialchars($data["hargajual"]);
	

	$query = "UPDATE identitas_barang SET
				Nama_Barang = '$namabarang',
				Unit = '$unit',
				Harga_beli = '$hargabeli',
				Harga_jual = '$hargajual'
			  WHERE Kode_Barang = '$kodebarang'
			";
	// var_dump($query);die;
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

?>