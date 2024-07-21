<?php
include "koneksi.php";
$id_kategori = $_POST["id"];
$nama_kategori = $_POST["nama_kategori"];
$query = $koneksi->query("UPDATE kategori SET nama = '$nama_kategori' WHERE id_kategori = '$id_kategori'");
header('location: data_kategori.php');