<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LandingPage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('role_id') == 1) {
			redirect('dashboard');
		} else if ($this->session->userdata('role_id') == 2) {
			redirect('dashboard');
		}
		$this->load->model('Kegiatan_model');
	}
	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['dashboard'] = "Kepengurusan";

		$program = $this->Kegiatan_model->Perencanaan();
		foreach ($program as $pg) {
			$dt['prog'] = $pg['nama_kegiatan'];
			$dt['total_dana'] = $pg['dana_keseluruhan'];
			$dt['warna'] = $pg['warna_terlaksana'];
			$dt['border'] = $pg['border'];

			$prog[] = $dt['prog'];
			$dana[] = $dt['total_dana'];
			$warna[] = $dt['warna'];
			$border[] = $dt['border'];
		}

		// echo json_encode($dana);
		$data['data_chart'] = 'labels: ' . json_encode($prog) . ',
        datasets: [
        {
            label: ["terlaksana"],
            data: [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,],
            
            backgroundColor:' . json_encode($warna) . ',
            borderColor: ' . json_encode($border) . ',
            borderWidth: 2
        },
        {
          label:["belum terlaksana"],
          backgroundColor :"rgba(255, 99, 132, 0.2)",
          borderColor: "rgba(255,99,132,1)",
          borderWidth:2

        }
        ]';
		$this->load->view('landing_page', $data);
		$this->load->view('Templates/footer');
	}
}
