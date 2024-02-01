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
            <!-- Menampilkan pesan flashdata  -->
            <?php echo $this->session->flashdata("pesan_tambah_gagal");?> 
            <?php echo $this->session->flashdata("pesan_update_gagal");?> 
            <?php echo $this->session->flashdata("pesan_hapus_berhasil");?>
            <?php echo $this->session->flashdata("pesan_tambah_berhasil");?>   
            <?php echo $this->session->flashdata("pesan_update_berhasil");?>
            <?php echo $this->session->flashdata("divisi_error");?>


            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Divisi</th>
                            <th class="text-center">Nama Departemen</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($Data as $departemen): ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center"><?php echo $departemen->nama_divisi; ?></td>
                                <td class="text-center"><?php echo $departemen->nama_departemen; ?></td>
                            
                                <td class="text-center">
                                    <center>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?php echo $departemen->id_departemen; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?php echo $departemen->id_departemen; ?>">
                                    <i class="fas fa-trash"></i>
                                    </button
                                       
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('IT/Departemen/tambahDataAksi') ?>
                <div class="form-group">
                    <label for="nama">Divisi</label>
                    <select type="text" name="id_divisi" class="form-control">
                        <option value="0">- Pilih Terlebih Dahulu - </option>
                        <?php foreach($dataDivisi AS $row):?>
                        <option value="<?= $row->id_divisi?>"><?= $row->nama_divisi?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Departemen</label>
                    <input type="text" name="nama_departemen" class="form-control">
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

<?php $no = 0;
foreach ($Data as $departemen):$no++;?>

<div class="modal fade" id="editModal<?php echo $departemen->id_departemen?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('IT/Departemen/UpdateDataAksi') ?>
                <div class="form-group">
                    
                    <label for="nama">Nama Divisi</label>
                    <select name="id_divisi" id="" class="form-control mb-3">
                    <?php foreach($dataDivisi AS $row):?>
                        <option value="<?= $row->id_divisi?>"><?= $row->nama_divisi?></option>
                    <?php endforeach;?>
                    <input type="hidden" name="id_departemen" class="form-control" value="<?php echo $departemen->id_departemen;?>">
                    <label for="nama">Nama Departemen</label>
                    <input type="text" name="nama_departemen" class="form-control" value="<?php echo $departemen->nama_departemen;?>">
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
<?php endforeach;?>

<!-- Akhir Edit -->

<!-- modal Hapus -->
<?php foreach ($Data as $departemen): ?>
    <div class="modal fade" id="hapusModal<?php echo $departemen->id_departemen ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form action="<?php echo base_url('IT/Departemen/deleteData/' . $departemen->id_departemen); ?>" method="post">
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<!-- akhir hapus -->