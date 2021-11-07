<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pengurus extends CI_Controller
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
    $data['pengurus'] = $this->db->get_where('pengurus')->result_array();
    $data['periode'] = $this->db->get_where('periode')->result_array();
    $data['title'] = 'Pengurus';

    $this->load->view('Templates/header', $data);
    $this->load->view('Templates/sidebar', $data);
    $this->load->view('Templates/topbar', $data);
    $this->load->view('Kepengurusan/pengurus', $data);
    $this->load->view('Templates/footer');
  }

  public function addPengurus()
  {
    // echo "add Pengurus";
    $npm = $this->input->post('npm');
    $file = $_FILES['foto-pengurus']['name'];
    $nama = $this->input->post('nama');
    $jabatan = $this->input->post('jabatan');
    $periode = $this->input->post('periode');

    if (strlen($npm) == 0 || strlen($nama) == 0 || strlen($jabatan) == 0 || strlen($periode) == 0) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">data harus di isi lengkap!</div>');
    } else {

      $numrows = $this->db->get_where('pengurus', ['npm' => $npm])->result_array();
      if (count($numrows) == 0) {

        if (strlen($file) == 0) {
          $data = array(
            'npm' => $npm,
            // 'foto_pengurus' => '',
            'nama' => $nama,
            'jabatan' => $jabatan,
            'tgl_periode' => $periode
          );
          // echo json_encode($data);
          $this->db->insert('pengurus', $data);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di input!</div>');
        } else {
          $config['allowed_types'] = 'img|png|jpg|jpeg';
          $config['max_size'] = '2480';
          $config['upload_path'] = './assets/img/foto_pengurus/';

          $this->load->library('upload', $config);
          if ($this->upload->do_upload('foto-pengurus')) {
            $new_file = $this->upload->data('file_name');
            $data = array(
              'npm' => $npm,
              'foto_pengurus' => $new_file,
              'nama' => $nama,
              'jabatan' => $jabatan,
              'tgl_periode' => $periode
            );

            $this->db->insert('pengurus', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di input!</div>');
          } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">file tidak sesuai syarat!</div>');
            // $data = "file tidak masuk";
          }
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">pengurus sudah tersedia!</div>');
        // $data =  "pengurus sudah ada";
      }
    }
    redirect('Pengurus');
    // echo json_encode($data);
  }
  public function showEditPengurus()
  {
    $npm = $this->input->post('npm');
    $data = $this->db->get_where('pengurus', ['npm' => $npm])->row_array();
    echo json_encode($data);
  }
  public function editPengurus()
  {
    $npm = $this->input->post('npm');
    // echo $npm;
    $this->form_validation->set_rules('nama', '"Nama"', 'required|min_length[4]|max_length[60]');
    $this->form_validation->set_rules('semester', '"Semester"', 'required|max_length[2]');
    $this->form_validation->set_rules('periode1', '"Periode1"', 'required|min_length[4]|max_length[4]');
    $this->form_validation->set_rules('periode2', '"Periode2"', 'min_length[4]|max_length[4]');

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="mb-2">file dan program harus di isi!</p> <span class="small">' . validation_errors() . '</span></div>');
    } else {

      $data2 = $this->db->get_where('pengurus', ['npm' => $npm])->row_array();
      $files = $_FILES['foto_pengurus'];
      if ($files['name']) {
        $config['allowed_types'] = 'png|jpg|jpeg|img';
        $config['max_size'] = '20480';
        $config['upload_path'] = './assets/img/foto_pengurus/';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto-pengurus')) {

          $old_file = $data2['foto_pengurus'];
          $new_file = $this->upload->data('file_name');
          if ($old_file != $new_file) {
            unlink(FCPATH . 'assets/img/foto_pengurus/' . $old_file);
          }
          // $this->db->set('file_proposal', $new_file);
        } else {
          echo  $this->upload->display_errors();
        }
      } else {
        $new_file = $data2['foto_pengurus'];
      }
      $data = array(
        'nama' => $this->input->post('nama'),
        'semester' => $this->input->post('semester'),
        'periode1' => $this->input->post('periode1'),
        'periode2' => $this->input->post('periode2'),
        'foto_pengurus' => $new_file
      );
      $where = ['npm' => $npm];
      $this->db->update('pengurus', $data, $where);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di edit!</div>');
    }
    redirect('pengurus');
  }
  public function delPengurus($id_peng)
  {
    echo $id_peng;
  }
  public function Periode(){
    $periode = $this->input->post('tap_periode');
    if($periode){
      $data2 = array(
        'status'=> 0 
      );
      $this->db->update('periode',$data2);

      $data = array(
        'tap_periode' => $periode,
        'status' => '1'
      );
      $this->db->insert('periode',$data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">periode baru telah di tetapkan!</div>');
    }else{
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">anda belum menetapkan periode!</div>');
    }
    redirect('Pengurus');
  }
}
