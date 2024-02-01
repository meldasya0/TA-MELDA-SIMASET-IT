<!-- Begin Page Content -->
<div class="container-fluid">
<h2><?php echo $title; ?></h2>
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
        </div>
        <div class="card-body">
            <?php echo $this->session->flashdata("pesan_hapus_berhasil");?>
            <?php echo $this->session->flashdata("pesan_tambah_berhasil");?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Aset</th> 
                            <th class="text-center">Kategori Aset IT</th> 
                            <th class="text-center">Jenis Aset</th>
                            <th class="text-center">Tanggal Perolehan</th>
                            <th class="text-center">Biaya</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($Data as $software): ?>
                            <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td class="text-center"></td>
                            <td class="text-center"><?php echo $software->nama_software ?></td>
                            <td class="text-center"><?php echo $software->lisensi ?></td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                                <td>
                                <center>
                                    <button type="button" class="btn btn-primary" 
                                    data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>

                                    <button type="button" class="btn btn-danger" 
                                    data-toggle="modal" data-target="#hapusModal">
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
                <?php echo form_open_multipart('Software/tambahDataAksi') ?>
                <div class="form-group">

                    <label for="nama">Nama Hardware</label>
                    <!-- <input type="text" name="nama_hardware" class="form-control"> -->
                    <select name="id_hardware" id="" class="form-control mb-3">
                        <option value="">- Belum Ditentukan - </option>
                        <?php foreach($dataHardware AS $row):?>
                        <option value="<$row->id_hardware>"><?= $row->nama_hardware?></option>
                        <?php endforeach;?>
                    </select>
                    <label for="nama">Nama Software</label>
                    <input type="text" name="nama_software" class="form-control mb-3">
                    <label for="nama">Lisensi</label>
                    <input type="text" name="lisensi" class="form-control">
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
