<?php
include "header.php";
include "koneksi.php";
$data_peminjaman = $koneksi->query("SELECT COUNT(*) AS jumlah FROM peminjaman")->fetch_assoc();
$data_pengembalian = $koneksi->query("SELECT COUNT(*) AS jumlah FROM pengembalian")->fetch_assoc();
$data_buku = $koneksi->query("SELECT SUM(jumlah) AS jumlah FROM buku")->fetch_assoc();
$data_siswa = $koneksi->query("SELECT COUNT(*) AS jumlah FROM siswa")->fetch_assoc();
?>
<!-- Content start -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Selamat Datang</h1>
                    <p class="lead">Ini merupakan aplikasi perpustakaan sekolah berbasis web dengan menggunakan
                        PHP8, MySQL dan Bootstrap 4</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Peminjaman</h5>
                    <p class="card-text">Jumlah transaksi peminjaman <?= $data_peminjaman["jumlah"] ?></p>
                    <a href="#" class="btn btn-primary">Peminjaman</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pengembalian</h5>
                    <p class="card-text">Jumlah transaksi pengembalian <?= $data_pengembalian["jumlah"] ?></p>
                    <a href="#" class="btn btn-primary">Pengembalian</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Buku</h5>
                    <p class="card-text">Jumlah buku yang tersedia <?= $data_buku["jumlah"] ?> Buku</p>
                    <a href="#" class="btn btn-primary">Data Buku</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Siswa</h5>
                    <p class="card-text">Jumlah siswa yang ada <?= $data_siswa["jumlah"] ?> Siswa</p>
                    <a href="#" class="btn btn-primary">Data Siswa</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content end -->
<?php
include "footer.php";
?>