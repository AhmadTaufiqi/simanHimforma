<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan_model extends CI_Model
{
  
  public function Perencanaan()
  {
    $this->db->order_by('tgl_perencanaan','ASC');
    $program = $this->db->get('perencanaan')->result_array();
    if($program){
     
    foreach ($program as $row) {
      $dt["id_perencanaan"] = $row['id_perencanaan'];
      $dt["nama_kegiatan"] = $row['nama_kegiatan'];
      $dt["deskripsi"] = $row['deskripsi'];
      $dt["tujuan"] = $row['tujuan'];
      $dt["sasaran"] = $row['sasaran'];
      $dt["tgl_perencanaan"] = $row['tgl_perencanaan'];
      $pelaksanaan = $this->db->get_where('pelaksanaan',['nama_kegiatan'=> $dt['nama_kegiatan']])->result_array();
      if($pelaksanaan){
        $dt["warna_terlaksana"] = "rgba(54, 162, 235, 0.2)";
        $dt["border"] = "rgba(54, 162, 235, 1)";
      }else{
        $dt["warna_terlaksana"] = "rgba(255, 99, 132, 0.2)";
        $dt["border"] = "rgba(255,99,132,1)";
      }
      if ($dana = $this->db->get_where('sumber_dana_kegiatan', ['id_perencanaan' => $dt['id_perencanaan']])->row_array()) {
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
    
  }else{
    $data_table = 0;
  }
    return $data_table;
  }

  public function Pelaksanaan()
  {
    $pelaksanaan = $this->db->get('pelaksanaan')->result_array();

    if($pelaksanaan){

      foreach ($pelaksanaan as $row) {
        $dt["id_pelaksanaan"] = $row['id_pelaksanaan'];
        $id_perencanaan = $row['id_perencanaan'];
        $dt["nama_kegiatan"] = $row['nama_kegiatan'];
        $dt["file_proposal"] = $row['file_proposal'];
        $dt["tgl_pelaksanaan"] = $row['tgl_pelaksanaan'];
        if ($dana = $this->db->get_where('sumber_dana_kegiatan', ['id_pelaksanaan' => $dt['id_pelaksanaan']])->row_array()) {
          $dt["dana_keseluruhan"] = $dana['dana_DKM'] + $dana['dana_LKM'] + $dana['dana_sponsor'] + $dana['dana_lain'];
          $dt['dana_DKM'] = $dana['dana_DKM'];
          $dt['dana_LKM'] = $dana['dana_LKM'];
          $dt['dana_sponsor'] = $dana['dana_sponsor'];
          $dt['dana_lain'] = $dana['dana_lain'];
        } else {
          $dt["dana_keseluruhan"] = '0';
          $dt['dana_DKM'] = "0";
          $dt['dana_LKM'] = "0";
          $dt['dana_sponsor'] = "0";
          $dt['dana_lain'] = "0";
        }
        $dt["deskripsi"] = $this->db->get_where('perencanaan', ['id_perencanaan' => $id_perencanaan])->row_array()['deskripsi'];
        $data_table[] = $dt;
      };
    }else{
      $dt["id_pelaksanaan"] = "-";
      $dt["deskripsi"] = "-";
      $id_perencanaan = "-";
      $dt["nama_kegiatan"] = "-";
      $dt["file_proposal"] = "-";
      $dt["tgl_pelaksanaan"] = "-";
      $dt["dana_keseluruhan"] = '0';
      $dt['dana_DKM'] = "0";
      $dt['dana_LKM'] = "0";
      $dt['dana_sponsor'] = "0";
      $dt['dana_lain'] = "0";
      $data_table[] = $dt;
    }
    return $data_table;
  }

  public function Pertanggungjawaban()
  {
    $pertanggungjwb1 = $this->db->get_where('pertanggungjwb')->result_array();
    if ($pertanggungjwb1) {
      foreach ($pertanggungjwb1 as $row) {
        $id_perencanaan = $row["id_perencanaan"];
        $dt["id_lpj"] = $row['id_lpj'];
        $dt["nama_kegiatan"] = $row['nama_kegiatan'];
        $dt["link_dokumentasi"] = $row['link_dokumentasi'];
        $dt["file_lpj"] = $row['file_lpj'];
        $dt["deskripsi"] = $this->db->get_where('perencanaan', ['id_perencanaan' => $id_perencanaan])->row_array()['deskripsi'];
        $dt["catatan"] = $row['catatan'];
        $data_table[] = $dt;
      };
    } else {

      $data_table[] = array(
        'id_lpj' => "-",
        'nama_kegiatan' => "-",
        'link_dokumentasi' => "",
        'file_lpj' => "-",
        'deskripsi' => "-",
        'catatan' => "-",
      );
    }
    return $data_table;
  }
}
