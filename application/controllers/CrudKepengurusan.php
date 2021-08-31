<?php
defined('BASEPATH') or exit('No direct script access allowed');


class CrudKepengurusan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // $this->load->model('arsip_model');
    $this->load->model('user_model');
    $this->load->model('Kegiatan_model');
    if (!$this->session->userdata('email')) {
      redirect('Auth');
    }
  }

  public function addPengurus(){
    echo "add Pengurus";
  }
  public function editPengurus($id_peng){
    echo $id_peng;
  }
  public function delPengurus($id_peng){
    echo $id_peng;
  }

  public function addKeuangan()
  {
    $data = [
      'id_pengurus' => $this->input->post('id_pengurus'),
      'tanggal' => $this->input->post('tanggal'),
      'nominal' => $this->input->post('nominal')
    ];
    // var_dump($data);
    $this->db->insert('kas_pengurus', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data kas telah ditambahkan!</div>');
    redirect('Kepengurusan/keuangan');
  }
  public function delKeuangan($id)
  {
    $this->db->delete('kas_pengurus', ['id' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data kas berhasil dihapus!</div>');
    redirect('Kepengurusan/keuangan');
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
    redirect('Kepengurusan/inventaris');
  }

  function delete_inventaris($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('inventaris');
    $hasil = $this->db->affected_rows();
    if ($hasil == true) {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">inventaris telah di hapus!</div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">inventaris gagal di hapus!</div>');
    }
    redirect('Kepengurusan/inventaris');
  }
}
