<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hardware extends CI_Controller
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
        $data['title'] = "Hardware";
        $data['Data'] = $this->db->query("SELECT 
        tp.nama_type_hardware AS nama_hardware, hd.id_hardware AS id_hardware, hd.id_departemen AS id_departemen, hd.id_type, hd.kode_aset AS kode_aset, hd.harga AS harga, hd.tanggal_pembelian AS tanggal_pembelian, hd.nama_pic AS pengguna, dp.nama_departemen AS nama_departemen, hd.spesifikasi AS spesifikasi, hd.sts_asset AS status_hardware
        FROM hardware hd
        LEFT JOIN departemen dp ON dp.id_departemen=hd.id_departemen
        LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type;
        ")->result();
        $data['Tipe'] = $this->db->query("SELECT * FROM type_hardware")->result();
        $data['Departemen'] = $this->db->query("SELECT * FROM departemen")->result();
    
        // Loop through the result to generate the asset codes
        foreach ($data['Data'] as $key => $item) {
            $nama_hardware = $item->nama_hardware;
            $nama_departemen = $item->nama_departemen;
            $pengguna = $item->pengguna;
    
            // Generate Kode Aset menggunakan fungsi generateKodeAset
            $kode_aset = $this->generateKodeAset($nama_hardware, $nama_departemen, $pengguna);
    
            // Assign the generated code back to the data
            $data['Data'][$key]->kode_aset = $kode_aset;
        }
    
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-it');
        $this->load->view('templates/topbar');
        $this->load->view('IT/master/Hardware/DataHardware', $data);
        $this->load->view('templates/footer');
    }
    
    public function generateKodeAset($nama_hardware, $nama_departemen, $pengguna)
    {
        // Mengambil inisial dari nama hardware (3 karakter pertama)
        $inisial_hardware = substr($nama_hardware, 0, 3);
    
        // Mengambil inisial dari nama departemen (2 karakter pertama)
        $inisial_departemen = substr($nama_departemen, 0, 2);
    
        // Mengambil inisial dari nama pengguna (2 karakter pertama)
        $inisial_pengguna = substr($pengguna, 0, 2);
    
        // Menggabungkan inisial-inisial tersebut
        $kode_aset = strtoupper($inisial_hardware . $inisial_departemen . $inisial_pengguna);
    
        return $kode_aset;
    }
    
    public function tambahDataAksi()
{
    // Mengambil data dari formulir
    $id_type = $this->input->post('tipe_hardware');
    $id_departemen = $this->input->post('id_departemen');
    $pengguna = $this->input->post('pengguna');
    $spesifikasi = $this->input->post('spesifikasi');
    $tanggal_pembelian = $this->input->post('tanggal_pembelian');
    $hargaPost = $this->input->post('harga');
    $harga = preg_replace("/[^0-9]/", "",$hargaPost);
    $status = $this->input->post('status');

    // Validasi input form
    $this->form_validation->set_rules('tipe_hardware', 'Tipe Hardware', 'required');
    $this->form_validation->set_rules('id_departemen', 'Departemen', 'required');
    $this->form_validation->set_rules('pengguna', 'Pengguna', 'required');
    $this->form_validation->set_rules('spesifikasi', 'Spesifikasi', 'required');
    $this->form_validation->set_rules('tanggal_pembelian', 'Tanggal Pembelian', 'required');
    $this->form_validation->set_rules('harga', 'Harga', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');

    // Jalankan validasi
    if ($this->form_validation->run() == FALSE) {
        // Validasi gagal, atur pesan kesalahan dan kembali ke halaman sebelumnya
        $this->session->set_flashdata('pesan_tambah_gagal', validation_errors());
        redirect('IT/Hardware');
    } else {
        // Mengambil nama hardware, nama departemen, dan pengguna dari database
        $nama_hardware = $this->db->get_where('type_hardware', ['id_type' => $id_type])->row()->nama_type_hardware;
        $nama_departemen = $this->db->get_where('departemen', ['id_departemen' => $id_departemen])->row()->nama_departemen;

        // Generate Kode Aset menggunakan fungsi generateKodeAset
        $kode_aset = $this->generateKodeAset($nama_hardware, $nama_departemen, $pengguna);

        // Menyimpan data ke dalam database
        $data = array(
            'kode_aset' => $kode_aset,
            'id_type' => $id_type,
            'id_departemen' => $id_departemen,
            'nama_pic' => $pengguna,
            'spesifikasi' => $spesifikasi,
            'tanggal_pembelian' => $tanggal_pembelian,
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
        redirect('IT/Hardware');
    }
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
        redirect('IT/Hardware');
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
        redirect('IT/Hardware');
    }
}
