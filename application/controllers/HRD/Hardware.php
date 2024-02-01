<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hardware extends CI_Controller
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
        $data['title'] = "Hardware";
        $data['Data'] = $this->db->query("SELECT 
        tp.nama_type_hardware AS nama_hardware, hd.id_hardware AS id_hardware, hd.harga AS harga, hd.tanggal_pembelian AS tanggal_pembelian, hd.nama_pic AS pengguna, dp.nama_departemen AS nama_departemen, hd.spesifikasi AS spesifikasi, hd.sts_asset AS status_hardware
        FROM hardware hd
        LEFT JOIN departemen dp ON dp.id_departemen=hd.id_departemen
        LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type;
        ")->result();
        $data['Tipe'] = $this->db->query("SELECT * FROM type_hardware")->result();
        $data['Departemen'] = $this->db->query("SELECT * FROM departemen")->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-hrd');
        $this->load->view('templates/topbar');
        $this->load->view('HRD/master/Hardware/DataHardware', $data);
        $this->load->view('templates/footer');
    }
    public function tambahDataAksi()
    {
        // Mengambil data dari formulir
        $id_type = $this->input->post('tipe_hardware');
        $id_departemen = $this->input->post('id_departemen');
        $pengguna = $this->input->post('pengguna');
        $spesifikasi = $this->input->post('spesifikasi');
        $tanggal_pembelian = $this->input->post('tanggal_pembelian');
        $harga = $this->input->post('harga');
        $status = $this->input->post('status');


        // Menyimpan data ke dalam database
        $data = array(
            'id_type' => $id_type,
            'id_departemen' => $id_departemen,
            'nama_pic' => $pengguna,
            'spesifikasi' => $spesifikasi,
            'tanggal_pembelian' =>$tanggal_pembelian,
            'harga' => $harga,
            'sts_asset' => $status,
            

        );
        $this->db->insert('hardware', $data);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_tambah_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');

        // Mengalihkan pengguna kembali ke halaman User
        redirect('HRD/Hardware');
    }
    public function updateDataAksi()
    {
        // Mengambil data dari formulir
        $id = $this->input->post('id_hardware');
        $id_type = $this->input->post('tipe_hardware');
        $id_departemen = $this->input->post('id_departemen');
        $pengguna = $this->input->post('pengguna');
        $spesifikasi = $this->input->post('spesifikasi');
        $tanggal_pembelian = $this->input->post('tanggal_pembelian');
        $harga = $this->input->post('harga');
        $status = $this->input->post('status');


        // Menyimpan data ke dalam database
        $data = array(
            'id_type' => $id_type,
            'id_departemen' => $id_departemen,
            'nama_pic' => $pengguna,
            'spesifikasi' => $spesifikasi,
            'tanggal_pembelian' =>$tanggal_pembelian,
            'harga' => $harga,
            'sts_asset' => $status,

        );
        $where = array(
            'id_hardware' => $id
        );

        // Melakukan update pada tabel 'divisi' dengan kondisi WHERE yang telah ditentukan
        $this->db->update('hardware', $data, $where);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_update_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil Diupdate!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

        // Mengalihkan pengguna kembali ke halaman Divisi
        redirect('HRD/Hardware');
    }
    public function deleteData($id)
    {
        $where = array(
            'id_hardware' => $id
        );
        $this->db->where($where);
        $this->db->delete('hardware');

        $this->session->set_flashdata('pesan_hapus_berhasil', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('HRD/Hardware');
    }
}
