<?php
include "session_guard.php";
include "koneksi.php";
$nisn = $_POST["nisn"];
$nama_siswa = $_POST["nama_siswa"];
$jkel = $_POST["jkel"];
$tempat_lahir = $_POST["tempat_lahir"];
$tgl_lahir = $_POST["tgl_lahir"];
$alamat = $_POST["alamat"];
$no_hp = $_POST["no_hp"];
$query = $koneksi->query("INSERT INTO siswa VALUES ('$nisn','$nama_siswa','$jkel','$tempat_lahir','$tgl_lahir','$alamat','$no_hp',null)");
header('Location: data_siswa.php');