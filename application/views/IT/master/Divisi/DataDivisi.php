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
            <!-- Menampilkan pesan flashdata jika ada -->
            <?php echo $this->session->flashdata("pesan_tambah_gagal");?> 
            <?php echo $this->session->flashdata("pesan_update_gagal");?> 
            <?php echo $this->session->flashdata("pesan_hapus_berhasil");?>
            <?php echo $this->session->flashdata("pesan_tambah_berhasil");?>   
            <?php echo $this->session->flashdata("pesan_update_berhasil");?>

            <!-- Menampilkan pesan validasi tambah data -->
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> ', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>'); ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Divisi</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($Data as $divisi): ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $divisi->nama_divisi; ?></td>
                                <td class="text-center">
                                    <center>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?php echo $divisi->id_divisi; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?php echo $divisi->id_divisi; ?>">
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
<!-- End of Main Content -->

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
                <?php echo form_open_multipart('IT/Divisi/tambahDataAksi') ?>
                <!-- Form tambah data -->
                <div class="form-group">
                    <label for="nama">Nama Divisi</label>
                    <input type="text" name="nama_divisi" class="form-control">
                </div>
                <!-- Akhir form tambah data -->
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
<?php $no = 0;
foreach ($Data as $divisi): $no++; ?>
    <div class="modal fade" id="editModal<?php echo $divisi->id_divisi ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('IT/Divisi/UpdateDataAksi') ?>
                    <!-- Form edit data -->
                    <div class="form-group">
                        <input type="hidden" name="id_divisi" class="form-control" value="<?php echo $divisi->id_divisi; ?>">
                        <label for="nama">Nama Divisi</label>
                        <input type="text" name="nama_divisi" class="form-control" value="<?php echo $divisi->nama_divisi; ?>">
                    </div>
                    <!-- Akhir form edit data -->
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

<!-- Modal Hapus -->
<?php foreach ($Data as $divisi): ?>
    <div class="modal fade" id="hapusModal<?php echo $divisi->id_divisi ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Ingin diHapus?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <form action="<?php echo base_url('IT/Divisi/deleteData/' . $divisi->id_divisi); ?>" method="post">
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Akhir Hapus -->
