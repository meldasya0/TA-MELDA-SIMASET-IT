<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipe extends CI_Controller {
    
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
        $data['title'] = "Tipe Perangkat Keras"; 
         $data['Data'] =$this->db->query("SELECT * FROM type_hardware;
        ")->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-hrd');
        $this->load->view('templates/topbar');
        $this->load->view('HRD/master/Tipe/DataTipe',$data);
        $this->load->view('templates/footer');
    }
    public function tambahDataAksi()
    {
        // Mengambil data dari formulir
        $nama_tipe_hardware = $this->input->post('nama_tipe_hardware');


        // Menyimpan data ke dalam database
        $data = array(
            'nama_type_hardware' => $nama_tipe_hardware,
        );
        $this->db->insert('type_hardware', $data);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_tambah_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');

        // Mengalihkan pengguna kembali ke halaman User
        redirect('HRD/Tipe');
    }
    public function updateDataAksi()
    {
        // Mengambil data dari formulir
        $id = $this->input->post('id_type');
        $nama_tipe_hardware = $this->input->post('nama_tipe_hardware');


        // Menyimpan data ke dalam database
        $data = array(
            'nama_type_hardware' => $nama_tipe_hardware,
        );
        $where = array(
            'id_type' => $id
        );

        // Melakukan update pada tabel 'divisi' dengan kondisi WHERE yang telah ditentukan
        $this->db->update('type_hardware', $data, $where);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_update_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil Diupdate!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

        // Mengalihkan pengguna kembali ke halaman Divisi
        redirect('HRD/Tipe');
    }
    public function deleteData($id)
    {
        $where = array(
            'id_type' => $id
        );
        $this->db->where($where);
        $this->db->delete('type_hardware');

        $this->session->set_flashdata('pesan_hapus_berhasil', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('HRD/Tipe');
    }
}