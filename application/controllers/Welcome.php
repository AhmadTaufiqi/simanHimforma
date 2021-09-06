<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('role_id') == 1) {
			redirect('dashboard');
		} else if($this->session->userdata('role_id') == 2) {
			redirect('dashboard');
		}
	}
	public function index()
	{
		$this->load->view('landing_page');
	}
}
