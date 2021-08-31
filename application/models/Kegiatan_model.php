<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
{
  
  public function Program()
  {
    $program = $this->db->get('program')->result_array();
    foreach ($program as $row) {
      $dt["id"] = $row['id'];
      $dt["nama_prog"] = $row['nama_prog'];
      $dt["deskripsi"] = $row['deskripsi'];
      $dt["tujuan"] = $row['tujuan'];
      $dt["sasaran"] = $row['sasaran'];
      $dt["id_agenda"] = $row['id_agenda'];
      $pelaksanaan = $this->db->get_where('pelaksanaan',['nama_kegiatan'=> $dt['nama_prog']])->result_array();
      if($pelaksanaan){
        $dt["warna_terlaksana"] = "rgba(54, 162, 235, 0.2)";
        $dt["border"] = "rgba(54, 162, 235, 1)";
      }else{
        $dt["warna_terlaksana"] = "rgba(255, 99, 132, 0.2)";
        $dt["border"] = "rgba(255,99,132,1)";
      }
      if ($dana = $this->db->get_where('sumber_dana_kegiatan', ['id_prog' => $dt['id']])->row_array()) {
        $dt["dana_keseluruhan"] = $dana['dana_DKM'] + $dana['dana_LKM'] + $dana['dana_sponsor'] + $dana['dana_lain'];
        $dt['dana_DKM'] = $dana["dana_DKM"];
        $dt['dana_LKM'] = $dana["dana_LKM"];
        $dt['dana_sponsor'] = $dana["dana_sponsor"];
        $dt['dana_lain'] = $dana["dana_lain"];
      } else {
        $dt["dana_keseluruhan"] = '0';
        $dt['dana_DKM'] = '0';
        $dt['dana_LKM'] = '0';
        $dt['dana_sponsor'] = '0';
        $dt['dana_lain'] = '0';
      }
      $data_table[] = $dt;
    };
    return $data_table;
  }

  public function Pelaksanaan()
  {
    return $this->db->get_where('arsip')->result_array();
  }

  public function Pertanggungjawaban($id)
  {
    return $this->db->get_where('arsip', ['id' => $id])->row_array();
  }
}
