<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Kegiatan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('arsip_model');
		$this->load->model('user_model');
		is_logged_in();
	}
	public function testingDummy2()
	{
		echo "ahmad taufiqi muhsinin";
	}
	public function perencanaan()
	{
		$program = $this->db->get('program')->result_array();
		foreach ($program as $row) {
			$dt["id"] = $row['id'];
			$dt["nama_prog"] = $row['nama_prog'];
			$dt["deskripsi"] = $row['deskripsi'];
			$dt["tujuan"] = $row['tujuan'];
			$dt["sasaran"] = $row['sasaran'];
			$dt["id_agenda"] = $row['id_agenda'];
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
		$data["perencanaan"] = $data_table;
		$data['user'] = $this->user_model->dataUser();
		$data['title'] = 'Perencanaan Program Kerja';
		$this->load->view('Templates/header', $data);
		$this->load->view('Templates/sidebar', $data);
		$this->load->view('Templates/topbar', $data);
		$this->load->view('Kegiatan/perencanaan', $data);
		$this->load->view('Templates/footer');
	}
	public function pertanggungjwb()
	{
		$data['user'] = $this->user_model->dataUser();
		$pertanggungjwb1 = $this->db->get_where('pertanggungjwb')->result_array();
		if ($pertanggungjwb1) {
			foreach ($pertanggungjwb1 as $row) {
				$id_prog = $row["id_prog"];
				$dt["id"] = $row['id'];
				$dt["nama_kegiatan"] = $row['nama_kegiatan'];
				$dt["hasil"] = $row['hasil'];
				$dt["link_dokumentasi"] = $row['link_dokumentasi'];
				$dt["lpj"] = $row['lpj'];
				$dt["deskripsi"] = $this->db->get_where('program', ['id' => $id_prog])->row_array()['deskripsi'];
				$data_table[] = $dt;
			};
		} else {

			$data_table[] = array(
				'id' => "-",
				'nama_kegiatan' => "-",
				'hasil' => "-",
				'link_dokumentasi' => "-",
				'lpj' => "-",
				'deskripsi' => "-",
			);
		}

		$data["pertanggung_jwb"] = $data_table;
		$data['prog_terlaksana'] = $this->db->get_where('pelaksanaan')->result_array();
		$data['title'] = 'pertanggungjawaban';

		$this->load->view('Templates/header', $data);
		$this->load->view('Templates/sidebar', $data);
		$this->load->view('Templates/topbar', $data);
		$this->load->view('Kegiatan/pertanggungjwb', $data);
		$this->load->view('Templates/footer');
	}
	public function pelaksanaan()
	{
		// $id = "1";
		$data['user'] = $this->user_model->dataUser();
		$pelaksanaan = $this->db->get('pelaksanaan')->result_array();

		foreach ($pelaksanaan as $row) {
			$dt["id"] = $row['id'];
			$id_prog = $row['id_prog'];
			$dt["nama_kegiatan"] = $row['nama_kegiatan'];
			$dt["file_proposal"] = $row['file_proposal'];
			$dt["tgl_pelaksanaan"] = $row['tgl_pelaksanaan'];
			if ($dana = $this->db->get_where('sumber_dana_kegiatan', ['id_pelaksanaan' => $dt['id']])->row_array()) {
				$dt["dana_keseluruhan"] = $dana['dana_DKM'] + $dana['dana_LKM'] + $dana['dana_sponsor'] + $dana['dana_lain'];
			} else {
				$dt["dana_keseluruhan"] = '0';
			}
			$dt["deskripsi"] = $this->db->get_where('program', ['id' => $id_prog])->row_array()['deskripsi'];
			$data_table[] = $dt;
		};
		$data["pelaksanaan"] = $data_table;
		$data['program'] = $this->db->get_where('program');
		$data['title'] = 'pelaksanaan';
		$this->load->view('Templates/header', $data);
		$this->load->view('Templates/sidebar', $data);
		$this->load->view('Templates/topbar', $data);
		$this->load->view('Kegiatan/pelaksanaan', $data);
		$this->load->view('Templates/footer');
	}
}
