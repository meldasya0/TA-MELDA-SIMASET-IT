<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HistoryPerbaikan extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        $level = $this->session->userdata("level");
        if ($level != '1') {
            redirect("Login");
        }
    }
    
    public function index()
    {
        $data['title'] = "History Perbaikan";
        $data['Data'] = $this->db->query("SELECT 
        id_repair, tp.nama_type_hardware AS nama_hardware, hd.id_hardware As id_hardware, dp.nama_departemen, hd.nama_pic AS pengguna, tanggal_perbaikan,
         hs.deskripsi, tindakan, biaya, vendor
        FROM history_perbaikan hs
        LEFT JOIN hardware hd ON hs.id_hardware=hd.id_hardware
        LEFT JOIN departemen dp ON dp.id_departemen=hd.id_departemen
        LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type;
        ")->result();

        $data['Hardware'] = $this->db->query("SELECT 
        tp.nama_type_hardware AS nama_hardware, hd.id_hardware AS id_hardware, hd.harga
         AS harga, hd.tanggal_pembelian AS tanggal_pembelian, hd.nama_pic AS pengguna, 
         dp.nama_departemen AS nama_departemen, hd.spesifikasi AS spesifikasi, hd.sts_asset AS status_hardware
        FROM hardware hd
        LEFT JOIN departemen dp ON dp.id_departemen=hd.id_departemen
        LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type;
        ")->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-it');
        $this->load->view('templates/topbar');
        $this->load->view('IT/HistoryPerbaikan', $data);
        $this->load->view('templates/footer');
    }
    public function tambahDataAksi()
    {
        // Mengambil data dari formulir
        $id_hardware = $this->input->post('id_hardware');
        $tanggal_perbaikan = $this->input->post('tanggal_perbaikan');
        $tindakan = $this->input->post('tindakan');
        $deskripsi = $this->input->post('deskripsi');
        $biayaPost = $this->input->post('biaya');
        $biaya = preg_replace("/[^0-9]/", "",$biayaPost);
        $vendor = $this->input->post('vendor');
    
        // Validasi: Apakah semua field telah diisi
        if (empty($id_hardware) || empty($tanggal_perbaikan) || empty($tindakan) || empty($deskripsi) || empty($biaya) || empty($vendor)) {
            $this->session->set_flashdata('pesan_tambah_gagal', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Semua Field Harus Diisi!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('IT/HistoryPerbaikan');
            return;
        }
    
        // Menyimpan data ke dalam database
        $data = array(
            'id_hardware' => $id_hardware,
            'tanggal_perbaikan' => $tanggal_perbaikan,
            'tindakan' => $tindakan,
            'deskripsi' => $deskripsi,
            'biaya' => $biaya,
            'vendor' => $vendor,
        );
    
        $this->db->insert('history_perbaikan', $data);
    
        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_tambah_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    
        // Mengalihkan pengguna kembali ke halaman User
        redirect('IT/HistoryPerbaikan');
    }
    
    public function updateDataAksi()
    {
         // Set rules validasi
    $this->form_validation->set_rules('id_repair', 'ID Repair', 'required|numeric');
    $this->form_validation->set_rules('id_hardware', 'ID Hardware', 'required|numeric');
    $this->form_validation->set_rules('tanggal_perbaikan', 'Tanggal Perbaikan', 'required');
    $this->form_validation->set_rules('tindakan', 'Tindakan', 'required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
    $this->form_validation->set_rules('biaya', 'Biaya', 'required|numeric');
    $this->form_validation->set_rules('vendor', 'Vendor', 'required');

    // Jalankan validasi
    if ($this->form_validation->run() == FALSE) {
        // Validasi gagal, atur pesan kesalahan dan kembali ke halaman sebelumnya
        $this->session->set_flashdata('pesan_update_gagal', '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
            . validation_errors('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'));
        redirect('IT/HistoryPerbaikan');
    } else {
        // Mengambil data dari formulir
        $id = $this->input->post('id_repair');
        $id_hardware = $this->input->post('id_hardware');
        $tanggal_perbaikan = $this->input->post('tanggal_perbaikan');
        $tindakan = $this->input->post('tindakan');
        $deskripsi = $this->input->post('deskripsi');
        $biaya = $this->input->post('biaya');
        $vendor = $this->input->post('vendor');


        // Menyimpan data ke dalam database
        $data = array(
            'id_hardware' => $id_hardware,
            'tanggal_perbaikan' => $tanggal_perbaikan,
            'tindakan' => $tindakan,
            'deskripsi' => $deskripsi,
            'biaya' => $biaya,
            'vendor' => $vendor,

        );
        $where = array(
            'id_repair' => $id
        );

        // Melakukan update pada tabel 'divisi' dengan kondisi WHERE yang telah ditentukan
        $this->db->update('history_perbaikan', $data, $where);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_update_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil Diupdate!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

        // Mengalihkan pengguna kembali ke halaman Divisi
        redirect('IT/HistoryPerbaikan');
    }
}
    public function deleteData($id)
    {
        $where = array(
            'id_repair' => $id
        );
        $this->db->where($where);
        $this->db->delete('history_perbaikan');

        $this->session->set_flashdata('pesan_hapus_berhasil', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('IT/HistoryPerbaikan');
    }
}