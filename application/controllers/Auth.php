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

		//if usser ada
		//cek password
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'email' => $user['email'],
					'role_id' => $user['role_id']
				];
				$this->session->set_userdata($data);
				redirect('Dashboard');
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

	public function ForgotPassword() 	
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Forgot Password';
			$this->load->view('Templates/auth_header', $data);
			$this->load->view('Auth/forgot_password');
			$this->load->view('Templates/auth_footer');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email])->row_array();
			if ($user) {
				$token = base64_encode(random_bytes(32));
				// $token = "tetel";
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];
				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password</div>');
				redirect('Auth/ForgotPassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated</div>');
				redirect('Auth/ForgotPassword');
			}
		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'ahmadtaufiky1@gmail.com',
			'smtp_pass' => 'ahmadtaufiky2000',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('Email', $config);
		$this->email->initialize($config);

		$this->email->from('ahmadtaufiky1@gmail.com', 'ahmad taufiky');
		$this->email->to($this->input->post('email'));
		//verify password
		//reset password
		if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('click this link to forgot your password:<a href="' . base_url() .
				'Auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) .
				'">reset your password</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">reset tidak berhasil</div>');
			redirect('Auth/ForgotPassword');
			die;
		}
	}

	
	public function changePassword()
	{

		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[4]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[4]|matches[password1]');
		if ($this->form_validation->run() == false) {

			$data['title'] = 'Change Password';
			$this->load->view('Templates/auth_header', $data);
			$this->load->view('auth/change_password');
			$this->load->view('Templates/auth_footer');
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->unset_userdata('reset_email');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your password has been changed! Please login.</div>');
			redirect('auth');
		}
	}

	
	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token</div>');
				redirect('auth/forgotpassword');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email</div>');
			redirect('auth/forgotpassword');
		}
	}
}
