<?php
include "header.php";
include "koneksi.php";

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Data Penulis</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="tambah_penulis.php" class="btn btn-primary">Tambah Data</a>
                        </div>
                        <div class="col">
                            <form action="" method="GET" class="form-inline float-right">
                                <input type="text" name="cari_penulis" class="form-control">
                                <input type="submit" value="Cari" class="btn btn-primary ml-2" name="cari">
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Penulis</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php 
                                    $i = 1;
                                    if(isset($_GET['cari'])){
                                        $term = $_GET['cari_penulis'];
                                        $query = $koneksi->query("SELECT * FROM penulis WHERE nama_penulis LIKE '%$term%'");
                                    } else {
                                        $query = $koneksi->query("SELECT * FROM penulis");
                                    }
                                    while($row = $query->fetch_assoc()) { 
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row['nama_penulis'] ?></td>
                                    <td><a href="detil_penulis.php?id=<?= $row['id_penulis'] ?>" class="btn btn-success">Detil</a> | <a href="edit_penulis.php?id=<?= $row['id_penulis'] ?>" class="btn btn-warning">Edit</a> | <a href="hapus_penulis.php?id=<?= $row['id_penulis'] ?>" class="btn btn-danger">Hapus</a></td>
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