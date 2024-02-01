<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {    
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
        $data['title'] = "User"; 
        $data['Data'] = $this->db->query("SELECT  * FROM user")->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-hrd');
        $this->load->view('templates/topbar');
        $this->load->view('HRD/master/user/DataUser', $data);
        $this->load->view('templates/footer');
    }

    public function tambahDataAksi()
    {
        // Mengambil data dari formulir
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $departemen = $this->input->post('departemen');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $passwordDB = md5(md5($password));
        // Menyimpan data ke dalam database
        $data = array(
            'nama' => $nama,
            'departemen' => $departemen,
            'level' => $level,
            'username' => $username,
            'password' => $passwordDB,
        );
        $this->db->insert('user', $data);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_tambah_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data Berhasil Ditambahkan!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>');

        // Mengalihkan pengguna kembali ke halaman User
        redirect('HRD/User');
    }
    public function updateDataAksi()
    {
        // Mengambil data dari formulir
        $id = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $departemen = $this->input->post('departemen');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $passwordDB = md5(md5($password));
    
        // Menyimpan data ke dalam array untuk update
        $data = array(
            'nama' => $nama,
            'departemen' => $departemen,
            'level' => $level,
            'username' => $username,
            'password' => $passwordDB,
        );
        $where = array(
            'id_user' =>$id
        );
    
        // Melakukan update pada tabel 'divisi' dengan kondisi WHERE yang telah ditentukan
        $this->db->update('user', $data,$where);
    
        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Diupdate!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    
        // Mengalihkan pengguna kembali ke halaman Divisi
        redirect('HRD/User');
    
    }
    public function deleteData($id){
        $where = array(
            'id_user' => $id   
        );
        $this->db->where($where);
        $this->db->delete('user');

        $this->session->set_flashdata('pesan_hapus_berhasil', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Data Berhasil Dihapus!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>');
        redirect('HRD/User');

    }
    
}
