<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Divisi extends CI_Controller
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
        $data['title'] = "Divisi";
        $data['Data'] = $this->db->query("SELECT  * FROM divisi")->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-hrd');
        $this->load->view('templates/topbar');
        $this->load->view('HRD/master/Divisi/DataDivisi', $data);
        $this->load->view('templates/footer');
    }
    public function tambahDataAksi()
    {
        // Mengambil data dari formulir
        $nama = $this->input->post('nama_divisi');


        // Menyimpan data ke dalam database
        $data = array(
            'nama_divisi' => $nama,

        );
        $this->db->insert('divisi', $data);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_tambah_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');

        // Mengalihkan pengguna kembali ke halaman User
        redirect('HRD/Divisi');
    }
    public function updateDataAksi()
    {
        // Mengambil data dari formulir
        $id = $this->input->post('id_divisi');
        $nama = $this->input->post('nama_divisi');

        // Menyimpan data ke dalam array untuk update
        $data = array(
            'nama_divisi' => $nama,
        );
        $where = array(
            'id_divisi' => $id
        );

        // Melakukan update pada tabel 'divisi' dengan kondisi WHERE yang telah ditentukan
        $this->db->update('divisi', $data, $where);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_update_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil Diupdate!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

        // Mengalihkan pengguna kembali ke halaman Divisi
        redirect('HRD/Divisi');
    }
    public function deleteData($id)
    {
        $where = array(
            'id_divisi' => $id
        );
        $this->db->where($where);
        $this->db->delete('divisi');

        $this->session->set_flashdata('pesan_hapus_berhasil', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('HRD/Divisi');
    }
}
