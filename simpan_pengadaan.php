<?php
include "session_guard.php";
include "koneksi.php";
function generateRandomString() {
    $prefix = "P-";
    $randomNumber = mt_rand(1000, 9999); // Generate a random 3-digit number
    return $prefix . $randomNumber;
}
$id_pengadaan = generateRandomString();
$tgl_pengadaan = $_POST["tgl_pengadaan"];
$id_buku = $_POST["id_buku"];
$asal_buku = $_POST["asal_buku"];
$jumlah = $_POST["jumlah_pengadaan"];
$keterangan = $_POST["keterangan"];
$id_admin = $_SESSION["id_admin"];
$query = $koneksi->query("INSERT INTO pengadaan VALUES ('$id_pengadaan','$tgl_pengadaan','$id_buku','$asal_buku','$jumlah','$keterangan','$id_admin')");
$jumlah_buku_sebelum = intval($koneksi->query("SELECT jumlah FROM buku WHERE id_buku = '$id_buku'")->fetch_assoc()["jumlah"]);
$jumlah_buku_sesudah = $jumlah_buku_sebelum + intval($jumlah);
$update_jumlah_buku = $koneksi->query("UPDATE buku SET jumlah = '$jumlah_buku_sesudah' WHERE id_buku = '$id_buku'");
header("Location: data_pengadaan.php");