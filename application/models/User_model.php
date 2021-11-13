<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    // public function __construct()
    // {
    //     is_logged_in();
    // }

    public function dataUser()
    {
        return $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
    }

    public function dataArsip()
    {
        return $this->db->get_where('arsip')->result_array();
    }

    public function file_data($id)
    {
        return $this->db->get_where('arsip', ['id' => $id])->row_array();
    }
}
