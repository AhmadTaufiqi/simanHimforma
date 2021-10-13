<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('arsip_model');
        $this->load->model('user_model');
        // is_logged_in();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }
    public function profile()
    {
        $data['user'] = $this->user_model->dataUser();
        $data['title'] = 'Profile';

        $this->load->view('Templates/header', $data);
        $this->load->view('Templates/sidebar', $data);
        $this->load->view('Templates/topbar', $data);
        $this->load->view('User/profile', $data);
        $this->load->view('Templates/footer');
    }

    public function edit_profile()
    {
        $data['user'] = $this->user_model->dataUser();
        $data['title'] = 'Edit Profile';

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('Templates/header', $data);
            $this->load->view('Templates/sidebar', $data);
            $this->load->view('Templates/topbar', $data);
            $this->load->view('User/edit_profile', $data);
            $this->load->view('Templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek jika ada gambar di upload
            $upload_image = $_FILES['image']['name']; //melihat 'image' (tipe filenya); dan 'name' (properti yang akan di ambil)
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {


                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">your profile has been updated!</div>');
            redirect('User/profile');
        }
    }
}
