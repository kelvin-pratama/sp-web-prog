<?php
include "session_guard.php";
include "koneksi.php";
$id_admin = $_GET["id"];
$query = $koneksi->query("DELETE FROM admin WHERE id_admin = '$id_admin'");
header('location: data_admin.php');