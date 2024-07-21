<?php
include "koneksi.php";
$nama_penerbit = $_POST["nama_penerbit"];
$kota_penerbit = $_POST["kota_penerbit"];
$query = $koneksi->query("INSERT INTO penerbit VALUES (null,'$nama_penerbit','$kota_penerbit')");
header('location: data_penerbit.php');