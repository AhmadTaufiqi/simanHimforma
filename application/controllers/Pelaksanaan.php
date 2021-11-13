<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pelaksanaan extends CI_Controller
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
    // $id = "1";
    $data['user'] = $this->user_model->dataUser();
    
    $data["pelaksanaan"] = $this->Kegiatan_model->Pelaksanaan();
    $data['program'] = $this->db->get_where('perencanaan');
    $data['title'] = 'pelaksanaan';
    $this->load->view('Templates/header', $data);
    $this->load->view('Templates/sidebar', $data);
    $this->load->view('Templates/topbar', $data);
    $this->load->view('Kegiatan/pelaksanaan', $data);
    $this->load->view('Templates/footer');
  }

  public function showDataComboPel()
  {
    $id_keg = $this->input->post('id_keg');
    $data = $this->db->get_where('perencanaan', ['id_perencanaan' => $id_keg])->row_array();
    echo json_encode($data);
  }

  public function addPelaksanaan()
  {
    $id_kegiatan = $this->input->post('option_kegiatan');
    $tgl_pelaksanaan = $this->input->post('tgl_pelaksanaan');
    $nama_kegiatan = $this->input->post('nama_kegiatan');
    $file_pelaksanaan = $_FILES['file']['name'];

    $pelaksanaan = $this->db->get('pelaksanaan')->row_array();

    $this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required|min_length[2]|max_length[50]');
    $this->form_validation->set_rules('option_kegiatan', 'Kegiatan', 'required');
    $this->form_validation->set_rules('tgl_pelaksanaan', 'tanggal pelaksanaan', 'required');

    if ($this->form_validation->run() == false) {
      // $tes = "FILE DAN PROGRAM HARUS DI ISI";
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="mb-2">isi data dengan benar!</p> <span class="small">' . validation_errors() . '</span></div>');
    } else {
      if (strlen($file_pelaksanaan) == 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">file dan program harus di isi!</div>');
      } else {


        $numrows = $this->db->get_where('pelaksanaan', ['id_perencanaan' => $id_kegiatan])->result_array();
        if (count($numrows) == 0) {
          $config['allowed_types'] = 'pdf|docx|dox|xlsx|xls';
          $config['max_size'] = '20480';
          $config['upload_path'] = './assets/files/proposal_terlaksana/';

          $this->load->library('upload', $config);
          if ($this->upload->do_upload('file')) {
            $new_file = $this->upload->data('file_name');

            $data = array(
              'id_perencanaan' => $id_kegiatan,
              'nama_kegiatan' => $nama_kegiatan,
              'tgl_pelaksanaan' => $tgl_pelaksanaan,
              'file_proposal' => $new_file
            );
            $this->db->insert('pelaksanaan', $data);
            $pelaksanaan = $this->db->get_where('pelaksanaan', ['nama_kegiatan' => $nama_kegiatan])->row_array();

            $data2 = array(
              'id_pelaksanaan' => $pelaksanaan['id_pelaksanaan'],
              'dana_DKM' => $this->input->post('dana_dkm'),
              'dana_LKM' => $this->input->post('dana_lkm'),
              'dana_sponsor' => $this->input->post('dana_sponsor'),
              'dana_lain' => $this->input->post('dana_lain')
            );
            $this->db->insert('sumber_dana_kegiatan', $data2);

            // $tes  = $data;
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di input!</div>');
          } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">file tidak sesuai syarat!</div>');
            // $tes=$this->upload->display_errors();
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">data sudah tersedia!</div>');
        }
      }
    }
    redirect('Pelaksanaan');
    // echo json_encode($tes);

  }
  public function showDataEditPelaksanaan()
  {
    $param1 = $this->input->post('id_program');
    $pelaksanaan = $this->db->get_where('pelaksanaan', ['id_pelaksanaan' => $param1])->row_array();

    if ($sumber_dana = $this->db->get_where('sumber_dana_kegiatan', ['id_pelaksanaan' => $param1])->row_array()) {
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
      'id_pelaksanaan' => $pelaksanaan['id_pelaksanaan'],
      'dana_DKM' => $dana['dana_DKM'],
      'dana_LKM' => $dana['dana_LKM'],
      'dana_sponsor' => $dana['dana_sponsor'],
      'dana_lain' => $dana['dana_lain'],
      'nama_kegiatan' => $pelaksanaan['nama_kegiatan'],
      'file_proposal' => $pelaksanaan['file_proposal'],
      'tgl_pelaksanaan' => $pelaksanaan['tgl_pelaksanaan']
    );
    echo json_encode($data);
    // $this->db->get_where();
  }
  public function editPelaksanaan()
  {
    $rowid = $this->input->post('ROW_ID');

    $data2 = $this->db->get_where('pelaksanaan', ['id_pelaksanaan' => $rowid])->row_array();
    $file = $_FILES['file']['name'];
    if ($file) {
      $config['allowed_types'] = 'pdf|docx|dox|xlsx|xls';
      $config['max_size'] = '20480';
      $config['upload_path'] = './assets/files/proposal_terlaksana/';

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('file')) {

        $old_file = $data2['file_proposal'];
        if ($old_file != 'proposal.pdf') {
          unlink(FCPATH . 'assets/files/proposal_terlaksana/' . $old_file);
        }

        $new_file = $this->upload->data('file_name');
        // $this->db->set('file_proposal', $new_file);
      } else {
        echo  $this->upload->display_errors();
      }
    } else {
      $new_file = $data2['file_proposal'];
    }

    $data3 = array(
      'dana_DKM' => $this->input->post('dana_DKM'),
      'dana_LKM' => $this->input->post('dana_LKM'),
      'dana_sponsor' => $this->input->post('dana_sponsor'),
      'dana_lain' => $this->input->post('dana_lain')
    );
    $where3 = ['id_pelaksanaan' => $rowid];
    $this->db->update('sumber_dana_kegiatan', $data3, $where3);

    $data = array(
      'nama_kegiatan' => $this->input->post('nama'),
      'file_proposal' => $new_file
    );
    $where = ['id_pelaksanaan' => $rowid];
    $this->db->update('pelaksanaan', $data, $where);

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di edit!</div>');
    redirect('Pelaksanaan');
  }

  public function deletePelaksanaan($id_del)
  {
    $pertanggungjwb = $this->db->get_where('pertanggungjwb', ['id_pelaksanaan' => $id_del])->result();
    $file_proposal = $this->db->get_where('pelaksanaan', ['id_pelaksanaan' => $id_del])->row_array()['file_proposal'];

    $this->db->delete('sumber_dana_kegiatan', ['id_pelaksanaan' => $id_del]);
    $this->db->delete('pelaksanaan', ['id_pelaksanaan' => $id_del]);
    unlink(FCPATH . 'assets/files/proposal_terlaksana/' . $file_proposal);
    if ($pertanggungjwb) {
      $file_lpj = $this->db->get_where('pertanggungjwb', ['id_pelaksanaan' => $id_del])->row_array()['lpj'];
      $this->db->delete('pertanggungjwb', ['id_pelaksanaan' => $id_del]);
      unlink(FCPATH . 'assets/files/LPJ/' . $file_lpj);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pelaksanaan dan pertanggungjawaban berhasil di hapus!</div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data pelaksanaan berhasil di hapus!</div>');
    }
    redirect('Pelaksanaan');
  }
}
