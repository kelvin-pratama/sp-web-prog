<?php
include "session_guard.php";
include "koneksi.php";

$isbn = $_POST["isbn"];
$judul = $_POST["judul"];
$penulis = $_POST["penulis"];
$penerbit = $_POST["penerbit"];
$kategori = $_POST["kategori"];
$tahun_terbit = $_POST["tahun_terbit"];
$sinopsis = $_POST["sinopsis"];
$jumlah = $_POST["jumlah"];
$kode_buku = $_POST["kode_buku"];
$query = $koneksi->query("UPDATE buku SET isbn = '$isbn', judul = '$judul', id_penulis = '$penulis', id_penerbit = '$penerbit', id_kategori = '$kategori', tahun_terbit = '$tahun_terbit', sinopsis = '$sinopsis', jumlah = '$jumlah' WHERE id_buku = '$kode_buku'");
header('location: data_buku.php');