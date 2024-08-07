<?php
include "session_guard.php";
include "koneksi.php";
$nama_lengkap = $_POST["nama_lengkap"];
$username = $_POST["username"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$query = $koneksi->query("INSERT INTO admin VALUES (null,'$nama_lengkap','$username','$password')");
header('location: data_admin.php');