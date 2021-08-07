<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Kepengurusan extends CI_Controller
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

    public function pengurus()
    {
        $data['user'] = $this->user_model->dataUser();
        $data['pengurus'] = $this->db->get_where('pengurus')->result_array();
        $data['title'] = 'Pengurus';

        $this->load->view('Templates/header', $data);
        $this->load->view('Templates/sidebar', $data);
        $this->load->view('Templates/topbar', $data);
        $this->load->view('Kepengurusan/pengurus', $data);
        $this->load->view('Templates/footer');
    }

    public function keuangan()
    {
        $data['user'] = $this->user_model->dataUser();
        $yearnow = date('Y');
        $where = '(periode1=' . $yearnow . ' or periode2 = ' . $yearnow . ')';
        $data['pengurus'] = $this->db->get_where('pengurus', $where)->result_array();
        $data['title'] = 'Keuangan';

        $this->load->view('Templates/header', $data);
        $this->load->view('Templates/sidebar', $data);
        $this->load->view('Templates/topbar', $data);
        $this->load->view('Kepengurusan/keuangan', $data);
        $this->load->view('Templates/footer');
    }
    public function addKeuangan()
    {
        $data = [
            'id_pengurus' => $this->input->post('id_pengurus'),
            'tanggal' => $this->input->post('tanggal'),
            'nominal' => $this->input->post('nominal')
        ];
        // var_dump($data);
        $this->db->insert('kas_pengurus', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data kas telah ditambahkan!</div>');
        redirect('Kepengurusan/keuangan');
    }
    public function delKeuangan($id)
    {
        $this->db->delete('kas_pengurus', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">data kas berhasil dihapus!</div>');
        redirect('Kepengurusan/keuangan');
    }

    public function inventaris()
    {
        $data['user'] = $this->user_model->dataUser();
        $data['title'] = 'inventaris';

        $this->form_validation->set_rules('nama_barang', '"nama barang"', 'required');
        $this->form_validation->set_rules('jumlah_barang', '"jumlah barang"', 'required');
        $this->form_validation->set_rules('kondisi', '"kondisi"', 'required');

        $this->load->view('Templates/header', $data);
        $this->load->view('Templates/sidebar', $data);
        $this->load->view('Templates/topbar', $data);
        $this->load->view('Kepengurusan/inventaris', $data);
        $this->load->view('Templates/footer');
    }
    public function addInventaris()
    {
        $nama_barang = $this->input->post('nama_barang');
        $jumlah_barang = $this->input->post('jumlah_barang');
        $kondisi = $this->input->post('kondisi');
        if (strlen($nama_barang) == 0 || strlen($jumlah_barang) == 0 || strlen($kondisi) == 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">data harus di isi lengkap!</div>');
        } else {
            $data = [
                'nama_barang' => $nama_barang,
                'jumlah_barang' => $jumlah_barang,
                'kondisi' => $kondisi
            ];
            $this->db->insert('inventaris', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">inventaris telah ditambahkan!</div>');
        }
        redirect('Kepengurusan/inventaris');
    }

    function delete_inventaris($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('inventaris');
        $hasil = $this->db->affected_rows();
        if ($hasil == true) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">inventaris telah di hapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">inventaris gagal di hapus!</div>');
        }
        redirect('Kepengurusan/inventaris');
    }
}
