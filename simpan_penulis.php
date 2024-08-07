<?php
include "session_guard.php";
include "koneksi.php";
$nama_penulis = $_POST["nama_penulis"];
$query = $koneksi->query("INSERT INTO penulis VALUES (null,'$nama_penulis')");
header('location: data_penulis.php');