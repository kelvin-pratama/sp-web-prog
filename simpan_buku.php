<?php
include "koneksi.php";
$isbn = $_POST["isbn"];
$judul = $_POST["judul"];
$penulis = $_POST["penulis"];
$penerbit = $_POST["penerbit"];
$kategori = $_POST["kategori"];
$tahun_terbit = $_POST["tahun_terbit"];
$sinopsis = $_POST["sinopsis"];
$jumlah = $_POST["jumlah"];
$query = $koneksi->query("INSERT INTO buku VALUES (null,'$isbn','$judul','$penulis','$penerbit','$kategori','$tahun_terbit','$sinopsis','$jumlah',null)");
header('location: data_buku.php');