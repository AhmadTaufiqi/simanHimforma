<?php
defined('BASEPATH') or exit('No direct script access allowed');


class crudKegiatan extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      // $this->load->model('arsip_model');
      $this->load->model('user_model');
      if (!$this->session->userdata('email')) {
         redirect('Auth');
      }
   }


   public function showDataTglComboKeg()
   {
      $id_keg = $this->input->post('id_keg');
      $data = $this->db->get_where('program', ['id' => $id_keg])->row_array();
      echo json_encode($data);
   }
   public function addPelaksanaan()
   {
      $id_kegiatan = $this->input->post('option_kegiatan');
      $tgl_pelaksanaan = $this->input->post('tgl_pelaksanaan');
      $nama_kegiatan = $this->input->post('nama_kegiatan');
      $file_pelaksanaan = $_FILES['file']['name'];
      if (strlen($id_kegiatan) == 0 || strlen($tgl_pelaksanaan) == 0 || strlen($file_pelaksanaan) == 0) {
         // $tes = "FILE DAN PROGRAM HARUS DI ISI";
         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">file dan program harus di isi!</div>');
      } else {

         $numrows = $this->db->get_where('pelaksanaan', ['id_prog' => $id_kegiatan])->result_array();

         if (count($numrows) == 0) {
            $config['allowed_types'] = 'pdf|docx|dox|xlsx|xls';
            $config['max_size'] = '20480';
            $config['upload_path'] = './assets/files/proposal_terlaksana/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
               $new_file = $this->upload->data('file_name');


               $data = array(
                  'id_prog' => $id_kegiatan,
                  'nama_kegiatan' => $nama_kegiatan,
                  'tgl_pelaksanaan' => $tgl_pelaksanaan,
                  'file_proposal' => $new_file
               );

               // $tes  = $data;
               $this->db->insert('pelaksanaan', $data);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di input!</div>');
            } else {
               $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">file tidak sesuai syarat!</div>');
               // $tes=$this->upload->display_errors();
            }
         } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">data sudah tersedia!</div>');
         }
      }
      redirect('Kegiatan/pelaksanaan');
      // echo json_encode($tes);

   }
   public function showDataEditPelaksanaan()
   {
      $param1 = $this->input->post('id_program');
      $data = $this->db->get_where('pelaksanaan', ['id' => $param1])->row_array();
      echo json_encode($data);
      // $this->db->get_where();
   }
   public function editPelaksanaan()
   {
      $rowid = $this->input->post('ROW_ID');
      $data2['file'] = $this->db->get_where('pelaksanaan', ['id' => $rowid])->row_array();
      // $data2['file'] = "mantappp";
      $file = $_FILES['file']['name'];
      if ($file) {
         $config['allowed_types'] = 'pdf|docx|dox|xlsx|xls';
         $config['max_size'] = '20480';
         $config['upload_path'] = './assets/files/proposal_terlaksana/';

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('file')) {

            $old_file = $data2['file']['file_proposal'];
            if ($old_file != 'proposal.pdf') {
               unlink(FCPATH . 'assets/files/proposal_terlaksana/' . $old_file);
            }

            $new_file = $this->upload->data('file_name');
            // $this->db->set('file_proposal', $new_file);
         } else {
            echo  $this->upload->display_errors();
         }
      } else {
         $new_file = $data2['file']['file_proposal'];
         // $new_file = "mantap.pdf";
      }

      $data = array(
         // 'id' => $rowid,
         'nama_kegiatan' => $this->input->post('nama'),
         // "mana",
         'file_proposal' => $new_file
         // "mana",
      );
      // var_dump($data);
      $this->db->where('id', $rowid);
      $this->db->update('pelaksanaan', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di edit!</div>');
      redirect('Kegiatan/pelaksanaan');
   }

   public function deletePelaksanaan($id_del)
   {
      $pertanggungjwb = $this->db->get_where('pertanggungjwb', ['id_pelaksanaan' => $id_del])->result();
      $file_proposal = $this->db->get_where('pelaksanaan', ['id' => $id_del])->row_array()['file_proposal'];
      $this->db->delete('pelaksanaan', ['id' => $id_del]);
      unlink(FCPATH . 'assets/files/proposal_terlaksana/' . $file_proposal);
      if ($pertanggungjwb) {
         $file_lpj = $this->db->get_where('pertanggungjwb', ['id_pelaksanaan' => $id_del])->row_array()['lpj'];
         $this->db->delete('pertanggungjwb', ['id_pelaksanaan' => $id_del]);
         unlink(FCPATH . 'assets/files/LPJ/' . $file_lpj);
         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pelaksanaan dan pertanggungjawaban berhasil di hapus!</div>');
      } else {
         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data pelaksanaan berhasil di hapus!</div>');
      }
      redirect('Kegiatan/pelaksanaan');
   }


   public function addProgram()
   {
      $this->form_validation->set_rules('nama', '"nama program"', 'required');
      $this->form_validation->set_rules('tujuan', '"tujuan"', 'required');
      $this->form_validation->set_rules('sasaran', '"sasaran"', 'required');
      $this->form_validation->set_rules('deskripsi', '"deskripsi"', 'required');
      $this->form_validation->set_rules('bulan', '"bulan"', 'required');

      $bulan = $this->input->post('bulan');

      $yearnow = date('Y');
      if ($bulan == "januari") {
         $bulan = "$yearnow-01-15";
      } elseif ($bulan == "februari") {
         $bulan = "$yearnow-02-15";
      } elseif ($bulan == "maret") {
         $bulan = "$yearnow-03-15";
      } elseif ($bulan == "april") {
         $bulan = "$yearnow-04-15";
      } elseif ($bulan == "mei") {
         $bulan = "$yearnow-05-15";
      } elseif ($bulan == "juni") {
         $bulan = "$yearnow-06-15";
      } elseif ($bulan == "juli") {
         $bulan = "$yearnow-07-15";
      } elseif ($bulan == "agustus") {
         $bulan = "$yearnow-08-15";
      } elseif ($bulan == "september") {
         $bulan = "$yearnow-09-15";
      } elseif ($bulan == "oktober") {
         $bulan = "$yearnow-10-15";
      } elseif ($bulan == "november") {
         $bulan = "$yearnow-11-15";
      } elseif ($bulan == "desember") {
         $bulan = "$yearnow-11-15";
      }

      if ($this->form_validation->run() == false) {
         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">isi data dengan benar!</div>');
      } else {
         $data = array(
            'nama_prog' => $this->input->post('nama'),
            'deskripsi' => $this->input->post('deskripsi'),
            'tujuan' => $this->input->post('tujuan'),
            'sasaran' => $this->input->post('sasaran'),
            'id_agenda' => $bulan
         );
         // var_dump($data);   
         $this->db->insert('program', $data);
         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil ditambahkan!</div>');
      }
      redirect('Kegiatan/perencanaan');
   }
   public function deletePerencanaan($id_del)
   {
      $pertanggungjwb = $this->db->get_where('pertanggungjwb', ['id_prog' => $id_del])->result();
      $pelaksanaan = $this->db->get_where('pelaksanaan', ['id_prog' => $id_del])->result();
      $this->db->delete('program', ['id' => $id_del]);
      // delete perencanaan
      if ($pelaksanaan) {
         // delete pelaksanaan
         $file_proposal = $this->db->get_where('pelaksanaan', ['id_prog' => $id_del])->row_array()['file_proposal'];
         $this->db->delete('pelaksanaan', ['id_prog' => $id_del]);
         unlink(FCPATH . 'assets/files/proposal_terlaksana/' . $file_proposal);
         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">perencanaan dan pelaksanaan berhasil di hapus!</div>');

         if ($pertanggungjwb) {

            $file_lpj = $this->db->get_where('pertanggungjwb', ['id_prog' => $id_del])->row_array()['lpj'];
            $this->db->delete('pertanggungjwb', ['id_prog' => $id_del]);
            unlink(FCPATH . 'assets/files/LPJ/' . $file_lpj);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">perencanaan pelaksanaan dan pertanggungjawaban berhasil di hapus!</div>');
            // delete pertanggungjawaban
         }
      } else {
         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">perencanaan berhasil di hapus!</div>');
      }
      redirect('Kegiatan/perencanaan');
   }
   public function showDataComboLPJ()
   {
      $id_keg = $this->input->post('id_keg');
      $data = $this->db->get_where('pelaksanaan', ['id' => $id_keg])->row_array();
      echo json_encode($data);
   }
   public function showEditLPJ()
   {
      $id_lpj = $this->input->post('id_lpj');
      $data = $this->db->get_where('pertanggungjwb', ['id' => $id_lpj])->row_array();
      echo json_encode($data);
   }
   public function editPertanggungjwb()
   {
      $rowid = $this->input->post('ROW_ID');
      $data2['file'] = $this->db->get_where('pertanggungjwb', ['id' => $rowid])->row_array();
      // $data2['file'] = "mantappp";
      $file = $_FILES['file']['name'];
      if ($file) {
         $new_file = $file;
         $config['allowed_types'] = 'pdf|docx|dox|xlsx|xls';
         $config['max_size'] = '20480';
         $config['upload_path'] = './assets/files/LPJ/';

         $this->load->library('upload', $config);

         if ($this->upload->do_upload('file')) {

            $old_file = $data2['file']['lpj'];
            if ($old_file != 'proposal.pdf') {
               unlink(FCPATH . 'assets/files/LPJ/' . $old_file);
            }

            $new_file = $this->upload->data('file_name');
            // $this->db->set('file_proposal', $new_file);
         } else {
            echo  $this->upload->display_errors();
         }
      } else {
         $new_file = $data2['file']['lpj'];
         //    // $new_file = "mantap.pdf";
      }

      $data = array(
         'id' => $rowid,
         'nama_kegiatan' => $this->input->post('NAMA_KEGIATAN'),
         'link_dokumentasi' => $this->input->post('LINK_DOKUMENTASI'),
         'lpj' => $new_file
         // "mana",
      );
      // var_dump($data);
      $this->db->where('id', $rowid);
      $this->db->update('pertanggungjwb', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di edit!</div>');
      redirect('Kegiatan/pertanggungjwb');
   }
   public function addPertanggungjawaban()
   {
      $id_pelaksanaan = $this->input->post('option_kegiatan');
      $id_prog = $this->input->post('id_prog');
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
                  "id_prog" => $id_prog,
                  "id_pelaksanaan" => $id_pelaksanaan,
                  "link_dokumentasi" => $link_doc,
                  "hasil" => "belum dikonfirmasi",
                  "lpj" => $new_file
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
      redirect('Kegiatan/pertanggungjwb');
   }
   public function deletePertanggungjwb($id_del)
   {
      $current_file = $this->db->get_where('pertanggungjwb', ['id' => $id_del])->row_array()['lpj'];
      // echo $current_file;
      $this->db->delete('pertanggungjwb', ['id' => $id_del]);
      // if(mysqli_)
      unlink(FCPATH . 'assets/files/LPJ/' . $current_file);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil hapus!</div>');
      redirect('Kegiatan/pertanggungjwb');
   }
}
