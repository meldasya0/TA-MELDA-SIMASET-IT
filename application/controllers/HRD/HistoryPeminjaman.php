<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HistoryPeminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $level = $this->session->userdata("level");
        if ($level != '2') {
            redirect("Login");
        }
    }
    
    public function index()
    {
        $data['title'] = "History Peminjaman";
        $data['Data'] = $this->db->query("SELECT 
        id_pinjam, tp.nama_type_hardware AS nama_hardware, dp.nama_departemen, hd.nama_pic AS pengguna, tgl_pinjam, peminjam, tgl_kembali
        FROM pinjam pj
        LEFT JOIN hardware hd ON pj.id_hardware=hd.id_hardware
        LEFT JOIN departemen dp ON dp.id_departemen=hd.id_departemen
        LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type;
        ")->result();
        $data['Hardware'] = $this->db->query("SELECT 
        tp.nama_type_hardware AS nama_hardware, hd.id_hardware AS id_hardware, hd.harga AS harga, hd.tanggal_pembelian AS tanggal_pembelian, hd.nama_pic AS pengguna, dp.nama_departemen AS nama_departemen, hd.spesifikasi AS spesifikasi, hd.sts_asset AS status_hardware
        FROM hardware hd
        LEFT JOIN departemen dp ON dp.id_departemen=hd.id_departemen
        LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type;
        ")->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-hrd');
        $this->load->view('templates/topbar');
        $this->load->view('HRD/HistoryPeminjaman', $data);
        $this->load->view('templates/footer');
    }
    public function tambahDataAksi()
    {
        // Mengambil data dari formulir
        $id_hardware = $this->input->post('id_hardware');
        $tanggal_pinjam = $this->input->post('tanggal_pinjam');
        $peminjam = $this->input->post('peminjam');
        $tanggal_kembali = $this->input->post('tanggal_kembali');


        // Menyimpan data ke dalam database
        $data = array(
            'id_hardware' => $id_hardware,
            'tgl_pinjam' => $tanggal_pinjam,
            'peminjam' => $peminjam,
            'tgl_kembali' => $tanggal_kembali,
        );
        $this->db->insert('pinjam', $data);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_tambah_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');

        // Mengalihkan pengguna kembali ke halaman User
        redirect('HRD/HistoryPeminjaman');
    }
    public function updateDataAksi()
    {
        // Mengambil data dari formulir
        $id = $this->input->post('id_pinjam');
        $id_hardware = $this->input->post('id_hardware');
        $tanggal_pinjam = $this->input->post('tanggal_pinjam');
        $peminjam = $this->input->post('peminjam');
        $tanggal_kembali = $this->input->post('tanggal_kembali');


        // Menyimpan data ke dalam database
        $data = array(
            'id_hardware' => $id_hardware,
            'tgl_pinjam' => $tanggal_pinjam,
            'peminjam' => $peminjam,
            'tgl_kembali' => $tanggal_kembali,
        );
        $where = array(
            'id_pinjam' => $id
        );

        // Melakukan update pada tabel 'divisi' dengan kondisi WHERE yang telah ditentukan
        $this->db->update('pinjam', $data, $where);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_update_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil Diupdate!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

        // Mengalihkan pengguna kembali ke halaman Divisi
        redirect('HRD/HistoryPeminjaman');
    }
    public function deleteData($id)
    {
        $where = array(
            'id_pinjam' => $id
        );
        $this->db->where($where);
        $this->db->delete('pinjam');

        $this->session->set_flashdata('pesan_hapus_berhasil', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('HRD/HistoryPeminjaman');
    }
}
