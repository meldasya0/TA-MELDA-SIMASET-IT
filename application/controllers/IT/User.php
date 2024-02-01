<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
        $data['title'] = "User"; 
        $data['Data'] = $this->db->query("SELECT * FROM user")->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-it');
        $this->load->view('templates/topbar');
        $this->load->view('IT/master/user/DataUser', $data);
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

        // Validasi: Apakah semua field telah diisi
        if (empty($nama) || empty($level) || empty($departemen) || empty($username) || empty($password)) {
            $this->session->set_flashdata('pesan_tambah_gagal', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Semua Field Harus Diisi!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('IT/User');
            
            return;
        }

        // Validasi panjang password minimal (contoh: minimal 6 karakter)
        if (strlen($password) < 6) {
            $this->session->set_flashdata('pesan_tambah_gagal', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Password Harus minimal 6 Karakter!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            redirect('IT/User');
            return;
        }

        // Validasi format email (gunakan valid_email dari CodeIgniter)
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $this->session->set_flashdata('pesan_tambah_gagal', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Format Email tidak Valid!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            redirect('IT/User');
            return;
        }

        // Jika semua validasi berhasil, lanjutkan dengan penyimpanan data ke database
        $passwordDB = md5(md5($password));
        $data = array(
            'nama' => $nama,
            'departemen' => $departemen,
            'level' => $level,
            'username' => $username,
            'password' => $passwordDB,
        );

        // Simpan data ke dalam database
        $this->db->insert('user', $data);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_tambah_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data Berhasil Ditambahkan!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>');

        // Mengalihkan pengguna kembali ke halaman User
        redirect('IT/User');
    }

    public function updateDataAksi()
    {
        // Ambil data dari formulir
        $id = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $departemen = $this->input->post('departemen');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        // Set rules validasi
        $this->form_validation->set_rules('id_user', 'ID User', 'required|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required|numeric');
        $this->form_validation->set_rules('departemen', 'Departemen', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        // Jalankan validasi
        if ($this->form_validation->run() == FALSE) {
            // Validasi gagal, atur pesan kesalahan dan kembali ke halaman sebelumnya
            $this->session->set_flashdata('pesan_update_gagal', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            '. validation_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            redirect('IT/User');
        } else {
            // Validasi sukses, lakukan update
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
                'id_user' => $id
            );
    
            // Melakukan update pada tabel 'user' dengan kondisi WHERE yang telah ditentukan
            $this->db->update('user', $data, $where);
    
            // Mengatur pesan flashdata
            $this->session->set_flashdata('pesan_update_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Diupdate!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
    
            // Mengalihkan pengguna kembali ke halaman User
            redirect('IT/User');
        }
    }

    public function deleteData($id)
    {
        // Keamanan: Escape $id untuk mencegah SQL injection
        $id = $this->db->escape_str($id);
    
        $where = array(
            'id_user' => $id
        );
    
        // Hapus data dari tabel 'user'
        $this->db->where($where);
        $this->db->delete('user');
    
        // Periksa apakah penghapusan berhasil
        if ($this->db->affected_rows() > 0) {
            // Penghapusan berhasil
            $this->session->set_flashdata('pesan_hapus_berhasil','<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        } else {
            // Penghapusan gagal
            $this->session->set_flashdata('pesan_hapus_gagal', 'Gagal menghapus data.');
        }
    
        // Redirect ke halaman 'IT/User'
        redirect('IT/User');
    }
}    