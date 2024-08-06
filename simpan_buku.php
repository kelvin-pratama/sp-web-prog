<?php
include "koneksi.php";
function generateRandomString() {
    $prefix = "B-";
    $randomNumber = mt_rand(100, 999); // Generate a random 3-digit number
    return $prefix . $randomNumber;
}
$isbn = $_POST["isbn"];
$judul = $_POST["judul"];
$penulis = $_POST["penulis"];
$penerbit = $_POST["penerbit"];
$kategori = $_POST["kategori"];
$tahun_terbit = $_POST["tahun_terbit"];
$sinopsis = $_POST["sinopsis"];
$jumlah = $_POST["jumlah"];
$kode_buku = generateRandomString();
$query = $koneksi->query("INSERT INTO buku VALUES ('$kode_buku','$isbn','$judul','$penulis','$penerbit','$kategori','$tahun_terbit','$sinopsis','$jumlah',null)");
header('location: data_buku.php');