<?php
include "header.php";
include "koneksi.php";

$query_data_buku = $koneksi->query("SELECT A.*, B.nama_penulis, C.nama_penerbit, D.nama AS nama_kategori FROM buku AS A INNER JOIN penulis AS B ON A.id_penulis = B.id_penulis INNER JOIN penerbit AS C ON A.id_penerbit = C.id_penerbit INNER JOIN kategori AS D ON A.id_kategori = D.id_kategori");
$query_data_siswa = $koneksi->query("SELECT * FROM siswa");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Tambah Peminjaman</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_peminjaman.php" method="POST">
                                <div class="form-group">
                                    <label for="">Siswa</label>
                                    <select name="nisn" id="nisn" class="form-control" required>
                                        <option value="" selected disabled>Pilih salah satu....</option>
                                        <?php
                                            while($row_siswa = $query_data_siswa->fetch_assoc()){
                                        ?>
                                        <option value="<?= $row_siswa["nisn"] ?>"><?= $row_siswa["nama_siswa"] ?> (<?= $row_siswa["nisn"] ?>)</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Buku</label>
                                    <select name="id_buku" id="id_buku" class="form-control" required>
                                        <option value="" selected disabled>Pilih salah satu....</option>
                                        <?php
                                            while($row_buku = $query_data_buku->fetch_assoc()){
                                                $id_buku_q = $row_buku["id_buku"];
                                                $total_buku = intval($koneksi->query("SELECT jumlah FROM buku WHERE id_buku = '$id_buku_q'")->fetch_assoc()["jumlah"]);
                                                $total_pinjam = intval($koneksi->query("SELECT SUM(jumlah_pinjam) AS total_pinjam FROM detail_peminjaman WHERE id_buku = '$id_buku_q'")->fetch_assoc()["total_pinjam"]);
                                                $jumlah_tersedia = $total_buku - $total_pinjam;
                                                $check_avail = $jumlah_tersedia < 1;
                                        ?>
                                        <option value="<?= $row_buku["id_buku"] ?>" <?php if($check_avail) echo 'disabled' ?>><?= $row_buku["judul"] ?> (<?= $row_buku["isbn"] ?>) - Penerbit: <?= $row_buku["nama_penerbit"] ?> (Tersedia: <?= $jumlah_tersedia ?> buku)</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Peminjaman</label>
                                    <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl_pinjam" id="tgl_pinjam" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Harus Kembali</label>
                                    <input type="date" class="form-control" name="tgl_harus_kembali" id="tgl_harus_kembali" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah Peminjaman</label>
                                    <input type="number" class="form-control" name="jumlah_pinjam" id="jumlah_pinjam" required>
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
    $(document).ready(function(){
        $('#id_buku').on('change', function(event){
            $.ajax({
                url: 'check_availability_buku.php', // Replace with your server URL
                type: 'POST',
                data: {
                    id_buku: $('#id_buku').val(),
                },
                success: function(response) {
                    var json =jQuery.parseJSON(response);
                    if(json.available == 1){
                        $('#jumlah_pinjam').attr('max', json.jumlah_tersedia);
                        $('#jumlah_pinjam').attr('disabled', false);
                    } else {
                        $('#jumlah_pinjam').attr('disabled', true);
                    }
                },
                error: function(error) {
                    $('#jumlah_pinjam').attr('disabled', true);
                }
            });
        });
    });
</script>
<?php
include "footer.php";
?>