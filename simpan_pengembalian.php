<?php
include "session_guard.php";
include "koneksi.php";
function generateRandomString() {
    $prefix = "Kb-";
    $randomNumber = mt_rand(100, 999); // Generate a random 3-digit number
    return $prefix . $randomNumber;
}
$id_kembali = generateRandomString();
$id_pinjam = $_POST["id_pinjam"];
$tgl_kembali = $_POST["tgl_kembali"];
$id_admin = $_SESSION["id_admin"];
$denda = $_POST["denda"];

$query_pengembalian = $koneksi->query("INSERT INTO pengembalian VALUES ('$id_kembali','$id_pinjam','$tgl_kembali','$id_admin','$denda')");
$query_update_peminjaman = $koneksi->query("UPDATE peminjaman SET status_pinjam = 'Kembali' WHERE id_peminjaman = '$id_pinjam'");

header("Location: data_pengembalian.php");