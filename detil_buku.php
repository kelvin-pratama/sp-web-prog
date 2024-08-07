<?php
include "header.php";
include "koneksi.php";
if(!isset($_GET['id'])){
    header('location: data_buku.php');
}
$id = $_GET['id'];
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
                        WHERE A.id_buku = '$id'");
if($query->num_rows < 1){
    header('location: data_buku.php');
}
$row = $query->fetch_assoc();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px">
            <div class="card">
                <h5 class="card-header">Detil Buku</h5>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th width="20%">Kode Buku</th>
                            <td width="80%"><?= $row["id_buku"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">ISBN</th>
                            <td width="80%"><?= $row["isbn"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Judul</th>
                            <td width="80%"><?= $row["judul"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Penulis</th>
                            <td width="80%"><?= $row["nama_penulis"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Penerbit</th>
                            <td width="80%"><?= $row["nama_penerbit"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Kategori</th>
                            <td width="80%"><?= $row["nama_kategori"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Tahun Terbit</th>
                            <td width="80%"><?= $row["tahun_terbit"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Sinopsis</th>
                            <td width="80%"><?= $row["sinopsis"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Jumlah</th>
                            <td width="80%"><?= $row["jumlah"] ?> buku</td>
                        </tr>
                        <tr>
                            <th width="20%">Status</th>
                            <td width="80%">
                                <?php
                                            $id_buku = $row["id_buku"];
                                            $total_buku = intval($koneksi->query("SELECT jumlah FROM buku WHERE id_buku = '$id_buku'")->fetch_assoc()["jumlah"]);
                                            $total_pinjam = intval($koneksi->query("SELECT SUM(jumlah_pinjam) AS total_pinjam FROM detail_peminjaman WHERE id_buku = '$id_buku'")->fetch_assoc()["total_pinjam"]);
                                            $jumlah_tersedia = $total_buku - $total_pinjam;
                                            $check_avail = $jumlah_tersedia < 1;
                                            if($check_avail) {
                                        ?>
                                            <span class="badge badge-danger">Tidak Tersedia: <?= $jumlah_tersedia ?> buku</span>
                                        <?php } else { ?>
                                            <span class="badge badge-success">Tersedia: <?= $jumlah_tersedia ?> buku</span>
                                        <?php } ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>