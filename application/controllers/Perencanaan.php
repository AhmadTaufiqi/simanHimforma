<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Perencanaan extends CI_Controller
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

    $data_table = $this->Kegiatan_model->Perencanaan();
    $data["perencanaan"] = $data_table;
    $data['user'] = $this->user_model->dataUser();
    $data['title'] = 'Perencanaan Program Kerja';
    $this->load->view('Templates/header', $data);
    $this->load->view('Templates/sidebar', $data);
    $this->load->view('Templates/topbar', $data);
    $this->load->view('Kegiatan/perencanaan', $data);
    $this->load->view('Templates/footer');
  }

  public function addPerencanaan()
  {
    $this->form_validation->set_rules('nama', '"nama kegiatan"', 'required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('tujuan', '"tujuan"', 'required|min_length[4]|max_length[50]');
    $this->form_validation->set_rules('sasaran', '"sasaran"', 'required|min_length[4]|max_length[50]');
    $this->form_validation->set_rules('deskripsi', '"deskripsi"', 'required|min_length[1]|max_length[100]');
    $this->form_validation->set_rules('bulan', '"bulan"', 'required');
    $nama_prog = $this->input->post('nama');

    $program = $this->db->get_where('perencanaan', ['nama_kegiatan' => $nama_prog])->result_array();

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="mb-2">isi data dengan benar!</p> <span class="small">' . validation_errors() . '</span></div>');
    } else {
      if (count($program) == 0) {
        $data = array(
          'nama_kegiatan' => $nama_prog,
          'deskripsi' => $this->input->post('deskripsi'),
          'tujuan' => $this->input->post('tujuan'),
          'sasaran' => $this->input->post('sasaran'),
          'tgl_perencanaan' => $this->input->post('bulan')
        );
        // var_dump($data);   
        $this->db->insert('perencanaan', $data);
        $id_perencanaan = $this->db->get_where('perencanaan', ['nama_kegiatan' => $nama_prog])->row_array()['id_perencanaan'];
        $data2 = array(
          'id_perencanaan' => $id_perencanaan,
          'dana_DKM' => $this->input->post('add_DKM'),
          'dana_LKM' => $this->input->post('add_LKM'),
          'dana_sponsor' => $this->input->post('add_sponsor'),
          'dana_lain' => $this->input->post('add_dana_lain'),
        );
        $this->db->insert('sumber_dana_kegiatan', $data2);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil ditambahkan!</div>');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">data sudah tersedia!</div>');
      }
    }
    redirect('Perencanaan');
  }

  public function showDataEditPerencanaan()
  {
    $param1 = $this->input->post('id_program');
    $perencanaan = $this->db->get_where('perencanaan', ['id_perencanaan' => $param1])->row_array();
    if ($sumber_dana = $this->db->get_where('sumber_dana_kegiatan', ['id_perencanaan' => $perencanaan['id_perencanaan']])->row_array()) {
      $dana = $sumber_dana;
    } else {
      $dana = [
        'dana_DKM' => "0",
        'dana_LKM' => "0",
        'dana_sponsor' => "0",
        'dana_lain' => "0"
      ];
    }
    $data = array(
      'id_perencanaan' => $perencanaan['id_perencanaan'],
      'dana_DKM' => $dana['dana_DKM'],
      'dana_LKM' => $dana['dana_LKM'],
      'dana_sponsor' => $dana['dana_sponsor'],
      'dana_lain' => $dana['dana_lain'],
      'nama_kegiatan' => $perencanaan['nama_kegiatan'],
      'deskripsi' => $perencanaan['deskripsi'],
      'tujuan' => $perencanaan['tujuan'],
      'sasaran' => $perencanaan['sasaran'],
      'tgl_perencanaan' => $perencanaan['tgl_perencanaan']
    );
    echo json_encode($data);
  }
  public function editPerencanaan()
  {
    $rowid = $this->input->post('ROW_ID');

    $this->form_validation->set_rules('nama', '"Nama"', 'required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('deskripsi', '"Deskripsi"', 'required|min_length[1]|max_length[100]');
    $this->form_validation->set_rules('tujuan', '"Tujuan"', 'required|min_length[4]|max_length[50]');
    $this->form_validation->set_rules('sasaran', '"Sasaran"', 'required|min_length[4]|max_length[50]');
    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="mb-2">file dan program harus di isi!</p> <span class="small">' . validation_errors() . '</span></div>');
    } else {
      $data = array(
        'nama_kegiatan' => $this->input->post('nama'),
        'deskripsi' => $this->input->post('deskripsi'),
        'tujuan' => $this->input->post('tujuan'),
        'sasaran' => $this->input->post('sasaran'),
        'tgl_perencanaan' => $this->input->post('bulan')
      );
      $where = ['id_perencanaan' => $rowid];
      $this->db->update('perencanaan', $data, $where);
      $data2 = array(
        'dana_DKM' => $this->input->post('dana_DKM'),
        'dana_LKM' => $this->input->post('dana_LKM'),
        'dana_sponsor' => $this->input->post('dana_sponsor'),
        'dana_lain' => $this->input->post('dana_lain')
      );
      $where2 = ['id_perencanaan' => $rowid];
      $this->db->update('sumber_dana_kegiatan', $data2, $where2);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil edit!</div>');
    }
    redirect('Perencanaan');
  }
  public function deletePerencanaan($id_del)
  {
    $pertanggungjwb = $this->db->get_where('pertanggungjwb', ['id_perencanaan' => $id_del])->row_array();
    $pelaksanaan = $this->db->get_where('pelaksanaan', ['id_perencanaan' => $id_del])->row_array();
    // delete perencanaan & dana
    $this->db->delete('sumber_dana_kegiatan', ['id_perencanaan' => $id_del]);
    $this->db->delete('perencanaan', ['id_perencanaan' => $id_del]);

    if ($pelaksanaan) {
      // delete pelaksanaan
      $file_proposal = $this->db->get_where('pelaksanaan', ['id_perencanaan' => $id_del])->row_array()['file_proposal'];
      $this->db->delete('sumber_dana_kegiatan', ['id_pelaksanaan' => $pelaksanaan['id']]);
      $this->db->delete('pelaksanaan', ['id_perencanaan' => $id_del]);
      unlink(FCPATH . 'assets/files/proposal_terlaksana/' . $file_proposal);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">perencanaan dan pelaksanaan berhasil di hapus!</div>');

      if ($pertanggungjwb) {

        $file_lpj = $this->db->get_where('pertanggungjwb', ['id_perencanaan' => $id_del])->row_array()['lpj'];
        $this->db->delete('pertanggungjwb', ['id_perencanaan' => $id_del]);
        unlink(FCPATH . 'assets/files/LPJ/' . $file_lpj);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">perencanaan pelaksanaan dan pertanggungjawaban berhasil di hapus!</div>');
        // delete pertanggungjawaban
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">perencanaan berhasil di hapus!</div>');
    }
    redirect('Perencanaan');
  }
}
