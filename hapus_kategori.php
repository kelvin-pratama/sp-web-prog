<?php
include "session_guard.php";
include "koneksi.php";
$id_kategori = $_GET["id"];
$query = $koneksi->query("DELETE FROM kategori WHERE id_kategori = '$id_kategori'");
header('location: data_kategori.php');