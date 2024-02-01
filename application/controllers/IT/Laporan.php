<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {    
    public function __construct()
    {
        parent::__construct();
        $level = $this->session->userdata("level");
        if ($level != '1') {
            redirect("Login");
        }
    }
    public function index()
	{
        $data['title'] = "Laporan History Peminjaman"; 
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-it');
        $this->load->view('templates/topbar');
        $this->load->view('IT/LaporanAset',$data);
        $this->load->view('templates/footer');
	}
    public function Aset()
	{
        $data['title'] = "Laporan Data Aset"; 
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-it');
        $this->load->view('templates/topbar');
        $this->load->view('IT/LaporanAset',$data);
        $this->load->view('templates/footer');
	}
    public function exportAset()
	{
        $data['title'] = "Laporan Data Aset";
        $tanggalMulai = $this->input->post("tanggal_mulai");
        $tanggalAkhir = $this->input->post("tanggal_akhir");
        if($tanggalMulai !== "" && $tanggalAkhir !== ""){ 
            $data['Data'] = $this->db->query("SELECT 
            s.id_software, tp.nama_type_hardware AS nama_hardware, nama_software, lisensi, s.tanggal_pembelian, s.harga, hd.nama_pic AS pengguna
            FROM software s
            LEFT JOIN hardware hd ON s.id_hardware=hd.id_hardware
            LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type;
            WHERE s.tanggal_pembelian BETWEEN '$tanggalMulai' AND '$tanggalAkhir
            ")->result();
         }else{
            $data['Data'] = $this->db->query("SELECT 
            s.id_software, tp.nama_type_hardware AS nama_hardware, nama_software, lisensi, s.tanggal_pembelian, s.harga, hd.nama_pic AS pengguna
            FROM software s
            LEFT JOIN hardware hd ON s.id_hardware=hd.id_hardware
            LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type;
            ")->result();
         }
        $this->load->view('templates/header');
        $this->load->view('IT/LaporanAsetExport',$data);
	}
    public function Perbaikan()
	{
        $data['title'] = "Laporan History Perbaikan"; 
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-it');
        $this->load->view('templates/topbar');
        $this->load->view('IT/LaporanPerbaikan',$data);
        $this->load->view('templates/footer');
	}
    public function exportPerbaikan()
	{
        $data['title'] = "Laporan History Perbaikan";
        $tanggalMulai = $this->input->post("tanggal_mulai");
        $tanggalAkhir = $this->input->post("tanggal_akhir");
        if($tanggalMulai !== "" && $tanggalAkhir !== ""){ 
            $data['Data'] = $this->db->query("SELECT 
            id_repair, tp.nama_type_hardware AS nama_hardware, dp.nama_departemen, hd.nama_pic AS pengguna, tanggal_perbaikan, hs.deskripsi, tindakan, biaya, vendor
            FROM history_perbaikan hs
            LEFT JOIN hardware hd ON hs.id_hardware=hd.id_hardware
            LEFT JOIN departemen dp ON dp.id_departemen=hd.id_departemen
            LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type
            WHERE hs.tanggal_perbaikan BETWEEN '$tanggalMulai' AND '$tanggalAkhir';
            ")->result();
         }else{           
            $data['Data'] = $this->db->query("SELECT 
            id_repair, tp.nama_type_hardware AS nama_hardware, dp.nama_departemen, hd.nama_pic AS pengguna, tanggal_perbaikan, hs.deskripsi, tindakan, biaya, vendor
            FROM history_perbaikan hs
            LEFT JOIN hardware hd ON hs.id_hardware=hd.id_hardware
            LEFT JOIN departemen dp ON dp.id_departemen=hd.id_departemen
            LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type;
            ")->result();
         }
        $this->load->view('templates/header');
        $this->load->view('IT/LaporanPerbaikanExport',$data);
	}
    public function Peminjaman()
	{
        $data['title'] = "Laporan History Peminjaman"; 
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-it');
        $this->load->view('templates/topbar');
        $this->load->view('IT/LaporanPeminjaman',$data);
        $this->load->view('templates/footer');
	}
    public function exportPeminjaman()
	{
        $data['title'] = "Laporan History Peminjaman";
        $tanggalMulai = $this->input->post("tanggal_mulai");
        $tanggalAkhir = $this->input->post("tanggal_akhir");
        if($tanggalMulai !== "" && $tanggalAkhir !== ""){
            $data['Data'] = $this->db->query("SELECT 
            id_pinjam, tp.nama_type_hardware AS nama_hardware, dp.nama_departemen, hd.nama_pic AS pengguna, tgl_pinjam, peminjam, tgl_kembali
            FROM pinjam pj
            LEFT JOIN hardware hd ON pj.id_hardware=hd.id_hardware
            LEFT JOIN departemen dp ON dp.id_departemen=hd.id_departemen
            LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type;
            ")->result();
         }else{
            $data['Data'] = $this->db->query("SELECT 
            id_pinjam, tp.nama_type_hardware AS nama_hardware, dp.nama_departemen, hd.nama_pic AS pengguna, tgl_pinjam, peminjam, tgl_kembali
            FROM pinjam pj
            LEFT JOIN hardware hd ON pj.id_hardware=hd.id_hardware
            LEFT JOIN departemen dp ON dp.id_departemen=hd.id_departemen
            LEFT JOIN type_hardware tp ON tp.id_type=hd.id_type;
            ")->result();
         }
        $this->load->view('templates/header');
        $this->load->view('IT/LaporanPeminjamanExport',$data);
	}
}
