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
        <div class="col-lg-12 mt-2" style="min-height: 480px">
            <div class="card">
                <h5 class="card-header">Detil Penerbit</h5>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th width="20%">Kode Penerbit</th>
                            <td width="80%"><?= $row["id_penerbit"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Nama Penerbit</th>
                            <td width="80%"><?= $row["nama_penerbit"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Kota Penerbit</th>
                            <td width="80%"><?= $row["kota"] ?></td>
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