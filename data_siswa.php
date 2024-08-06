<?php
include "koneksi.php";
include "header.php";

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Data Siswa</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="tambah_siswa.php" class="btn btn-primary">Tambah Data</a>
                        </div>
                        <div class="col">
                            <form action="" method="GET" class="form-inline float-right">
                                <input type="text" name="cari_siswa" class="form-control">
                                <input type="submit" value="Cari" class="btn btn-primary ml-2" name="cari">
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No.</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat/Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Nomor HP</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php 
                                    $i = 1;
                                    if(isset($_GET['cari'])){
                                        $term = $_GET['cari_siswa'];
                                        $query = $koneksi->query("SELECT * FROM siswa 
                                                                    WHERE (nama_siswa LIKE '%$term%')");
                                    } else {
                                        $query = $koneksi->query("SELECT * FROM siswa");
                                    }
                                    while($row = $query->fetch_assoc()) { 
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row['nisn'] ?></td>
                                    <td><?= $row['nama_siswa'] ?></td>
                                    <td><?php if($row['jkel'] == "L") echo "Laki-laki";
                                         else if($row['jkel'] == "P") echo "Perempuan";
                                         else                         echo "Salah data";  ?></td>
                                    <td><?= $row['tempat_lahir'] ?>, <?php 
                                        $tmp = array_reverse(explode('-',$row['tgl_lahir']));
                                        echo implode('-',$tmp);
                                    ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['no_hp'] ?></td>
                                    <td><a href="edit_siswa.php?id=<?= $row['nisn'] ?>" class="btn btn-warning">Edit</a> | <a href="hapus_siswa.php?id=<?= $row['nisn'] ?>" class="btn btn-danger">Hapus</a></td>
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