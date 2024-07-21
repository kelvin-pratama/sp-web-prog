<?php
include "header.php";
include "koneksi.php";
if(!isset($_GET['id'])){
    header('location: data_penerbit.php');
}
$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM penerbit WHERE id_penerbit = '$id'");
if($query->num_rows < 1){
    header('location: data_penerbit.php');
}
$row = $query->fetch_assoc();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Tambah Data Penerbit</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_edit_penerbit.php" method="POST">
                                <div class="form-group">
                                    <label for="">Nama Penerbit</label>
                                    <input type="hidden" name="id" value="<?= $row["id_penerbit"] ?>">
                                    <input type="text" class="form-control" placeholder="Nama Penerbit" name="nama_penerbit" value="<?= $row["nama_penerbit"] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Kota Penerbit</label>
                                    <input type="text" class="form-control" placeholder="Kota Penerbit" name="kota_penerbit" value="<?= $row["kota"] ?>" required>
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