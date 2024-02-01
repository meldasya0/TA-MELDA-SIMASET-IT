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
        <?php echo $this->session->flashdata("pesan_tambah_gagal");?>
        <?php echo $this->session->flashdata("pesan_update_gagal");?>  
            <?php echo $this->session->flashdata("pesan_hapus_berhasil"); ?>
            <?php echo $this->session->flashdata("pesan_update_berhasil"); ?>
            <?php echo $this->session->flashdata("pesan_tambah_berhasil"); ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama software</th>
                            <th class="text-center">Nama Hardware</th>
                            <th class="text-center">Pengguna Hardware</th>
                            <th class="text-center">Lisensi</th>
                            <th class="text-center">Tanggal Pembelian</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                <?= number_format($software->harga ,0,",",".")  ?> 
                                   
                                </td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $no ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $no ?>">
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
                <?php echo form_open_multipart('IT/Software/tambahDataAksi') ?>
                <div class="form-group">
                    <label for="nama_software">Nama Software</label>
                    <input type="text" name="nama_software" class="form-control mb-3">
                </div>
                <div class="form-group">
                    <label for="id_hardware">Nama Hardware</label>
                    <select name="id_hardware" id="" class="form-control mb-3">
                        <?php foreach ($Hardware as $row) : ?>
                            <option value="<?= $row->id_hardware ?>">
                                <?= $row->nama_hardware ?> (<?= $row->nama_departemen ?> - <?= $row->pengguna ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lisensi">Lisensi</label>
                    <input type="text" name="lisensi" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tanggal_pembelian">Tanggal Pembelian</label>
                    <input type="date" name="tanggal_pembelian" class="form-control">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" class="form-control number-separator">
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
<!-- Akhir Modal -->

<!-- Modal Untuk Edit -->
<?php $no = 1;
foreach ($Data as $software) :
    $no++; ?>

    <div class="modal fade" id="editModal<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('IT/Software/UpdateDataAksi') ?>
                    <input type="hidden" name="id_software" class="form-control" value="<?= $software->id_software ?>"></input>
                    <div class="form-group">
                        <label for="nama_software">Nama Software</label>
                        <input type="text" name="nama_software" class="form-control mb-3" value="<?= $software->nama_software ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_hardware">Nama Hardware</label>
                        <select name="id_hardware" id="" class="form-control mb-3">
                         
                            <?php foreach ($Hardware as $row) : ?>
                                <option value="<?= $row->id_hardware ?>">
                                    <?= $row->nama_hardware ?> (<?= $row->nama_departemen ?> - <?= $row->pengguna ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lisensi">Lisensi</label>
                        <input type="text" name="lisensi" class="form-control" value="<?= $software->lisensi ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pembelian">Tanggal Pembelian</label>
                        <input type="date" name="tanggal_pembelian" class="form-control" value="<?= $software->tanggal_pembelian ?>">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" class="form-control number-separator" value="<?= $software->harga ?>">
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

<!-- Akhir Edit -->

<!-- modal Hapus -->
<?php $no = 1;
foreach ($Data as $software) :
    $no++; ?>
    <div class="modal fade" id="hapusModal<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form action="<?php echo base_url('IT/Software/deleteData/' . $software->id_software); ?>" method="post">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<!-- akhir hapus -->