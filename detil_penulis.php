<?php
include "header.php";
include "koneksi.php";
if(!isset($_GET['id'])){
    header('location: data_penulis.php');
}
$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM penulis WHERE id_penulis = '$id'");
if($query->num_rows < 1){
    header('location: data_penulis.php');
}
$row = $query->fetch_assoc();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px">
            <div class="card">
                <h5 class="card-header">Detil Penulis</h5>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th width="20%">Kode Penulis</th>
                            <td width="80%"><?= $row["id_penulis"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Nama Penulis</th>
                            <td width="80%"><?= $row["nama_penulis"] ?></td>
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