<?php
include "header.php";
include "koneksi.php";

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Data Admin</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="tambah_admin.php" class="btn btn-primary">Tambah Data</a>
                        </div>
                        <div class="col">
                            <form action="" method="GET" class="form-inline float-right">
                                <input type="text" name="cari_admin" class="form-control">
                                <input type="submit" value="Cari" class="btn btn-primary ml-2" name="cari">
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>Username</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php 
                                    $i = 1;
                                    if(isset($_GET['cari'])){
                                        $term = $_GET['cari_admin'];
                                        $query = $koneksi->query("SELECT * FROM admin WHERE (nama_lengkap LIKE '%$term%') OR (username LIKE '%$term%')");
                                    } else {
                                        $query = $koneksi->query("SELECT * FROM admin");
                                    }
                                    while($row = $query->fetch_assoc()) { 
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row['nama_lengkap'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><a href="edit_admin.php?id=<?= $row['id_admin'] ?>" class="btn btn-warning">Edit</a> | <a href="hapus_admin.php?id=<?= $row['id_admin'] ?>" class="btn btn-danger">Hapus</a></td>
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