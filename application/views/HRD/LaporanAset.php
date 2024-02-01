<!-- Begin Page Content -->
<div class="container-fluid">
    <h1>
        <?php echo $title; ?>
    </h1>
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5>Laporan</h5>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata("pesan_hapus_berhasil"); ?>
            <?php echo $this->session->flashdata("pesan_tambah_berhasil"); ?>
            <div>
                <form method="POST" action="<?= base_url("IT/Laporan/exportAset") ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_mulai">Mulai - Tanggal Pembelian</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggal_akhir">Akhir - Tanggal Pembelian</label>
                            <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary text-right">Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>