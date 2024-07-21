<?php
include "header.php";
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Tambah Data Penerbit</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_penerbit.php" method="POST">
                                <div class="form-group">
                                    <label for="">Nama Penerbit</label>
                                    <input type="text" class="form-control" placeholder="Nama Penerbit" name="nama_penerbit" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Kota Penerbit</label>
                                    <input type="text" class="form-control" placeholder="Kota Penerbit" name="kota_penerbit" required>
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