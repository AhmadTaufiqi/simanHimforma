<?php
defined('BASEPATH') or exit('No direct script access allowed');


class KasPengurus extends CI_Controller
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
    $data['dashboard'] = "Kepengurusan";
    $periode = $this->db->get_where('periode', ['status' => 1])->row_array();
    $where = '(tap_periode=' . $periode[''] .')';
    $data['pengurus'] = $this->db->get_where('pengurus', $where)->result_array();
    foreach ($data['pengurus'] as $ar) {
      $this->db->select_sum('nominal');
      $kas = $this->db->get_where('kas_pengurus', ['npm' => $ar['npm']])->row_array();
      $data2 = $kas['nominal'];

      // $data2[] = $kas['nominal'];
      $uang[] = $data2;
    }
    $data['uang'] = array_sum($uang);
    $data['title'] = 'kas pengurus';

    $this->load->view('Templates/header', $data);
    $this->load->view('Templates/sidebar', $data);
    $this->load->view('Templates/topbar', $data);
    $this->load->view('Kepengurusan/kas_pengurus', $data);
    $this->load->view('Templates/footer');
  }

  public function addKeuangan()
  {
    $data = [
      'npm' => $this->input->post('npm'),
      'tanggal' => $this->input->post('tanggal'),
      'nominal' => $this->input->post('nominal')
    ];
    // var_dump($data);
    $this->db->insert('kas_pengurus', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data kas telah ditambahkan!</div>');
    redirect('KasPengurus');
  }
  public function delKeuangan($id)
  {
    $this->db->delete('kas_pengurus', ['id_kas' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data kas berhasil dihapus!</div>');
    redirect('KasPengurus');
  }
  
}
