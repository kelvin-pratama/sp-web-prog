<?php
include "header.php";
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Data Kategori</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="" class="btn btn-primary">Tambah Data</a>
                        </div>
                        <div class="col">
                            <form action="" class="form-inline float-right">
                                <input type="text" class="form-control">
                                <input type="submit" value="Cari" class="btn btn-primary ml-2">
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Kategori</th>
                                    <th>Nama Kategori</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>K-0001</td>
                                    <td>Komputer</td>
                                </tr>
                            </table>
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