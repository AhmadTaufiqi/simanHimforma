<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // $this->load->model('arsip_model');
    $this->load->model('user_model');
    $this->load->model('Kegiatan_model');
    if (!$this->session->userdata('email')) {
      redirect('welcome');
    }
  }

  public function index()
  {
    $data['user'] = $this->user_model->dataUser();
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
            data: ' . json_encode($dana) . ',
            
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

    $this->load->view('Templates/header', $data);
    $this->load->view('Templates/sidebar', $data);
    $this->load->view('Templates/topbar', $data);
    $this->load->view('Kepengurusan/dashboard', $data);
    $this->load->view('Templates/footer');
  }


}
