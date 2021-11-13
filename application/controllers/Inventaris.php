<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Inventaris extends CI_Controller
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
    $data['title'] = 'inventaris';
    $data['dashboard'] = "Kepengurusan";

    $this->form_validation->set_rules('nama_barang', '"nama barang"', 'required');
    $this->form_validation->set_rules('jumlah_barang', '"jumlah barang"', 'required');
    $this->form_validation->set_rules('kondisi', '"kondisi"', 'required');

    $this->load->view('Templates/header', $data);
    $this->load->view('Templates/sidebar', $data);
    $this->load->view('Templates/topbar', $data);
    $this->load->view('Kepengurusan/inventaris', $data);
    $this->load->view('Templates/footer');
  }

  public function showDataEditIvt(){
    $param1 = $this->input->post('id_inventaris');
    $inventaris = $this->db->get_where('inventaris',['id_ivt' => $param1])->row_array();
    echo json_encode($inventaris);
  }
  public function editInventaris(){
    $row_id = $this->input->post('ROW_ID');
    // echo $row_id;
    $this->form_validation->set_rules('nama_barang', '"Nama Barang"', 'required');
    $this->form_validation->set_rules('jumlah_barang', '"Jumlah Barang"', 'required');
    $this->form_validation->set_rules('kondisi', '"kondisi"', 'required');
    $nama_barang = $this->input->post('nama_barang');
    $jumlah_barang = $this->input->post('jumlah_barang');
    $kondisi = $this->input->post('kondisi');
    if(strlen($nama_barang) == 0 || strlen($jumlah_barang) == 0 || strlen($kondisi) == 0){
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">isi data dengan benar' . validation_errors() . '</div>');
      echo "kosong";
    }else{
      $data = array(
        'nama_barang' => $nama_barang,
        'jumlah_barang' => $jumlah_barang,
        'kondisi' => $kondisi
      );
      $where = ['id_ivt' => $row_id];
      $this->db->update('inventaris', $data, $where);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil edit!</div>'); 
    }
    redirect('Inventaris');
  }
  public function addInventaris()
  {
    $nama_barang = $this->input->post('nama_barang');
    $jumlah_barang = $this->input->post('jumlah_barang');
    $kondisi = $this->input->post('kondisi');
    if (strlen($nama_barang) == 0 || strlen($jumlah_barang) == 0 || strlen($kondisi) == 0) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">data harus di isi lengkap!</div>');
    } else {
      $data = [
        'nama_barang' => $nama_barang,
        'jumlah_barang' => $jumlah_barang,
        'kondisi' => $kondisi
      ];
      $this->db->insert('inventaris', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">inventaris telah ditambahkan!</div>');
    }
    redirect('Inventaris');
  }

  function delInventaris($id_del)
  {
    $this->db->where('id_ivt', $id_del);
    $this->db->delete('inventaris');
    $hasil = $this->db->affected_rows();
    if ($hasil == true) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">inventaris telah di hapus!</div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">inventaris gagal di hapus!</div>');
    }
    redirect('Inventaris');
  }
}
