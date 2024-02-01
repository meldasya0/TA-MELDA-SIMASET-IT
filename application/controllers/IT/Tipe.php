<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipe extends CI_Controller {
    
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
        $data['title'] = "Tipe Perangkat Keras"; 
         $data['Data'] =$this->db->query("SELECT * FROM type_hardware;
        ")->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-it');
        $this->load->view('templates/topbar');
        $this->load->view('IT/master/Tipe/DataTipe',$data);
        $this->load->view('templates/footer');
    }
    public function tambahDataAksi()
    {
        // Set rules validasi
    $this->form_validation->set_rules('nama_tipe_hardware', 'Tipe Hardware', 'required');

    // Jalankan validasi
    if ($this->form_validation->run() == FALSE) {
        validation_errors();
        
       $this->session->set_flashdata('pesan_tambah_gagal', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Data gagal Ditambahkan!</strong>
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
       </button>
   </div>');
        redirect('IT/Tipe');

        //untuk menghentikan eksekusi selanjutnya 
    }else{
        //validasi berhasil, lanjutkan dengan penyimpanan data 
    }
        // Mengambil data dari formulir
        $nama_tipe_hardware = $this->input->post('nama_tipe_hardware');
        // Menyimpan data ke dalam database
        $data = array(
            'nama_type_hardware' => $nama_tipe_hardware,
        );
        $this->db->insert('type_hardware', $data);
       
        $this->session->set_flashdata('pesan_tambah_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data Berhasil Ditambahkan!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>');
        // Mengalihkan pengguna kembali ke halaman User
        redirect('IT/Tipe');
    }
   public function updateDataAksi()
{
    // Set rules validasi
    $this->form_validation->set_rules('id_type', 'ID type', 'required');
    $this->form_validation->set_rules('nama_type_hardware', 'Tipe Hardware', 'required');

    // Jalankan validasi
    if ($this->form_validation->run() == FALSE) {
        // Validasi gagal, atur pesan kesalahan dan kembali ke halaman sebelumnya
        $this->session->set_flashdata('pesan_update_gagal', validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'));
        redirect('IT/Tipe');
    } else {
        // Validasi sukses, lanjutkan dengan penyimpanan data ke database
        // Mengambil data dari formulir
        $id = $this->input->post('id_type');
        $nama_type_hardware = $this->input->post('nama_type_hardware');

        // Menyimpan data ke dalam array untuk update
        $data = array('nama_type_hardware' => $nama_type_hardware);
        $where = array('id_type' => $id);

        // Melakukan update pada tabel 'nama_type_hardware' dengan kondisi WHERE yang telah ditentukan
        $this->db->update('type_hardware', $data, $where);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_update_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil Diupdate!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

        // Mengalihkan pengguna kembali ke halaman IT/Tipe
        redirect('IT/Tipe');
    }
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
        redirect('IT/Tipe');
    }
}