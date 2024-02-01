<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {   

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
        $data['title'] = "Dashboard"; 
        $data['totalDataAset'] = $this->db->query("SELECT * FROM hardware")->num_rows(); 
        $data['totalDataPeminjaman'] = $this->db->query("SELECT * FROM pinjam")->num_rows(); 
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-hrd');
        $this->load->view('templates/topbar');
        $this->load->view('HRD/dashboard',$data);
        $this->load->view('templates/footer');
	}
}
