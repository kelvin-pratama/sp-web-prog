<?php
include "koneksi.php";
$id_buku = $_GET["id"];
$query = $koneksi->query("DELETE FROM buku WHERE id_buku = '$id_buku'");
header('location: data_buku.php');