<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <!-- Navbar start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Data Master
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="data_buku.php">Buku</a>
                            <a class="dropdown-item" href="data_penulis.php">Penulis</a>
                            <a class="dropdown-item" href="data_penerbit.php">Penerbit</a>
                            <a class="dropdown-item" href="data_kategori.php">Kategori</a>
                            <a class="dropdown-item" href="data_siswa.php">Siswa</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Transaksi
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="data_peminjaman.php">Peminjaman</a>
                            <a class="dropdown-item" href="data_pengembalian.php">Pengembalian</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="data_pengadaan.php">Pengadaan</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="data_admin.php">Admin</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->
