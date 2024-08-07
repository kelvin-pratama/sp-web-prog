<?php
include "header.php";
include "koneksi.php";

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Data Pengadaan</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="tambah_pengadaan.php" class="btn btn-primary">Tambah Data</a>
                        </div>
                        <div class="col">
                            <form action="" method="GET" class="form-inline float-right">
                                <input type="text" name="cari_pengadaan" class="form-control">
                                <input type="submit" value="Cari" class="btn btn-primary ml-2" name="cari">
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No.</th>
                                    <th>Tgl. Pengadaan</th>
                                    <th>Nama Buku</th>
                                    <th>Asal Buku</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php 
                                    $i = 1;
                                    if(isset($_GET['cari'])){
                                        $term = $_GET['cari_pengadaan'];
                                        $query = $koneksi->query("SELECT 
                                                                    A.id_pengadaan,
                                                                    A.tgl_pengadaan,
                                                                    A.id_buku,
                                                                    B.judul as judul_buku,
                                                                    B.isbn,
                                                                    A.asal_buku,
                                                                    A.jumlah as jumlah_pengadaan,
                                                                    A.keterangan,
                                                                    A.id_admin,
                                                                    C.nama_lengkap
                                                                FROM
                                                                    pengadaan AS A
                                                                INNER JOIN buku AS B ON A.id_buku = B.id_buku
                                                                INNER JOIN admin AS C ON A.id_admin = C.id_admin
                                                                WHERE
                                                                    (B.judul LIKE '%$term%'
                                                                        OR B.isbn LIKE '%$term%'
                                                                        OR A.asal_buku LIKE '%$term%')
                                        ");
                                    } else {
                                        $query = $koneksi->query("SELECT 
                                                                    A.id_pengadaan,
                                                                    A.tgl_pengadaan,
                                                                    A.id_buku,
                                                                    B.judul as judul_buku,
                                                                    B.isbn,
                                                                    A.asal_buku,
                                                                    A.jumlah as jumlah_pengadaan,
                                                                    A.keterangan,
                                                                    A.id_admin,
                                                                    C.nama_lengkap
                                                                FROM
                                                                    pengadaan AS A
                                                                INNER JOIN buku AS B ON A.id_buku = B.id_buku
                                                                INNER JOIN admin AS C ON A.id_admin = C.id_admin");
                                    }
                                    while($row = $query->fetch_assoc()) { 
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?php
                                        $tmp = array_reverse(explode('-', $row["tgl_pengadaan"]));
                                        echo implode('-',$tmp);
                                     ?></td>
                                    <td><?= $row['judul_buku'] ?></td>
                                    <td><?= $row['asal_buku'] ?></td>
                                    <td><?= $row['jumlah_pengadaan'] ?> buku</td>
                                    <td><a href="detil_pengadaan.php?id=<?= $row['id_pengadaan'] ?>" class="btn btn-success">Detil</a></td>
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