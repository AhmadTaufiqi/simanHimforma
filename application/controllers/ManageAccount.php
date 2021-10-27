<?php
defined('BASEPATH') or exit('No direct script access allowed');


class ManageAccount extends CI_Controller
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
    $data['title'] = 'Manage Account';
    $data['user_account'] = $this->db->get('user')->result_array();
    $this->load->view('Templates/header', $data);
    $this->load->view('Templates/sidebar', $data);
    $this->load->view('Templates/topbar', $data);
    $this->load->view('Pengawas/manage_akun', $data);
    $this->load->view('Templates/footer');
  }


  public function showEditAccount()
  {
    $email = $this->input->post('email');
    $user = $this->db->get_where('user', ['email' => $email])->row_array();
    echo json_encode($user);
  }

  public function AccountActivation(){
    $tes["status"] = "success";
    $email = $this->input->post('email');
    $sess_email = $this->session->userdata('email');
    if($sess_email == $email){
      $tes["status"] = "non";
    }else{
      $active = $this->db->get_where('user',['email'=>$email])->row_array()['is_active'];
      if($active >0){
        $is_active = 0;
        // redirect('ManageAccount');
      }else{
        $is_active = 1;
        // echo json_encode($email);
        // redirect('ManageAccount');
        
      }
      $data = [
        'is_active' => $is_active
      ];
      $where = ['email'=>$email];
      $this->db->update('user',$data,$where);
    }
    echo json_encode($tes);
  }
  public function EditAccount()
  {
    
    $sess_email = $this->session->userdata('email');
    $this->form_validation->set_rules('nama_user', 'nama pengguna', 'required');
    $this->form_validation->set_rules('email_user', 'email pengguna', 'trim|required|valid_email');

    $email_old = $this->input->post('email_user_old');
    $email = $this->input->post('email_user');
    $nama = $this->input->post('nama_user');
    $hak_akses = $this->input->post('hak_akses');
    // $account = $this->db->get_where('user',['email'=> $sess_email])->row_array();

      
    $account = $this->db->get_where('user',['email'=> $email])->row_array();
    if($account AND ($email != $email_old)){
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">email sudah tersedia!</div>');
    }else{

      if ($this->form_validation->run() == false) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="mb-2">isi data dengan benar!</p> <span class="small">' . validation_errors() . '</span></div>');
      }else{     
        if($sess_email == $email_old){

          $data = [
            'email' => $email,
            'name' => $nama
            // 'role_id' => $hak_akses
          ];
          // $tes = "akun yang di pakai";
          $where = ['email' => $email_old];
          $this->db->update('user',$data,$where);
          $this->session->unset_userdata('email');
          $this->session->unset_userdata('role_id');
          $this->session->set_flashdata('message', '<div class="alert alert-success" role"alert">silahkan login ulang dengan email '.$email.'</div>');
          redirect('auth');
        }else{
          // $tes = "akun yang tidak di pakai";
          
          $data = [
            'email' => $email,
            'name' => $nama,
            'role_id' => $hak_akses
          ];
          $where = ['email' => $email_old];
          $this->db->update('user',$data,$where);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">akun berhasil di Edit!"</div>');
        }
            // echo json_encode()
      }
      
    }
    redirect('ManageAccount');
  }

  public function AddAccount()
  {
    $this->form_validation->set_rules('nama_user', 'nama pengguna', 'required');
    $this->form_validation->set_rules('email_user', 'email pengguna', 'trim|required|valid_email');
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
      'matches' => 'password dont match!',
      'min_length' => 'password too short!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    $email = $this->input->post('email_user');
    $nama = $this->input->post('nama_user');
    $hak_akses = $this->input->post('hak_akses');
    $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
    $account = $this->db->get_where('user',['email'=> $email])->row_array();
      if($account){
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">email sudah tersedia!</div>');
      }else{

      if ($this->form_validation->run() == false) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><p class="mb-2">isi data dengan benar!</p> <span class="small">' . validation_errors() . '</span></div>');
      }else{     
            $data = [
              'email' => $email,
              'name' => $nama,
              'role_id' => $hak_akses,
              'password' => $password,
              'date_created' => time(),
              'image' => "default.png"
            ];
            // echo json_encode()
            $this->db->insert('user',$data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">akun berhasil di tambahkan!</div>');
      }
      
    }
    redirect('ManageAccount');
  }

  public function DeleteAccount(){
    $tes['status'] = "success";
    $email = $this->input->post('email');
    
    $sess_email = $this->session->userdata('email');
    if($email == $sess_email){
      $tes['status'] = "noo";
    }else{
      $this->db->delete('user',['email' => $email]);
      // redirect('ManageAccount');
      // $tes['status'] = "delete";
    }
    echo json_encode($tes);
  }
}
