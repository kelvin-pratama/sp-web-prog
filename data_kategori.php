<?php
include "koneksi.php";
include "header.php";

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Data Kategori</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="tambah_kategori.php" class="btn btn-primary">Tambah Data</a>
                        </div>
                        <div class="col">
                            <form action="" method="GET" class="form-inline float-right">
                                <input type="text" name="cari_kategori" class="form-control">
                                <input type="submit" value="Cari" class="btn btn-primary ml-2" name="cari">
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Kategori</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php 
                                    $i = 1;
                                    if(isset($_GET['cari'])){
                                        $term = $_GET['cari_kategori'];
                                        $query = $koneksi->query("SELECT * FROM kategori WHERE nama LIKE '%$term%'");
                                    } else {
                                        $query = $koneksi->query("SELECT * FROM kategori");
                                    }
                                    while($row = $query->fetch_assoc()) { 
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row['id_kategori'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><a href="edit_kategori.php?id=<?= $row['id_kategori'] ?>" class="btn btn-warning">Edit</a> | <a href="hapus_kategori.php?id=<?= $row['id_kategori'] ?>" class="btn btn-danger">Hapus</a></td>
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