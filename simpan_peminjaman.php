<?php
include "session_guard.php";
include "koneksi.php";
function generateRandomString() {
    $prefix = "Pj-";
    $randomNumber = mt_rand(100, 999); // Generate a random 3-digit number
    return $prefix . $randomNumber;
}
$id_peminjaman = generateRandomString();
$nisn = $_POST["nisn"];
$tgl_pinjam = $_POST["tgl_pinjam"];
$tgl_harus_kembali = $_POST["tgl_harus_kembali"];
$id_admin = $_SESSION["id_admin"];
$status_pinjam = 'Pinjam';
$id_buku = $_POST["id_buku"];
$jumlah_pinjam = $_POST["jumlah_pinjam"];

$query_peminjaman = $koneksi->query("INSERT INTO peminjaman VALUES ('$id_peminjaman','$nisn','$tgl_pinjam','$tgl_harus_kembali','$id_admin','$status_pinjam')");
$query_detil_peminjaman = $koneksi->query("INSERT INTO detail_peminjaman VALUES ('$id_peminjaman','$id_buku','$jumlah_pinjam')");
header("Location: data_peminjaman.php");