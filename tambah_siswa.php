<?php
include "header.php";
include "koneksi.php";
$array_jkel = array("L" => "Laki-laki", "P" => "Perempuan");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Tambah Data Siswa</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_siswa.php" method="POST">
                                <div class="form-group">
                                    <label for="">NISN</label>
                                    <input type="text" class="form-control" placeholder="Masukkan NISN..." name="nisn"
                                        id="nisn" maxlength="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Siswa</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Siswa..."
                                        name="nama_siswa" id="nama_siswa" maxlength="100" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <select class="form-control" name="jkel" id="jkel" required>
                                        <option value="" selected disabled>Pilih salah satu...</option>
                                        <?php
                                        foreach($array_jkel as $key => $value) {
                                            ?>
                                            <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tempat Lahir</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Tempat Lahir..."
                                        name="tempat_lahir" id="tempat_lahir" maxlength="30" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <input class="form-control" type="text" name="alamat" id="alamat" placeholder="Masukkan Alamat..." maxlength="255" required/>
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor HP</label>
                                    <input type="text" class="form-control" name="no_hp" id="no_hp" maxlength="14" required>
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
<script>
    $(document).ready(function () {
        $('#nisn').on('input', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        $('#no_hp').on('input', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });
</script>
<?php
include "footer.php";
?>