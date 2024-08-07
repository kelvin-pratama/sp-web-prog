<?php
include "session_guard.php";
include "koneksi.php";
$id_penerbit = $_GET["id"];
$query = $koneksi->query("DELETE FROM penerbit WHERE id_penerbit = '$id_penerbit'");
header('location: data_penerbit.php');