<div class="container-fluid">
    <div class="d-flex justify-content-between my-2">
        <h4 class="font-weight-bold">
            <?php echo $title; ?>
        </h4>
        <div>
            <a href="<?= base_url("IT/Laporan/Peminjaman") ?>" class="rounded-0 btn btn-danger">Kembali</a>
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
                    <th class="text-center">Pemilik</th>
                    <th class="text-center">Tanggal Peminjaman</th>
                    <th class="text-center">Nama Peminjam</th>
                    <th class="text-center">Tanggal Pengembalian</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($Data as $pinjam) : 
            ?>
                <tr>
                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $pinjam->nama_hardware ?></td>
                                <td class="text-center"><?= $pinjam->nama_departemen ?></td>
                                <td class="text-center"><?= $pinjam->pengguna ?></td>
                                <td class="text-center"><?= $pinjam->tgl_pinjam ?></td>
                                <td class="text-center"><?= $pinjam->peminjam ?></td>
                                <td class="text-center"><?= $pinjam->tgl_kembali ?></td>
                                
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
            filename: "Laporan History Peminjaman",
            fileext: ".xls"
        });
    }
</script>