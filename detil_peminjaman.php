<?php
include "header.php";
include "koneksi.php";
if(!isset($_GET['id'])){
    header('location: data_peminjaman.php');
}
$id = $_GET['id'];
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
                            D.jumlah_pinjam
                        FROM
                            peminjaman AS A
                        INNER JOIN siswa AS B ON A.nisn = B.nisn
                        INNER JOIN admin AS C ON A.id_admin = C.id_admin
                        INNER JOIN detail_peminjaman AS D ON D.id_peminjaman = A.id_peminjaman
                        INNER JOIN buku AS E ON D.id_buku = E.id_buku
                        WHERE A.id_peminjaman = '$id'");
if($query->num_rows < 1){
    header('location: data_peminjaman.php');
}
$row = $query->fetch_assoc();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px">
            <div class="card">
                <h5 class="card-header">Detil Peminjaman</h5>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th width="20%">Kode Peminjaman</th>
                            <td width="80%"><?= $row["id_peminjaman"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Siswa</th>
                            <td width="80%"><?= $row["nama_siswa"] ?> (<?= $row["nisn"] ?>)</td>
                        </tr>
                        <tr>
                            <th width="20%">Buku</th>
                            <td width="80%"><?= $row["judul_buku"] ?> (Kode: <?= $row["id_buku"] ?>; ISBN: <?= $row["isbn"] ?>) </td>
                        </tr>
                        <tr>
                            <th width="20%">Jumlah Pinjam</th>
                            <td width="80%"><?= $row["jumlah_pinjam"] ?> buku</td>
                        </tr>
                        <tr>
                            <th width="20%">Tanggal Pinjam</th>
                            <td width="80%"><?php
                                $tmp = array_reverse(explode('-', $row["tgl_pinjam"]));
                                echo implode('-',$tmp);
                            ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Tanggal Harus Kembali</th>
                            <td width="80%"><?php
                                $tmp = array_reverse(explode('-', $row["tgl_harus_kembali"]));
                                echo implode('-',$tmp);
                            ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Status Pinjam</th>
                            <td width="80%"><span class="badge badge-primary"><?= $row["status_pinjam"] ?></span>
                                        <span class="badge badge-<?php if(intval($row["sisa_waktu"]) >= 0) echo 'success'; else 'danger';?>">
                                            <?php $sisa_waktu = $row["sisa_waktu"]; if(intval($sisa_waktu) >= 0) echo "Sisa Waktu: $sisa_waktu hari";
                                            else {$lama_terlambat = abs($sisa_waktu); echo "Terlambat kembali: $lama_terlambat hari";} ?>
                                        </span></td>
                        </tr>
                        <tr>
                            <th width="20%">Diinput Oleh</th>
                            <td width="80%"><?= $row["nama_lengkap"] ?> (<?= $row["username"] ?>)</td>
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