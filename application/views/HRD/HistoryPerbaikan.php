<!-- Begin Page Content -->
<div class="container-fluid">
    <h1><?php echo $title; ?></h1>
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata("pesan_hapus_berhasil"); ?>
            <?php echo $this->session->flashdata("pesan_tambah_berhasil"); ?>
            <?php echo $this->session->flashdata("pesan_update_berhasil"); ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
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
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $history->id_repair ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $history->id_repair ?>">
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
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('HRD/HistoryPerbaikan/tambahDataAksi') ?>
                <div class="form-group">
                    <label for="id_hardware">Nama Hardware</label>
                    <select name="id_hardware" id="" class="form-control mb-3">
                        <option value="">- Belum Ditentukan - </option>
                        <?php foreach ($Hardware as $row) : ?>
                            <option value="<?= $row->id_hardware ?>">
                                <?= $row->nama_hardware ?> (<?= $row->nama_departemen ?> - <?= $row->pengguna ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_perbaikan">Tanggal Perbaikan</label>
                    <input type="text" name="tanggal_perbaikan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tindakan">Tindakan</label>
                    <input type="text" name="tindakan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="biaya">Biaya</label>
                    <input type="text" name="biaya" class="form-control">
                </div>
                <div class="form-group">
                    <label for="vendor">Vendor</label>
                    <input type="text" name="vendor" class="form-control">
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

<!-- Modal Untuk Edit -->
<?php $no = 1;
foreach ($Data as $history) :
    $no++; ?>

<div class="modal fade" id="editModal<?= $history->id_repair ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('HRD/HistoryPerbaikan/updateDataAksi') ?>
                <input type="text" name="id_repair" class="form-control" value="<?= $history->id_repair?>">
                <div class="form-group">
                    <label for="id_hardware">Nama Hardware</label>
                    <select name="id_hardware" id="" class="form-control mb-3">
                        <option value="">- Belum Ditentukan - </option>
                        <?php foreach ($Hardware as $row) : ?>
                            <option value="<?= $row->id_hardware ?>">
                                <?= $row->nama_hardware ?> (<?= $row->nama_departemen ?> - <?= $row->pengguna ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_perbaikan">Tanggal Perbaikan</label>
                    <input type="text" name="tanggal_perbaikan" class="form-control" value="<?= $history->tanggal_perbaikan?>">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" value="<?= $history->deskripsi?>">
                </div>
                <div class="form-group">
                    <label for="tindakan">Tindakan</label>
                    <input type="text" name="tindakan" class="form-control" value="<?= $history->tindakan?>">
                </div>
                <div class="form-group">
                    <label for="biaya">Biaya</label>
                    <input type="text" name="biaya" class="form-control" value="<?= $history->biaya?>">
                </div>
                <div class="form-group">
                    <label for="vendor">Vendor</label>
                    <input type="text" name="vendor" class="form-control" value="<?= $history->vendor?>">
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


<?php $no = 1;
foreach ($Data as $history) :
    $no++; ?>
    <div class="modal fade" id="hapusModal<?= $history->id_repair ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Apakah Anda Yakin Ingin diHapus Data Ini?</p class="text-center">
                </div>
                <div class="modal-footer">
                    <form action="<?php echo base_url('HRD/HistoryPerbaikan/deleteData/' . $history->id_repair); ?>" method="post">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>