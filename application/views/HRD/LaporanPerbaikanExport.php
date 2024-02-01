<div class="container-fluid">
    <div class="d-flex justify-content-between my-2">
        <h4 class="font-weight-bold">
            <?php echo $title; ?>
        </h4>
        <div>
            <a href="<?= base_url("IT/Laporan/Perbaikan") ?>" class="rounded-0 btn btn-danger">Kembali</a>
            <button class="rounded-0 btn btn-secondary" onclick="download()">Export</button>
        </div>
    </div>
    <div class="table-responsive my-2">
        <table class="table table-sm table-bordered" id="table2excel">
            <thead class="bg-secondary text-white">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Hardware</th>
                    <th class="text-center">Departemen</th>
                    <th class="text-center">Pengguna</th>
                    <th class="text-center">Tanggal Perbaikan</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Tindakan</th>
                    <th class="text-center">Biaya</th>
                    <th class="text-center">Vendor</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($Data as $history) : ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= $history->nama_hardware ?></td>
                    <td class="text-center"><?= $history->nama_departemen ?></td>
                    <td class="text-center"><?= $history->pengguna ?></td>
                    <td class="text-center"><?= $history->tanggal_perbaikan ?></td>
                    <td class="text-center"><?= $history->deskripsi ?></td>
                    <td class="text-center"><?= $history->tindakan ?></td>
                    <td class="text-center"><?= $history->biaya ?></td>
                    <td class="text-center"><?= $history->vendor ?></td>
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
            filename: "Laporan History Perbaikan",
            fileext: ".xls"
        });
    }
</script>