<?php
include "koneksi.php";
$nisn = $_POST["nisn"];
$nama_siswa = $_POST["nama_siswa"];
$jkel = $_POST["jkel"];
$tempat_lahir = $_POST["tempat_lahir"];
$tgl_lahir = $_POST["tgl_lahir"];
$alamat = $_POST["alamat"];
$no_hp = $_POST["no_hp"];
$query = $koneksi->query("UPDATE siswa SET nama_siswa = '$nama_siswa', jkel = '$jkel', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', alamat = '$alamat', no_hp = '$no_hp' WHERE nisn = '$nisn'");
header('Location: data_siswa.php');