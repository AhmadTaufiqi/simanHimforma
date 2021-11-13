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
    $periode = $this->db->get_where('periode',['status' => 1])->row_array();
    $where = ['tgl_periode' => $periode['tap_periode']] ;
    $this->db->order_by('nama', 'asc');
    $data['pengurus'] = $this->db->get_where('pengurus', $where)->result_array();
    foreach ($data['pengurus'] as $ar) {
      $this->db->select_sum('nominal');
      $kas = $this->db->get_where('kas_pengurus', ['npm' => $ar['npm']])->row_array();
      $data2 = $kas['nominal'];

      // $data2[] = $kas['nominal'];
      $uang[] = $data2;
    }
    if(isset($uang)){
      $data['uang'] = array_sum($uang);
    }else{
      $data['uang'] = 0;
    }
    $data['iuran'] = $this->db->get_where('kas_pengurus',['npm' => '7765250'])->row_array()['nominal'];
    $data['start_date'] = $periode['tap_periode'];

    $data['tagihan'] = $this->_countTagihan($data['start_date'], $data['iuran']);
    $data['title'] = 'kas pengurus';

    $this->load->view('Templates/header', $data);
    $this->load->view('Templates/sidebar', $data);
    $this->load->view('Templates/topbar', $data);
    $this->load->view('Kepengurusan/kas_pengurus', $data);
    $this->load->view('Templates/footer');
  }
  public function testKas(){
    $starttt = strtotime("2020-10-07");
    $sekarang = time();
    $diff = $sekarang - $starttt;
    $hari = $diff / (60 * 60 * 24) ;
    $Minggu = ceil($hari / 7 );
    echo ($Minggu * 3000);

    $nominalss = "3000";
  }
  private function _countTagihan($start , $nominal){
    $start  = strtotime($start);
    $now    = time(); // Waktu now
    $diff   = $now - $start;
    // echo 'umur anda adalah ' . floor($diff / (60 * 60 * 24 * 365)) . ' Tahun'; // Umur anda dalam hitungan tahun
    $hari = $diff / (60 * 60 * 24) ; // Umur anda dalam hitungan hari
    $minggu =  ceil($hari/7);
    return  ($minggu * $nominal) ;

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

  public function TapIuran(){
    $iuran = $this->input->post('tap_iuran');
    if($iuran){
          $data = array(
      'nominal' => $iuran
    );
    $this->db->update('kas_pengurus',$data,['npm' => '7765250']);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">iuran berhasil di tetapkan!</div>');
  }
    redirect('KasPengurus');
  }
  
}
