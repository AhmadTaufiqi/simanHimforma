<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pertanggungjawaban extends CI_Controller
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
    

    $data["pertanggung_jwb"] = $this->Kegiatan_model->Pertanggungjawaban();
    $data['prog_terlaksana'] = $this->db->get_where('pelaksanaan')->result_array();
    $data['title'] = 'pertanggungjawaban';

    $this->load->view('Templates/header', $data);
    $this->load->view('Templates/sidebar', $data);
    $this->load->view('Templates/topbar', $data);
    $this->load->view('Kegiatan/pertanggungjwb', $data);
    $this->load->view('Templates/footer');
  }


  public function showDataComboLPJ()
  {
    $id_keg = $this->input->post('id_keg');
    $data = $this->db->get_where('pelaksanaan', ['id_pelaksanaan' => $id_keg])->row_array();
    echo json_encode($data);
  }

  public function showEditLPJ()
  {
    $id_lpj = $this->input->post('id_lpj');
    $data = $this->db->get_where('pertanggungjwb', ['id_lpj' => $id_lpj])->row_array();
    echo json_encode($data);
  }

  public function editPertanggungjwb()
  {
    $rowid = $this->input->post('ROW_ID');
    $data2['file'] = $this->db->get_where('pertanggungjwb', ['id_lpj' => $rowid])->row_array();
    // $data2['file'] = "mantappp";
    $file = $_FILES['file']['name'];
    if ($file) {
      $new_file = $file;
      $config['allowed_types'] = 'pdf|docx|dox|xlsx|xls';
      $config['max_size'] = '20480';
      $config['upload_path'] = './assets/files/LPJ/';

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('file')) {

        $old_file = $data2['file']['file_lpj'];
        if ($old_file != 'proposal.pdf') {
          unlink(FCPATH . 'assets/files/LPJ/' . $old_file);
        }

        $new_file = $this->upload->data('file_name');
        // $this->db->set('file_proposal', $new_file);
      } else {
        echo  $this->upload->display_errors();
      }
    } else {
      $new_file = $data2['file']['file_lpj'];
      //    // $new_file = "mantap.pdf";
    }

    $data = array(
      // 'id' => $rowid,
      'nama_kegiatan' => $this->input->post('NAMA_KEGIATAN'),
      'link_dokumentasi' => $this->input->post('LINK_DOKUMENTASI'),
      'catatan' => $this->input->post('catatan'),
      'file_lpj' => $new_file
      // "mana",
    );
    // var_dump($data);
    $this->db->where('id_lpj', $rowid);
    $this->db->update('pertanggungjwb', $data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di edit!</div>');
    redirect('Pertanggungjawaban');
  }
  public function addPertanggungjawaban()
  {
    $id_pelaksanaan = $this->input->post('option_kegiatan');
    $id_perencanaan = $this->input->post('id_perencanaan');
    $nama_kegiatan = $this->input->post('nama_kegiatan');
    $link_doc = $this->input->post('link_doc');
    // $new_file = "proposal.pdf";
    $file = $_FILES['file']['name'];
    if (strlen($id_pelaksanaan) == 0 or strlen($file) == 0) {
      $data = $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">file dan program harus di isi!</div>');
    } else {
      if (strlen($link_doc) == 0) {
        $link_doc = "-";
      }
      $numrows = $this->db->get_where('pertanggungjwb', ['id_pelaksanaan' => $id_pelaksanaan])->result_array();
      if (count($numrows) == 0) {
        $config['allowed_types'] = 'pdf|docx|dox|xlsx|xls';
        $config['max_size'] = '20480';
        $config['upload_path'] = './assets/files/LPJ/';

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
          $new_file = $this->upload->data('file_name');

          $data = array(
            "nama_kegiatan" => $nama_kegiatan,
            "id_perencanaan" => $id_perencanaan,
            "id_pelaksanaan" => $id_pelaksanaan,
            "link_dokumentasi" => $link_doc,
            "catatan" => $this->input->post('catatan'),
            "file_lpj" => $new_file
          );
          $this->db->insert('pertanggungjwb', $data);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di input!</div>');
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">file tidak sesuai syarat!</div>');
          // $tes=$this->upload->display_errors();
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">data sudah tersedia!</div>');
      }
    }

    // echo json_encode($data);
    redirect('Pertanggungjawaban');
  }
  public function deletePertanggungjwb($id_del)
  {
    $current_file = $this->db->get_where('pertanggungjwb', ['id_lpj' => $id_del])->row_array()['file_lpj'];
    // echo $current_file;
    $this->db->delete('pertanggungjwb', ['id_lpj' => $id_del]);
    // if(mysqli_)
    unlink(FCPATH . 'assets/files/LPJ/' . $current_file);

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil hapus!</div>');
    redirect('Pertanggungjawaban');
  }
}
