<?php
	$severname = "114.7.96.242";
	$username = "root";
	$password = "Absensi86!!";
	$dbname = "smarthome";

	$conn = new mysqli($severname, $username, $password, $dbname);
	if(!$conn){
		die("koneksi gagal" . mysqli_connect_error());
	}
	//echo "koneksi berhasil";
?>