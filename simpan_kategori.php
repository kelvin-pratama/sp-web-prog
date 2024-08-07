<?php
include "session_guard.php";
include "koneksi.php";
$nama_kategori = $_POST["nama_kategori"];
$query = $koneksi->query("INSERT INTO kategori VALUES (null,'$nama_kategori')");
header('location: data_kategori.php');