<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departemen extends CI_Controller
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
        $data['title'] = "Departemen";
        $data['Data'] = $this->db->query("SELECT id_departemen, dep.nama_departemen AS nama_departemen, dv.nama_divisi AS nama_divisi FROM departemen dep LEFT JOIN divisi dv ON dv.id_divisi = dep.id_divisi")->result();
        $data['dataDivisi'] = $this->db->query("SELECT  * FROM divisi")->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-hrd');
        $this->load->view('templates/topbar');
        $this->load->view('HRD/master/Departemen/DataDepartemen', $data);
        $this->load->view('templates/footer');
    }
    public function tambahDataAksi()
    {
        // Mengambil data dari formulir
        $nama = $this->input->post('nama_departemen');
        $divisi = $this->input->post('id_divisi');


        // Menyimpan data ke dalam database
        $data = array(
            'id_divisi' => $divisi,
            'nama_departemen' => $nama,

        );
        $this->db->insert('departemen', $data);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_tambah_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');

        // Mengalihkan pengguna kembali ke halaman User
        redirect('HRD/Departemen');
    }
    public function updateDataAksi()
    {
        // Mengambil data dari formulir
        $id = $this->input->post('id_departemen');
        $nama = $this->input->post('nama_departemen');
        $divisi = $this->input->post('divisi');

        if ($divisi == 0) {
            $this->session->set_flashdata('divisi_error', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil Diupdate!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        }

        // Menyimpan data ke dalam array untuk update
        $data = array(
            'nama_departemen' => $nama,
        );
        $where = array(
            'id_departemen' => $id
        );

        // Melakukan update pada tabel 'divisi' dengan kondisi WHERE yang telah ditentukan
        $this->db->update('departemen', $data, $where);

        // Mengatur pesan flashdata
        $this->session->set_flashdata('pesan_update_berhasil', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil Diupdate!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');

        // Mengalihkan pengguna kembali ke halaman Divisi
        redirect('HRD/Departemen');
    }
    public function deleteData($id)
    {
        $where = array(
            'id_departemen' => $id
        );
        $this->db->where($where);
        $this->db->delete('departemen');

        $this->session->set_flashdata('pesan_hapus_berhasil', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Data Berhasil Dihapus!</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>');
        redirect('HRD/Departemen');
    }
}
