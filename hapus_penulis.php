<?php
include "session_guard.php";
include "koneksi.php";
$id_penulis = $_GET["id"];
$query = $koneksi->query("DELETE FROM penulis WHERE id_penulis = '$id_penulis'");
header('location: data_penulis.php');