<!-- Begin Page Content -->
<div class="container-fluid">
    <h1>
        <?php echo $title; ?>
    </h1>
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata("pesan_tambah_gagal"); ?>
            <?php echo $this->session->flashdata("pesan_update_gagal"); ?>
            <?php echo $this->session->flashdata("pesan_hapus_berhasil"); ?>
            <?php echo $this->session->flashdata("pesan_tambah_berhasil"); ?>
            <?php echo $this->session->flashdata("pesan_update_berhasil"); ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Aset</th>
                            <th class="text-center">Nama Hardware</th>
                            <th class="text-center">Departemen</th>
                            <th class="text-center">Pengguna</th>
                            <th class="text-center">Spesifikasi</th>
                            <th class="text-center">Tanggal Pembelian</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($Data as $hardware): ?>
                            <tr>
                                <td class="text-center">
                                    <?= $no++ ?>
                                </td>
                                <td class="text-center">
                                    <?= $hardware->kode_aset ?>
                                </td>
                                <td class="text-center">
                                    <?= $hardware->nama_hardware ?>
                                </td>
                                <td class="text-center">
                                    <?= $hardware->nama_departemen ?>
                                </td>
                                <td class="text-center">
                                    <?= $hardware->pengguna ?>
                                </td>
                                <td class="text-center">
                                    <?= $hardware->spesifikasi ?>
                                </td>
                                <td class="text-center">
                                    <?= $hardware->tanggal_pembelian ?>
                                </td>
                                <td class="text-center">
                                    <?= number_format($hardware->harga, 0, ",", ".") ?>
                                </td>
                                <td class="text-center">
                                    <?= $hardware->status_hardware ?>
                                </td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#editModal<?= $hardware->id_hardware ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#hapusModal<?= $hardware->id_hardware ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </center>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('IT/Hardware/tambahDataAksi') ?>
                <div class="form-group">
                    <input type="hidden" name="kodeaset" id="kodeaset" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama">Tipe Hardware</label>
                    <select type="text" name="tipe_hardware" class="form-control">
                        <option value="0">- Pilih Terlebih Dahulu - </option>
                        <?php foreach ($Tipe as $row): ?>
                            <option value="<?= $row->id_type ?>">
                                <?= $row->nama_type_hardware ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">Departemen</label>
                    <select type="text" name="id_departemen" class="form-control">
                        <option value="0">- Pilih Terlebih Dahulu - </option>
                        <?php foreach ($Departemen as $row): ?>
                            <option value="<?= $row->id_departemen ?>">
                                <?= $row->nama_departemen ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pengguna">Pengguna</label>
                    <input type="text" name="pengguna" class="form-control">
                </div>
                <div class="form-group">
                    <label for="spesifikasi">Spesifikasi</label>
                    <input type="text" name="spesifikasi" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tanggal_pembelian">Tanggal Pembelian</label>
                    <input type="date" name="tanggal_pembelian" class="form-control">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" class="form-control number-separator">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                    <option value="0">- Pilih Terlebih Dahulu - </option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<script>
    // Tambahkan fungsi JavaScript untuk menghasilkan dan mengisi nilai Kode Aset
    function generateKodeAset() {
        var namaHardware = document.querySelector('[name="tipe_hardware"]').value;
        var namaDepartemen = document.querySelector('[name="id_departemen"]').value;
        var pengguna = document.querySelector('[name="pengguna"]').value;

        // Logika atau panggil fungsi generateKodeAset di sini
        var kodeAset = generateKodeAset(namaHardware, namaDepartemen, pengguna);

        // Set nilai ke input hidden
        document.getElementById('kodeaset').value = kodeAset;
    }
</script>

<!-- Modal untuk UBah Data -->
<?php $no = 0;
foreach ($Data as $hardware):
    $no++; ?>

    <div class="modal fade" id="editModal<?= $hardware->id_hardware ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('IT/Hardware/updateDataAksi') ?>
                    <input hidden type="text" name="id_hardware" class="form-control" value="<?= $hardware->id_hardware ?>">
                    <div class="form-group">
                        <label for="nama">Nama Hardware</label>
                        <select type="text" name="tipe_hardware" class="form-control">
                            <!-- <option value="0">- Pilih Terlebih Dahulu - </option> -->
                            <?php foreach ($Tipe as $row): ?>
                                <option value="<?= $row->id_type ?>" <?php if ($row->id_type == $hardware->id_type) {
                                      echo "selected";
                                  } ?>>
                                    <?= $row->nama_type_hardware ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="nama">Departemen</label>
                    <select type="text" name="id_departemen" class="form-control">
                        <option value="0">- Pilih Terlebih Dahulu - </option>
                        <?php foreach ($Departemen as $row): ?>
                            <option value="<?= $row->id_departemen ?>"<?php if ($row->id_departemen == $hardware->id_departemen) {
                                      echo "selected";
                                  } ?>>
                                <?= $row->nama_departemen ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                    <div class="form-group">
                        <label for="pengguna">Pengguna</label>
                        <input type="text" name="pengguna" class="form-control" value="<?= $hardware->pengguna ?>">
                    </div>
                    <div class="form-group">
                        <label for="spesifikasi">Spesifikasi</label>
                        <input type="text" name="spesifikasi" class="form-control" value="<?= $hardware->spesifikasi ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pembelian">Tanggal Pembelian</label>
                        <input type="date" name="tanggal_pembelian" class="form-control"
                            value="<?= $hardware->tanggal_pembelian ?>">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" class="form-control number-separator" value="<?= $hardware->harga ?>">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                    <!-- <option value="0">- Pilih Terlebih Dahulu - </option> -->
                        <option value="Baik" <?php if ($hardware->status_hardware == "Baik") {
                                      echo "selected";}?>>Baik</option>
                        <option value="Rusak" <?php if ($hardware->status_hardware == "Rusak") {
                                      echo "selected";}?>>Rusak</option>
                    </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- modal Hapus -->
<?php foreach ($Data as $hardware): ?>
    <div class="modal fade" id="hapusModal<?php echo $hardware->id_hardware ?>" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="my-3 text-center">Apakah Anda Yakin Ingin diHapus?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <form action="<?php echo base_url('IT/Hardware/deleteData/' . $hardware->id_hardware); ?>"
                        method="post">
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>