<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Prestasi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // $this->load->model('arsip_model');
    $this->load->model('user_model');
    is_logged_in();
  }
  public function index()
  {
    $data['user'] = $this->user_model->dataUser();
    $data['title'] = 'prestasi';
    $data['prestasi'] = $this->db->get('prestasi')->result_array();
    $this->load->view('Templates/header', $data);
    $this->load->view('Templates/sidebar', $data);
    $this->load->view('Templates/topbar', $data);
    $this->load->view('Kepengurusan/prestasi', $data);
    $this->load->view('Templates/footer');
  }

  public function addPrestasi()
  {
    // $foto_prestasi = $_FILES['foto_prestasi']['name'];
    $sertif_prestasi = $_FILES['sertif_prestasi']['name'];
    $nama_prestasi = $this->input->post('nama_prestasi');
    $nama_peraih = $this->input->post('nama_peraih');
    $npm = $this->input->post('npm');
    $tanggal_prestasi = $this->input->post('tanggal_prestasi');
    $keterangan = $this->input->post('keterangan');
    if (strlen($nama_prestasi) == 0 || strlen($nama_peraih) == 0 || strlen($npm) == 0 ||  strlen($tanggal_prestasi) == 0 || strlen($keterangan) == 0) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">detail prestasi harus di isi!</div>');
    } else {

      if (strlen($sertif_prestasi) == 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">bukti prestasi harus di isi!</div>');
      } else {          
        $config['allowed_types'] = 'pdf';
        $config['max_size']     = '9000';
        $config['upload_path'] = './assets/files/sertifikat_prestasi/';
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('sertif_prestasi')) {
          $sertif_prestasi = $this->upload->data('file_name');
          }else{
            
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">file tidak sesuai !</div>');
            redirect('Prestasi');
          }
     
        
        $data = [
          'bukti_prestasi' => $sertif_prestasi,
          // 'foto_prestasi' => $foto_prestasi,
          'nama_prestasi' => $nama_prestasi,
          'nama_peraih' => $nama_peraih,
          'npm' =>  $npm,
          'tanggal_prestasi' => $tanggal_prestasi,
          'keterangan' => $keterangan
        ];
  
        // $tes  = $data;
        $this->db->insert('prestasi', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di input!</div>');
      }
    }
    redirect('Prestasi');
  }

  public function showEditPrestasi()
  {
    $id_prest = $this->input->post('id_prest');
    $tb_prestasi = $this->db->get_where('prestasi', ['id_prestasi' => $id_prest])->row_array();
    echo json_encode($tb_prestasi);
  }

  public function editPrestasi()
  {
    $rowid = $this->input->post('id_prestasi');

    $this->form_validation->set_rules('nama_prestasi', 'Nama Prestasi', 'required|max_length[100]');
    $this->form_validation->set_rules('nama_peraih', 'Nama Peraih', 'required|max_length[60]');
    $this->form_validation->set_rules('tanggal_prestasi', 'Tanggal Presasi', 'required');
    $this->form_validation->set_rules('npm', 'NPM', 'required|min_length[8]|max_length[8]');
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|max_length[100]');
    $this->form_validation->set_rules('foto_prestasi', 'foto prestasi', 'max_length[50]');

    if ($this->form_validation->run() == false) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="mb-2">isi data dengan benar!</p> <span class="small">' . validation_errors() . '</span></div>');
    } else {

      $data2 = $this->db->get_where('prestasi', ['id_prestasi' => $rowid])->row_array();
      $file = $_FILES['sertif_prestasi'];
      // if($file)
      if ($file['name']) {
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '9000';
        $config['upload_path'] = './assets/files/sertifikat_prestasi/';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('sertif_prestasi')) {

          $old_file = $data2['bukti_prestasi'];
          $new_file = $this->upload->data('file_name');
          if ($old_file != $new_file) {
            unlink(FCPATH . './assets/files/sertifikat_prestasi/' . $old_file);
          }
          // $this->db->set('file_proposal', $new_file);
        } else {
          
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">file tidak sesuai !</div>');
          redirect('Prestasi');
        }
      } else {
        $new_file = $data2['bukti_prestasi'];
      }
      // echo($new_file);

      $data = array(
        'nama_prestasi' => $this->input->post('nama_prestasi'),
        'nama_peraih' => $this->input->post('nama_peraih'),
        'npm' => $this->input->post('npm'),
        'tanggal_prestasi' => $this->input->post('tanggal_prestasi'),
        'keterangan' => $this->input->post('keterangan'),
        'bukti_prestasi' => $new_file
      );
      // echo json_encode($data);
      $where = ['id_prestasi' => $rowid];
      $this->db->update('prestasi', $data, $where);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil di edit!</div>');
    }
    redirect('Prestasi');
  }
    

  public function deletePrestasi($id_del)
  {
    echo $id_del;

    $current_foto = $this->db->get_where('prestasi', ['id_prestasi' => $id_del])->row_array()['foto_prestasi'];
    // echo $current_foto;
    $this->db->delete('prestasi', ['id_prestasi' => $id_del]);
    // if(mysqli_)
    unlink(FCPATH . 'assets/img/foto_prestasi/' . $current_foto);

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data berhasil hapus!</div>');
    redirect('Prestasi');
  }
}
