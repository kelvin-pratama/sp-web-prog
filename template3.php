<?php
include "header.php";
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Tambah Data Kategori</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="">
                                <div class="form-group">
                                    <label for="">Kode Kategori</label>
                                    <input type="text" class="form-control" placeholder="Kode Kategori">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Kategori</label>
                                    <input type="text" class="form-control" placeholder="Nama Kategori">
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