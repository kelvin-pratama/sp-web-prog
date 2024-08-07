<?php
include "session_guard.php";
include "koneksi.php";
$id_penulis = $_POST["id"];
$nama_penulis = $_POST["nama_penulis"];
$query = $koneksi->query("UPDATE penulis SET nama_penulis = '$nama_penulis' WHERE id_penulis = '$id_penulis'");
header('location: data_penulis.php');