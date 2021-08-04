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

function tambahpelanggan($data) {
	global $conn;

	$kodepelanggan = htmlspecialchars($data["kodepelanggan"]);
	$nama = htmlspecialchars($data["nama"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$kota = htmlspecialchars($data["kota"]);
	$email = htmlspecialchars($data["email"]);
	$telepon = htmlspecialchars($data["telepon"]);

	$query = "INSERT INTO pelanggan
				VALUES
			  ('$kodepelanggan', '$nama', '$alamat', '$kota', '$email', '$telepon', '0')
			";
			// var_dump($query);die;
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapuspelanggan($kodepelanggan) {
	global $conn;
	$query = "UPDATE pelanggan SET deleted = 1 WHERE Kode_Pelanggan = '$kodepelanggan'";
	// var_dump($query);die;
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function ubahbarang($data) {
	global $conn;

	$kodepelanggan = $data["kodepelanggan"];
	$nama = htmlspecialchars($data["nama"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$kota = htmlspecialchars($data["kota"]);
	$email = htmlspecialchars($data["email"]);
	$telepon = htmlspecialchars($data["telepon"]);
	

	$query = "UPDATE pelanggan SET
				Nama_Pelanggan = '$nama',
				Alamat_Pelanggan  = '$alamat',
				Kota_Pelanggan = '$kota',
				Email_Pelanggan  = '$email',
				Telp_Pelanggan   = '$telepon'
			  WHERE Kode_Pelanggan = '$kodepelanggan'
			";
	// var_dump($query);die;
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}

?>