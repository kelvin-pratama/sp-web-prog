<?php
include "koneksi.php";
$id_siswa = $_GET["id"];
$query = $koneksi->query("DELETE FROM siswa WHERE nisn = '$id_siswa'");
header('location: data_siswa.php');