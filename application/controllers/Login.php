<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function index()
	{
        $this->load->view("login");
    }
    public function Auth()
	{
        $uname = $this->input->post('username');
		$pass = $this->input->post('password');

		$user_check = $this->db->query("SELECT * FROM user WHERE username='$uname' AND password=MD5(MD5('$pass'))");
		if($user_check->num_rows() > 0)
		{
			$getData = $user_check->row_array();
			if($getData['level'] == '1'){
				$this->session->set_userdata('level', $getData['level']);
				$this->session->set_userdata('nama', $getData['nama']);
				$this->session->set_userdata('username', $getData['username']);
				redirect('IT/Dashboard');
			} 
			else if ($getData['level'] == '2'){
				$this->session->set_userdata('level', $getData['level']);
				$this->session->set_userdata('nama', $getData['nama']);
				$this->session->set_userdata('username', $getData['username']);
				redirect('HRD/Dashboard');
			}
		}
		else
		{
			$this->session->set_flashdata('gagal', 
			'<div class="alert alert-danger text-danger alert-dismissible fade show font-italic" role="alert">
				Data Tidak Ditemukan!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>');
			redirect("Login");
		}
    }

	public function logout(){
		$this->session->sess_destroy();
		redirect("Login");
	}
}