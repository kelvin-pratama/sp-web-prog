<?php
include "header.php";
include "koneksi.php";
if(!isset($_GET['id'])){
    header('location: data_admin.php');
}
$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM admin WHERE id_admin = '$id'");
if($query->num_rows < 1){
    header('location: data_admin.php');
}
$row = $query->fetch_assoc();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Tambah Data Admin</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_edit_admin.php" method="POST">
                                <input type="hidden" name="id_admin" value="<?= $row["id_admin"] ?>">
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap..." name="nama_lengkap" value="<?= $row["nama_lengkap"] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Username..." name="username" value="<?= $row["username"] ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" placeholder="Masukkan Password..." name="password" required>
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