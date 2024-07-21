<?php
include "header.php";
include "koneksi.php";
if(!isset($_GET['id'])){
    header('location: data_kategori.php');
}
$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM kategori WHERE id_kategori = '$id'");
if($query->num_rows < 1){
    header('location: data_kategori.php');
}
$row = $query->fetch_assoc();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Tambah Data Kategori</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_edit_kategori.php" method="POST">
                                <div class="form-group">
                                    <label for="">Nama Kategori</label>
                                    <input type="hidden" name="id" value="<?= $row["id_kategori"] ?>">
                                    <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori" value="<?= $row["nama"] ?>" required>
                                </div>
                                <input type="submit" value="Simpan" class="btn btn-primary">
                            </form>
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