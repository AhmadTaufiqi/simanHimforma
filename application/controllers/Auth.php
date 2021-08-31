<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		// is_logged_in();
	}
	
	public function index()
	{
		if ($this->session->userdata('email')) {
			// redirect('user');
			echo "<script>
					window.history.back();
			</script>";
		}


		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'LOGIN SYSTEM';
			$this->load->view('Templates/auth_header', $data);
			$this->load->view('Auth/login');
			$this->load->view('Templates/auth_footer');
		} else {
			$this->_login();
		}
	}


	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		//if usser ada
		if ($user) {
			//cek password
			if (password_verify($password, $user['password'])) {
				$data = [
					'email' => $user['email'],
					'role_id' => $user['role_id']
				];
				$this->session->set_userdata($data);
				redirect('Dashboard');
				// if ($user['role_id'] == 1) {
				// 	redirect('Dashboard');
				// } else {
				// 	redirect('Dashboard');
				// }
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					wrong password </div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					email is not registered! </div>');
			redirect('auth');
		}
	}


	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role"alert">you have been logged out </div>');
		redirect('auth');
	}


	public function blocked()
	{
		$this->load->view('Auth/blocked');
	}
	public function manualChangePassword(){
		$password = "1234";
		 $new_pass = password_hash($password, PASSWORD_DEFAULT);
		 echo ($password. "</br>");
		 echo("<textarea name='' id='' cols='30' rows='10'>".$new_pass."</textarea>");
		 
	}
}
