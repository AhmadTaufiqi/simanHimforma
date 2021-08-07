<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pengawas extends CI_Controller
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
        $data['title'] = 'Dashboard';

        $this->load->view('Templates/header', $data);
        $this->load->view('Templates/sidebar', $data);
        $this->load->view('Templates/topbar', $data);
        $this->load->view('Kepengurusan/dashboard', $data);
        $this->load->view('Templates/footer');
    }

    public function prestasi()
    {
        $data['btn_add'] = 'hidden="true"';
        $data['action'] = ' ';
        $data['btn_edit'] = 'hidden="true"';
        $data['btn_delete'] = 'hidden="true"';
        $data['user'] = $this->user_model->dataUser();
        $data['title'] = 'prestasi';
        $data['prestasi'] = $this->db->get('prestasi')->result_array();
        // var_dump($data);
        $this->load->view('Templates/header', $data);
        $this->load->view('Templates/sidebar', $data);
        $this->load->view('Templates/topbar', $data);
        $this->load->view('User/prestasi', $data);
        $this->load->view('Templates/footer');
    }
    public function lapKegiatan(){

        $data['user'] = $this->user_model->dataUser();
        $data['title'] = 'laporan kegiatan';
        $data['lapProgram'] = $this->db->get('program')->result_array();
        $this->load->view('Templates/header', $data);
        $this->load->view('Templates/sidebar', $data);
        $this->load->view('Templates/topbar', $data);
        $this->load->view('Kegiatan/lapKegiatan', $data);
        $this->load->view('Templates/footer');
    }
    public function konfirmPelaksanaan(){
        $id_pel = $_GET['id_pel'];
        $konfirm = $_GET['konfirm'];
        echo $id_pel."dan ".$konfirm;
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">di konfirmasi!</div>');
        redirect('Pengawas/lapKegiatan');
        
    }
}
