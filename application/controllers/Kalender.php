<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Kalender extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('calendar_model');
        is_logged_in();
    }
    public function index()
    {
        $data['user'] = $this->user_model->dataUser();
        $data['title'] = 'Kalender Kegiatan';
        $data['tb_agenda'] = $this->db->query('SELECT * FROM perencanaan INNER JOIN pelaksanaan ON perencanaan.id_perencanaan = pelaksanaan.id_perencanaan')->result_array();
        $this->load->view('Templates/header', $data);
        $this->load->view('Templates/sidebar', $data);
        $this->load->view('Templates/topbar', $data);
        // $this->load->view('User/agenda', $data);
        $this->load->view('User/base_agenda', $data);
        $this->load->view('Templates/footer');
    }
    public function calendar()
    {
        $data['user'] = $this->user_model->dataUser();
        $data['title'] = 'Agenda';
        $this->load->view('Templates/header', $data);
        $this->load->view('User/agenda', $data);
        $this->load->view('Templates/footer_iframe');
    }
    public function tb_calendar()
    {
        $data['user'] = $this->user_model->dataUser();
        $data['title'] = 'Agenda';
        $this->load->view('Templates/header', $data);
        $this->load->view('User/tbl_agenda', $data);
        $this->load->view('Templates/footer_iframe');
    }

    function load()
    {
        $event_data = $this->calendar_model->fetch_event();

        foreach ($event_data->result_array() as $row) {
            $data[] = array(
                'id' => $row['id_pelaksanaan'],
                'title' => $row['nama_kegiatan'],
                'start' => $row['tgl_pelaksanaan'],
                'end' => date('Y-m-d', strtotime('+1 days', strtotime($row['tgl_pelaksanaan'])))
            );
        }

        echo json_encode($data);
    }

    public function tambahAgenda()
    {
        $data['user'] = $this->user_model->dataUser();
        $data = [
            'nama_agenda' => $this->input->post('agenda'),
            'keterangan' => $this->input->post('keterangan'),
            'start' => $this->input->post('start'),
            'end' => $this->input->post('end')
        ];
        $this->db->insert('kalender', $data);
        redirect('calendar');
    }
}
