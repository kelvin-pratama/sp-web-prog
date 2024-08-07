<?php
include "header.php";
include "koneksi.php";
if(!isset($_GET['id'])){
    header('location: data_pengadaan.php');
}
$id = $_GET['id'];
$query = $koneksi->query("SELECT 
                            A.id_pengadaan,
                            A.tgl_pengadaan,
                            A.id_buku,
                            B.judul as judul_buku,
                            B.isbn,
                            D.nama_penerbit,
                            A.asal_buku,
                            A.jumlah as jumlah_pengadaan,
                            A.keterangan,
                            A.id_admin,
                            C.nama_lengkap,
                            C.username
                        FROM
                            pengadaan AS A
                        INNER JOIN buku AS B ON A.id_buku = B.id_buku
                        INNER JOIN admin AS C ON A.id_admin = C.id_admin
                        INNER JOIN penerbit AS D ON B.id_penerbit = D.id_penerbit
                        WHERE id_pengadaan = '$id'");
if($query->num_rows < 1){
    header('location: data_pengadaan.php');
}
$row = $query->fetch_assoc();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px">
            <div class="card">
                <h5 class="card-header">Detil Pengadaan</h5>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th width="20%">Kode Pengadaan</th>
                            <td width="80%"><?= $row["id_pengadaan"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Tanggal Pengadaan</th>
                            <td width="80%"><?php
                                $tmp = array_reverse(explode('-', $row["tgl_pengadaan"]));
                                echo implode('-',$tmp);
                            ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Judul Buku</th>
                            <td width="80%"><?= $row["judul_buku"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">ISBN</th>
                            <td width="80%"><?= $row["isbn"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Penerbit</th>
                            <td width="80%"><?= $row["nama_penerbit"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Asal Buku</th>
                            <td width="80%"><?= $row["asal_buku"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Jumlah Pengadaan</th>
                            <td width="80%"><?= $row["jumlah_pengadaan"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Keterangan</th>
                            <td width="80%"><?= $row["keterangan"] ?></td>
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