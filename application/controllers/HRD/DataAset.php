<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DataAset extends CI_Controller {
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
        $data['title'] = "Data Aset"; 
        $data['Data'] = $this->db->query("SELECT  * FROM software")->result();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar-hrd');
        $this->load->view('templates/topbar');
        $this->load->view('HRD/AsetData',$data);
        $this->load->view('templates/footer');

     }
    }