<?php
include "session_guard.php";
include "koneksi.php";

$id_buku = $_POST["id_buku"];
$total_buku = intval($koneksi->query("SELECT jumlah FROM buku WHERE id_buku = '$id_buku'")->fetch_assoc()["jumlah"]);
$total_pinjam = intval($koneksi->query("SELECT SUM(jumlah_pinjam) AS total_pinjam FROM detail_peminjaman WHERE id_buku = '$id_buku'")->fetch_assoc()["total_pinjam"]);
$jumlah_tersedia = $total_buku - $total_pinjam;
$check_avail = $jumlah_tersedia < 1;

if($check_avail)
    echo json_encode(array("available" => 0));
else
    echo json_encode(array("available" => 1, "jumlah_tersedia" => $jumlah_tersedia));
exit;