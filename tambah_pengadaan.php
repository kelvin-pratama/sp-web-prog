<?php
include "header.php";
include "koneksi.php";

$query_data_buku = $koneksi->query("SELECT A.*, B.nama_penulis, C.nama_penerbit, D.nama AS nama_kategori FROM buku AS A INNER JOIN penulis AS B ON A.id_penulis = B.id_penulis INNER JOIN penerbit AS C ON A.id_penerbit = C.id_penerbit INNER JOIN kategori AS D ON A.id_kategori = D.id_kategori");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Tambah Pengadaan</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_pengadaan.php" method="POST">
                                <div class="form-group">
                                    <label for="">Tanggal Pengadaan</label>
                                    <input type="date" class="form-control" name="tgl_pengadaan" id="tgl_pengadaan" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Buku</label>
                                    <select name="id_buku" id="id_buku" class="form-control" required>
                                        <option value="" selected disabled>Pilih salah satu....</option>
                                        <?php
                                            while($row_buku = $query_data_buku->fetch_assoc()){
                                        ?>
                                        <option value="<?= $row_buku["id_buku"] ?>"><?= $row_buku["judul"] ?> (<?= $row_buku["isbn"] ?>) - Penerbit: <?= $row_buku["nama_penerbit"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Asal Buku</label>
                                    <input type="text" class="form-control" name="asal_buku" id="asal_buku" maxlength="100" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Jumlah Pengadaan</label>
                                    <input type="number" class="form-control" name="jumlah_pengadaan" id="jumlah_pengadaan" maxlength="100" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" required rows="6"></textarea>
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