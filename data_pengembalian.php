<?php
include "header.php";
include "koneksi.php";
function reverse_tanggal($tanggal){
    $tmp = array_reverse(explode('-',$tanggal));
    return implode('-',$tmp);
}
function formatRupiah($number) {
    return 'Rp' . number_format($number, 2, ',', '.');
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Data Pengembalian</h5>
                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col">
                            <a href="tambah_pengembalian.php" class="btn btn-primary">Tambah Data</a>
                        </div> -->
                        <div class="col">
                            <form action="" method="GET" class="form-inline float-right">
                                <input type="text" name="cari_pengembalian" class="form-control">
                                <input type="submit" value="Cari" class="btn btn-primary ml-2" name="cari">
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Pengembalian</th>
                                    <th>Kode Peminjaman</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th>Status Pinjam</th>
                                    <th>Denda</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php 
                                    $i = 1;
                                    if(isset($_GET['cari'])){
                                        $term = $_GET['cari_peminjaman'];
                                        $query = $koneksi->query("SELECT
                                                                    A.id_peminjaman,
                                                                    A.nisn,
                                                                    B.nama_siswa,
                                                                    A.tgl_pinjam,
                                                                    A.tgl_harus_kembali,
                                                                    DATEDIFF(A.tgl_harus_kembali, A.tgl_pinjam) AS sisa_waktu,
                                                                    A.id_admin,
                                                                    C.nama_lengkap,
                                                                    C.username,
                                                                    A.status_pinjam,
                                                                    D.id_buku,
                                                                    E.judul AS judul_buku,
                                                                    E.isbn,
                                                                    D.jumlah_pinjam,
                                                                    F.id_kembali,
                                                                    F.tgl_kembali,
                                                                    F.denda
                                                                FROM
                                                                    peminjaman AS A
                                                                INNER JOIN siswa AS B ON A.nisn = B.nisn
                                                                INNER JOIN admin AS C ON A.id_admin = C.id_admin
                                                                INNER JOIN detail_peminjaman AS D ON D.id_peminjaman = A.id_peminjaman
                                                                INNER JOIN buku AS E ON D.id_buku = E.id_buku
                                                                INNER JOIN pengembalian AS F ON F.id_pinjam = A.id_peminjaman
                                                                WHERE
                                                                    (A.nisn LIKE '%$term%'
                                                                        OR B.nama_siswa LIKE '%$term%'
                                                                        OR E.judul LIKE '%$term%'
                                                                        OR E.isbn LIKE '%$term%')
                                        ");
                                    } else {
                                        $query = $koneksi->query("SELECT
                                                                    A.id_peminjaman,
                                                                    A.nisn,
                                                                    B.nama_siswa,
                                                                    A.tgl_pinjam,
                                                                    A.tgl_harus_kembali,
                                                                    DATEDIFF(A.tgl_harus_kembali, A.tgl_pinjam) AS sisa_waktu,
                                                                    A.id_admin,
                                                                    C.nama_lengkap,
                                                                    C.username,
                                                                    A.status_pinjam,
                                                                    D.id_buku,
                                                                    E.judul AS judul_buku,
                                                                    E.isbn,
                                                                    D.jumlah_pinjam,
                                                                    F.id_kembali,
                                                                    F.tgl_kembali,
                                                                    F.denda
                                                                FROM
                                                                    peminjaman AS A
                                                                INNER JOIN siswa AS B ON A.nisn = B.nisn
                                                                INNER JOIN admin AS C ON A.id_admin = C.id_admin
                                                                INNER JOIN detail_peminjaman AS D ON D.id_peminjaman = A.id_peminjaman
                                                                INNER JOIN buku AS E ON D.id_buku = E.id_buku
                                                                INNER JOIN pengembalian AS F ON F.id_pinjam = A.id_peminjaman");
                                    }
                                    while($row = $query->fetch_assoc()) { 
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row["id_kembali"] ?></td>
                                    <td><?= $row['id_peminjaman'] ?></td>
                                    <td><?= reverse_tanggal($row['tgl_pinjam']) ?></td>
                                    <td><?= reverse_tanggal($row['tgl_kembali']) ?></td>
                                    <td>
                                        <?php
                                            $tgl_pinjam = new DateTime($row["tgl_pinjam"]);
                                            $tgl_kembali = new DateTime($row["tgl_kembali"]);
                                            $lama_pinjam = $tgl_kembali->diff($tgl_pinjam);
                                            if($lama_pinjam->d > 3) {
                                        ?>
                                        <span class="badge badge-danger">Terlambat: <?= $lama_pinjam->d - 3 ?> hari</span>
                                        <?php } else { ?>
                                        <span class="badge badge-success">Tepat Waktu</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= formatRupiah($row['denda']) ?></td>
                                    <td><a href="detil_pengembalian.php?id=<?= $row['id_kembali'] ?>" class="btn btn-success">Detil</a></td>
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