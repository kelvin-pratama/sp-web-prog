<?php
include "header.php";
include "koneksi.php";
if(!isset($_GET['id'])){
    header('location: data_buku.php');
}
$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM buku WHERE id_buku = '$id'");
if($query->num_rows < 1){
    header('location: data_buku.php');
}
$row = $query->fetch_assoc();
?>
<style>
    .ui-datepicker-calendar {
        display: none;
    }

    .ui-datepicker-month {
        display: none;
    }

    .ui-datepicker-next,
    .ui-datepicker-prev {
        display: none;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Edit Data Buku</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_edit_buku.php" method="POST">
                                <input type="hidden" name="kode_buku" value="<?= $_GET["id"] ?>">
                                <div class="form-group">
                                    <label for="">ISBN</label>
                                    <input type="text" class="form-control" placeholder="Masukkan ISBN..." name="isbn"
                                        id="isbn" minlength="10" maxlength="13" value="<?= $row["isbn"] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Judul Buku</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Judul Buku..."
                                        name="judul" id="judul" maxlength="255" value="<?= $row["judul"] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Penulis</label>
                                    <select class="form-control" name="penulis" id="penulis" required>
                                        <option value="" selected disabled>Pilih salah satu...</option>
                                        <?php
                                        $query_penulis = $koneksi->query("SELECT * FROM penulis");
                                        while ($row2 = $query_penulis->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row2["id_penulis"] ?>" <?php if($row2["id_penulis"] == $row["id_penulis"]) echo 'selected' ?>><?= $row2["nama_penulis"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Penerbit</label>
                                    <select class="form-control" name="penerbit" id="penerbit" required>
                                        <option value="" selected disabled>Pilih salah satu...</option>
                                        <?php
                                        $query_penerbit = $koneksi->query("SELECT * FROM penerbit");
                                        while ($row3 = $query_penerbit->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row3["id_penerbit"] ?>" <?php if($row3["id_penerbit"] == $row["id_penerbit"]) echo 'selected' ?>><?= $row3["nama_penerbit"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select class="form-control" name="kategori" id="kategori" required>
                                        <option value="" selected disabled>Pilih salah satu...</option>
                                        <?php
                                        $query_kategori = $koneksi->query("SELECT * FROM kategori");
                                        while ($row4 = $query_kategori->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row4["id_kategori"] ?>" <?php if($row4["id_kategori"] == $row["id_kategori"]) echo 'selected' ?>><?= $row4["nama"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tahun Terbit</label>
                                    <input class="form-control" value="<?= $row["tahun_terbit"] ?>" type="text" name="tahun_terbit" id="datepicker" maxlength="4" required/>
                                </div>
                                <div class="form-group">
                                    <label for="">Sinopsis</label>
                                    <textarea class="form-control" name="sinopsis" id="sinopsis" rows="6" required><?= $row["sinopsis"] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah</label>
                                    <input class="form-control" type="number" name="jumlah" id="jumlah" max="9999" value="<?= $row["jumlah"] ?>" required/>
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
        $('#isbn').on('input', function(){
            this.value = this.value.replace(/[^0-9]/g, '');
        });



        var currentYear = new Date().getFullYear();
        $('#datepicker').datepicker({
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            yearRange: '1901:' + currentYear,
            onClose: function (dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, 1));
            }
        });
        $(".date-picker-year").focus(function () {
            $(".ui-datepicker-month").hide();
        });
    });
</script>
<?php
include "footer.php";
?>