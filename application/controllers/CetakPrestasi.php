<?php
defined('BASEPATH') or exit('No direct script access allowed');


class CetakPrestasi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // $this->load->model('arsip_model');
    $this->load->model('user_model');
    $this->load->model('Kegiatan_model');
    is_logged_in();
  }

  public function index()
  {
    $data['user'] = $this->user_model->dataUser();
    $data['title'] = 'prestasi';
    $data['prestasi'] = $this->db->get('prestasi')->result_array();
    $this->load->view('Pengawas/pengawas_prestasi', $data);
  }
}
