<div class="container-fluid">
    <div class="d-flex justify-content-between my-2">
        <h4 class="font-weight-bold">
            <?php echo $title; ?>
        </h4>
        <div>
            <a href="<?= base_url("IT/Laporan/Aset") ?>" class="rounded-0 btn btn-danger">Kembali</a>
            <button class="rounded-0 btn btn-secondary" onclick="download()">Export</button>
        </div>
    </div>
    <div class="table-responsive my-2">
        <table class="table table-sm table-bordered" id="table2excel">
            <thead class="bg-secondary text-white">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama software</th>
                    <th class="text-center">Nama Hardware</th>
                    <th class="text-center">Pengguna Hardware</th>
                    <th class="text-center">Lisensi</th>
                    <th class="text-center">Tanggal Pembelian</th>
                    <th class="text-center">Harga</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($Data as $software) : ?>
                <tr>
                    <td class="text-center">
                        <?php echo $no++ ?>
                    </td>
                    <td class="text-center">
                        <?php echo $software->nama_software ?>
                    </td>
                    <td class="text-center">
                        <?php echo $software->nama_hardware ?>
                    </td>
                    <td class="text-center">
                        <?php echo $software->pengguna ?>
                    </td>
                    <td class="text-center">
                        <?php echo $software->lisensi ?></td>
                    <td class="text-center">
                        <?php echo $software->tanggal_pembelian ?>
                    </td>
                    <td class="text-center">
                        <?php echo $software->harga ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?= base_url("files/js/jquery.table2excel.js") ?>"></script>
<script>
    function download() {
        $("#table2excel").table2excel({
            name: "Worksheet Name",
            filename: "Laporan Data Aset",
            fileext: ".xls"
        });
    }
</script>