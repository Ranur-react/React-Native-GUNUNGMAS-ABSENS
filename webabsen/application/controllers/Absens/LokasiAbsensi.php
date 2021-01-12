<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LokasiAbsensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('Absens/Mlokasi_absensi');
	}
	public function index()
	{
		$data = [
			'title' => 'Lokasi Absensi',
			'page'  => 'Lokasi Absensi',
			'small' => '',
			'urls'  => '<li class="active">Lokasi Absensi</li>',
			'data'  => $this->Mlokasi_absensi->getall()
		];
		$this->template->display('Absens/lokasiabsensi/index', $data);
	}
	public function create()
	{

		$this->load->view('Absens/lokasiabsensi/create','');
	}
	public function store()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('idlokasi', 'Id Set Lokasi', 'required|is_unique[set_lokasi.id_set_lokasi]');
			$this->form_validation->set_rules('latitude', 'Latitude', 'required');
			$this->form_validation->set_rules('longitude', 'Longitude', 'required');
			$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->Mlokasi_absensi->store($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('lokasi absensi berhasil di simpan'));
			} else {
				$json['status'] = false;
				$json['pesan']  = $this->form_validation->error_array();
			}
			echo json_encode($json);
		} else {
			exit('data tidak bisa dieksekusi');
		}
	}
	public function edit()
	{
		$kode = $this->input->post('kode');
		$d['data'] = $this->Mlokasi_absensi->shows($kode);
		$this->load->view('Absens/lokasiabsensi/edit', $d);
	}
	public function update()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('idlokasi', 'Id Set Lokasi', 'required');
			$this->form_validation->set_rules('latitude', 'Latitude', 'required');
			$this->form_validation->set_rules('longitude', 'Longitude', 'required');
			$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->Mlokasi_absensi->update($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Lokasi Absensi berhasil diupdate'));
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
		if (!$this->Mlokasi_absensi->destroy($kode)) {
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data lokasi absensi'));
		} else {
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus data lokasi absensi'));
		}
		redirect('la');
	}
}
