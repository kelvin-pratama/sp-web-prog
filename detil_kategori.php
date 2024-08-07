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
        <div class="col-lg-12 mt-2" style="min-height: 480px">
            <div class="card">
                <h5 class="card-header">Detil Kategori</h5>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th width="20%">Kode Kategori</th>
                            <td width="80%"><?= $row["id_kategori"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Nama Kategori</th>
                            <td width="80%"><?= $row["nama"] ?></td>
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