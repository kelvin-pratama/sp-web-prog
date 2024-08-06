<?php
include "koneksi.php";
include "header.php";

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Data Buku</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="tambah_buku.php" class="btn btn-primary">Tambah Data</a>
                        </div>
                        <div class="col">
                            <form action="" method="GET" class="form-inline float-right">
                                <input type="text" name="cari_buku" class="form-control">
                                <input type="submit" value="Cari" class="btn btn-primary ml-2" name="cari">
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Buku</th>
                                    <th>ISBN</th>
                                    <th>Judul Buku</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Kategori</th>
                                    <th>Tahun Terbit</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php 
                                    $i = 1;
                                    if(isset($_GET['cari'])){
                                        $term = $_GET['cari_buku'];
                                        $query = $koneksi->query("SELECT 
                                                                    A.id_buku, 
                                                                    A.isbn, 
                                                                    A.judul, 
                                                                    A.id_penulis, 
                                                                    B.nama_penulis, 
                                                                    A.id_penerbit, 
                                                                    C.nama_penerbit, 
                                                                    C.kota AS 'kota_penerbit', 
                                                                    A.id_kategori, 
                                                                    D.nama AS 'nama_kategori', 
                                                                    A.tahun_terbit, 
                                                                    A.sinopsis, 
                                                                    A.jumlah, 
                                                                    A.foto_sampul 
                                                                    FROM 
                                                                        buku AS A 
                                                                        INNER JOIN penulis AS B ON A.id_penulis = B.id_penulis 
                                                                        INNER JOIN penerbit AS C ON A.id_penerbit = C.id_penerbit 
                                                                        INNER JOIN kategori AS D ON A.id_kategori = D.id_kategori 
                                                                    WHERE (A.judul LIKE '%$term%'
                                                                            OR A.isbn LIKE '%$term%'
                                                                            OR B.nama_penulis LIKE '%$term%'
                                                                            OR C.nama_penerbit LIKE '%$term%'
                                                                            OR D.nama LIKE '%$term%')");
                                    } else {
                                        $query = $koneksi->query("SELECT 
                                                                    A.id_buku, 
                                                                    A.isbn, 
                                                                    A.judul, 
                                                                    A.id_penulis, 
                                                                    B.nama_penulis, 
                                                                    A.id_penerbit, 
                                                                    C.nama_penerbit, 
                                                                    C.kota AS 'kota_penerbit', 
                                                                    A.id_kategori, 
                                                                    D.nama AS 'nama_kategori', 
                                                                    A.tahun_terbit, 
                                                                    A.sinopsis, 
                                                                    A.jumlah, 
                                                                    A.foto_sampul 
                                                                    FROM 
                                                                        buku AS A 
                                                                        INNER JOIN penulis AS B ON A.id_penulis = B.id_penulis 
                                                                        INNER JOIN penerbit AS C ON A.id_penerbit = C.id_penerbit 
                                                                        INNER JOIN kategori AS D ON A.id_kategori = D.id_kategori");
                                    }
                                    while($row = $query->fetch_assoc()) { 
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row['id_buku'] ?></td>
                                    <td><?= $row['isbn'] ?></td>
                                    <td><?= $row['judul'] ?></td>
                                    <td><?= $row['nama_penulis'] ?></td>
                                    <td><?= $row['nama_penerbit'] ?></td>
                                    <td><?= $row['nama_kategori'] ?></td>
                                    <td><?= $row['tahun_terbit'] ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td><a href="edit_buku.php?id=<?= $row['id_buku'] ?>" class="btn btn-warning">Edit</a> | <a href="hapus_buku.php?id=<?= $row['id_buku'] ?>" class="btn btn-danger">Hapus</a></td>
                                </tr>
                                <?php $i++;} ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>