<?php defined('BASEPATH') or exit('No direct script access allowed');

class Calendar_model extends CI_Model
{
    function fetch_event()
    {
        $this->db->order_by('id_pelaksanaan');
        return $this->db->get('Pelaksanaan');
    }
}
