<?php
include "session_guard.php";
include "koneksi.php";
$id_admin = $_POST["id_admin"];
$nama_lengkap = $_POST["nama_lengkap"];
$username = $_POST["username"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$query = $koneksi->query("UPDATE admin SET nama_lengkap = '$nama_lengkap', username = '$username', password = '$password' WHERE id_admin = '$id_admin'");
header('location: data_admin.php');