<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Divisi extends CI_Controller
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
        $data['title'] = "Divisi";
        $data['Data'] = $this->db->query("SELECT  * FROM divisi")->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-it');
        $this->load->view('templates/topbar');
        $this->load->view('IT/master/Divisi/DataDivisi', $data);
        $this->load->view('templates/footer');
    }

    public function tambahDataAksi()
{
    // Set rules validasi
    $this->form_validation->set_rules('nama_divisi', 'Nama Divisi', 'required');

    // Jalankan validasi
    if ($this->form_validation->run() == FALSE) {
         validation_errors();
         
        $this->session->set_flashdata('pesan_tambah_gagal', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data gagal Ditambahkan!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>');
         redirect('IT/Divisi');

        // Untuk menghentikan eksekusi selanjutnya
    } else {
        // Validasi berhasil, lanjutkan dengan penyimpanan data
        $nama = $this->input->post('nama_divisi');
        $data = array('nama_divisi' => $nama);
        $this->db->insert('divisi', $data);

        $this->session->set_flashdata('pesan_tambah_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('IT/Divisi');
    }
}


    public function updateDataAksi()
    {
        // Set rules validasi
        $this->form_validation->set_rules('id_divisi', 'ID Divisi', 'required');
        $this->form_validation->set_rules('nama_divisi', 'Nama Divisi', 'required');

        // Jalankan validasi
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan_update_gagal', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                '. validation_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('IT/Divisi');
        } else {
            // Validasi berhasil, lanjutkan dengan update data
            $id = $this->input->post('id_divisi');
            $nama = $this->input->post('nama_divisi');
            $data = array('nama_divisi' => $nama);
            $where = array('id_divisi' => $id);
            $this->db->update('divisi', $data, $where);

            $this->session->set_flashdata('pesan_update_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil Diupdate!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('IT/Divisi');
        }
    }

    public function deleteData($id)
    {
        $where = array('id_divisi' => $id);
        $this->db->where($where);
        $this->db->delete('divisi');

        $this->session->set_flashdata('pesan_hapus_berhasil', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('IT/Divisi');
    }
}
