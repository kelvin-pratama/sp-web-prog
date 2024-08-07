<?php
include "header.php";
include "koneksi.php";
if (!isset($_GET['id'])) {
    header('location: data_peminjaman.php');
}
$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM peminjaman WHERE id_peminjaman = '$id'");
if ($query->num_rows < 1) {
    header('location: data_peminjaman.php');
}
$row = $query->fetch_assoc();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 480px;">
            <div class="card">
                <h5 class="card-header">Tambah Data Pengembalian</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_pengembalian.php" method="POST">
                                <div class="form-group">
                                    <label for="">Kode Peminjaman</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Kode Peminjaman"
                                        id="id_pinjam" name="id_pinjam" value="<?= $row["id_peminjaman"] ?>" readonly
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Pinjam</label>
                                    <input type="date" class="form-control" id="tgl_pinjam"
                                        value="<?= $row["tgl_pinjam"] ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Kembali</label>
                                    <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="">Denda</label>
                                    <input type="text" class="form-control" id="denda" name="denda" readonly required>
                                </div>
                                <input type="submit" id="simpan" value="Simpan" class="btn btn-primary">
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
        function dateDiff(date1, date2) {
            var d1 = new Date(date1);
            var d2 = new Date(date2);
            var timeDiff = Math.abs(d2 - d1);
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            return diffDays;
        }

        function formatRupiah(value) {
            var number_string = value.toString().replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                remainder = split[0].length % 3,
                rupiah = split[0].substr(0, remainder),
                thousands = split[0].substr(remainder).match(/\d{3}/gi);

            // Add thousands separator
            if (thousands) {
                separator = remainder ? '.' : '';
                rupiah += separator + thousands.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah ? 'Rp. ' + rupiah : '';
        }
        $('#tgl_kembali').on('change', function (event) {
            var date1 = $('#tgl_pinjam').val();
            var date2 = $('#tgl_kembali').val();
            var terlambat = parseInt(dateDiff(date1, date2)) - 3;
            if (terlambat > 0) {
                var denda = 10000 * terlambat;
                $('#denda').val(formatRupiah(denda));
            } else {
                $('#denda').val(formatRupiah(0));
            }
        });
        $('#simpan').on('click', function (event) {
            var rawValue = $('#denda').val().replace(/[^,\d]/g, '');
            $('#denda').val(rawValue);
        });
    });


    // // Handle input event
    // $('#nilai_perolehan').on('input', function () {
    //     var input = $(this).val();
    //     var numericValue = input.replace(/[^,\d]/g, '');
    //     $(this).val(formatRupiah(numericValue));
    // });

    // $('#nilai_perolehan').trigger('input');
</script>
<?php
include "footer.php";
?>