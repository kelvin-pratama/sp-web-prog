<?php
include "header.php";
include "koneksi.php";
function reverse_tanggal($tanggal){
    $tmp = array_reverse(explode('-',$tanggal));
    return implode('-',$tmp);
}
if(!isset($_GET['id'])){
    header('location: data_siswa.php');
}
$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM siswa WHERE nisn = '$id'");
if($query->num_rows < 1){
    header('location: data_siswa.php');
}
$row = $query->fetch_assoc();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px">
            <div class="card">
                <h5 class="card-header">Detil Siswa</h5>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th width="20%">NISN</th>
                            <td width="80%"><?= $row["nisn"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Nama Siswa</th>
                            <td width="80%"><?= $row["nama_siswa"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Jenis Kelamin</th>
                            <td width="80%"><?php if($row["jkel"] == "L") echo 'Laki-laki'; else 'Perempuan'; ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Tempat Lahir</th>
                            <td width="80%"><?= $row["tempat_lahir"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Tanggal Lahir</th>
                            <td width="80%"><?= reverse_tanggal($row["tgl_lahir"]) ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Alamat</th>
                            <td width="80%"><?= $row["alamat"] ?></td>
                        </tr>
                        <tr>
                            <th width="20%">Nomor HP</th>
                            <td width="80%"><?= $row["no_hp"] ?></td>
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