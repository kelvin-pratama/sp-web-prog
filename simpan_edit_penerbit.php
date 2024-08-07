<?php
include "session_guard.php";
include "koneksi.php";
$id_penerbit = $_POST["id"];
$nama_penerbit = $_POST["nama_penerbit"];
$kota_penerbit = $_POST["kota_penerbit"];
$query = $koneksi->query("UPDATE penerbit SET nama_penerbit = '$nama_penerbit', kota = '$kota_penerbit' WHERE id_penerbit = '$id_penerbit'");
header('location: data_penerbit.php');