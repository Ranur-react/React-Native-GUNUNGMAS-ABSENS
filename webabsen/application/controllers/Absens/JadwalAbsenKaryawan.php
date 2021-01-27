<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JadwalAbsenKaryawan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('Absens/Mjadwal_absen_karyawan');
		$this->load->model('Absens/Mwaktu_absensi');
		$this->load->model('Absens/Mlokasi_absensi');
		$this->load->model('Absens/Mtmp_karyawan');
		$this->load->model('Absens/Mdata_karyawan');
	}
	public function index()
	{
		$data = [
			'title' => 'Jadwal Absensi Karyawan',
			'page'  => 'Jadwal Absensi Karyawan',
			'small' => 'List data Jadwal Absensi Karyawan',
			'urls'  => '<li class="active">Jadwal Absensi Karyawan</li>',
			'data'  => $this->Mjadwal_absen_karyawan->getall()
		];
		$this->template->display('Absens/jadwalabsenkaryawan/index', $data);
	}
	// public function create()
	// {
	// 	$d['dwaktu'] = $this->Mwaktu_absensi->getall();
	// 	$d['dlokasi'] = $this->Mlokasi_absensi->getall();
	// 	$d['dkaryawan'] = $this->Mdata_karyawan->getall();
	// 	$this->load->view('Absens/jadwalabsenkaryawan/create', $d);
	// }
	public	function HalamanCreate(){


		$data = [
			'title' => 'Buat Jadwal ',
			'page'  => 'Buat Jadwal ',
			'small' => 'Buat Jadwal Absensi Baru',
			'urls'  => '<li class="active">Jadwal Absensi Karyawan</li>',
			'data'  => $this->Mjadwal_absen_karyawan->getall(),
		];
		
		$data['dwaktu'] = $this->Mwaktu_absensi->getall();
		$data['dlokasi'] = $this->Mlokasi_absensi->getall();
		$data['Tmpkaryawan'] = $this->Mtmp_karyawan->getall();
		$this->template->display('Absens/jadwalabsenkaryawan/halamanCreate', $data);
	}
	public function TabelTMP()
	{
		$data['Tmpkaryawan'] = $this->Mtmp_karyawan->getall();
		$this->load->view('Absens/jadwalabsenkaryawan/tabel',$data);
		
	}

	public function tambah()
	{
		$data = [
			'title' => 'Data Karyawan',
			'page'  => 'Data Karyawan',
			'small' => '',
			'urls'  => '<li class="active">Data Karyawan</li>',
			'data'  => $this->Mdata_karyawan->getall()
		];

		$this->load->view('Absens/jadwalabsenkaryawan/tambah',$data);
	}
	public function tambah_KARTMP()
	{
				$all = $this->input->post(null, TRUE);
				echo $all;
				// $this->Mjadwal_absen_karyawan->store($all);
	}





	public function store()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('idjadwal', 'Id Jadwal', 'required|is_unique[jadwal_absen_karyawan.id_jawal]');
			$this->form_validation->set_rules('rentang', 'Rentang Tanggal', 'required');
			$this->form_validation->set_rules('shift', 'Shift', 'required');
			$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
			$this->form_validation->set_rules('karyawan', 'Karyawan', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$all = $this->input->post(null, TRUE);
				$this->Mjadwal_absen_karyawan->store($all);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data absensi karyawan berhasil tersimpan.'));
			} else {
				$json['status'] = false;
				$json['pesan']  = $this->form_validation->error_array();
			}
			echo json_encode($json);
		} else {
			exit('data tidak bisa dieksekusi');
		}
	}
	public function destroy($kode)
	{
		if (!$this->Mjadwal_absen_karyawan->destroy($kode)) {
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data v.'));
		} else {
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus data absensi karyawan.'));
		}
		redirect('jak');
	}
	public function edit()
	{
		$kode = $this->input->post('kode');
		$d['dwaktu'] = $this->Mwaktu_absensi->getall();
		$d['dlokasi'] = $this->Mlokasi_absensi->getall();
		$d['dkaryawan'] = $this->Mdata_karyawan->getall();
		$d['data']   = $this->Mjadwal_absen_karyawan->shows($kode);
		$this->load->view('Absens/jadwalabsenkaryawan/edit', $d);
	}
	public function update()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('idjadwal', 'Id Jadwal', 'required');
			$this->form_validation->set_rules('rentang', 'Rentang Tanggal', 'required');
			$this->form_validation->set_rules('shift', 'Shift', 'required');
			$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
			$this->form_validation->set_rules('karyawan', 'Karyawan', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->Mjadwal_absen_karyawan->update($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data absensi karyawan berhasil diupdate.'));
			} else {
				$json['status'] = false;
				$json['pesan']  = $this->form_validation->error_array();
			}
			echo json_encode($json);
		} else {
			exit('data tidak bisa dieksekusi');
		}
	}
}
