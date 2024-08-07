<?php
include "header.php";
include "koneksi.php";
function reverse_tanggal($tanggal){
    $tmp = array_reverse(explode('-',$tanggal));
    return implode('-',$tmp);
}

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Data Peminjaman</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="tambah_peminjaman.php" class="btn btn-primary">Tambah Data</a>
                        </div>
                        <div class="col">
                            <form action="" method="GET" class="form-inline float-right">
                                <input type="text" name="cari_peminjaman" class="form-control">
                                <input type="submit" value="Cari" class="btn btn-primary ml-2" name="cari">
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Peminjaman</th>
                                    <th>Siswa</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Harus Kembali</th>
                                    <th>Buku</th>
                                    <th>Jumlah Pinjam</th>
                                    <th>Status Pinjam</th>
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
                                                                    A.status_pinjam,
                                                                    D.id_buku,
                                                                    E.judul AS judul_buku,
                                                                    E.isbn,
                                                                    D.jumlah_pinjam
                                                                FROM
                                                                    peminjaman AS A
                                                                INNER JOIN siswa AS B ON A.nisn = B.nisn
                                                                INNER JOIN admin AS C ON A.id_admin = C.id_admin
                                                                INNER JOIN detail_peminjaman AS D ON D.id_peminjaman = A.id_peminjaman
                                                                INNER JOIN buku AS E ON D.id_buku = E.id_buku
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
                                                                    A.status_pinjam,
                                                                    D.id_buku,
                                                                    E.judul AS judul_buku,
                                                                    E.isbn,
                                                                    D.jumlah_pinjam
                                                                FROM
                                                                    peminjaman AS A
                                                                INNER JOIN siswa AS B ON A.nisn = B.nisn
                                                                INNER JOIN admin AS C ON A.id_admin = C.id_admin
                                                                INNER JOIN detail_peminjaman AS D ON D.id_peminjaman = A.id_peminjaman
                                                                INNER JOIN buku AS E ON D.id_buku = E.id_buku");
                                    }
                                    while($row = $query->fetch_assoc()) { 
                                        $id_pinjam = $row["id_peminjaman"];
                                        $check_kembali = $koneksi->query("SELECT * FROM pengembalian WHERE id_pinjam = '$id_pinjam'")->num_rows > 0;
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row["id_peminjaman"] ?></td>
                                    <td><?= $row['nama_siswa'] ?></td>
                                    <td><?= reverse_tanggal($row['tgl_pinjam']) ?></td>
                                    <td><?= reverse_tanggal($row['tgl_harus_kembali']) ?></td>
                                    <td><?= $row["judul_buku"] ?> (<?= $row["id_buku"] ?>; ISBN <?= $row["isbn"] ?>) </td>
                                    <td><?= $row['jumlah_pinjam'] ?> buku</td>
                                    <td><span class="badge badge-primary"><?= $row["status_pinjam"] ?></span>
                                        <?php if(!$check_kembali){?>
                                        <span class="badge badge-<?php if(intval($row["sisa_waktu"]) >= 0) echo 'success'; else 'danger';?>">
                                            <?php $sisa_waktu = $row["sisa_waktu"]; if(intval($sisa_waktu) >= 0) echo "Sisa Waktu: $sisa_waktu hari";
                                            else {$lama_terlambat = abs($sisa_waktu); echo "Terlambat kembali: $lama_terlambat hari";} ?>
                                        </span></td>
                                        <?php } ?>
                                    <td>
                                        <?php
                                            if($check_kembali) { 
                                                $id_kembali_q = $koneksi->query("SELECT * FROM pengembalian WHERE id_pinjam = '$id_pinjam'")->fetch_assoc()["id_kembali"];
                                        ?>
                                        <a href="detil_pengembalian.php?id=<?= $id_kembali_q ?>" class="btn btn-success">Detil</a>
                                        <?php } else { ?>
                                            <a href="detil_peminjaman.php?id=<?= $row['id_peminjaman'] ?>" class="btn btn-success">Detil</a> | <a href="tambah_pengembalian.php?id=<?= $row['id_peminjaman'] ?>" class="btn btn-danger">Kembali</a>
                                        <?php } ?>
                                    </td>
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