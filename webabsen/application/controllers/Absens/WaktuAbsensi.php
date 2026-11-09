<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WaktuAbsensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('Absens/Mwaktu_absensi');
	}
	public function index()
	{
		$data = [
			'title' => 'Waktu Absensi',
			'page'  => 'Waktu Absensi',
			'small' => '',
			'urls'  => '<li class="active">Waktu Absensi</li>',
			'data'  => $this->Mwaktu_absensi->getall()
		];
		$this->template->display('Absens/waktuabsensi/index', $data);
	}
	public function create()
	{

		$this->load->view('Absens/waktuabsensi/create','');
	}
	public function store()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('idwaktu', 'Id Waktu', 'required|is_unique[set_waktu_absens.id_waktu]');
			$this->form_validation->set_rules('ketwaktu', 'Keterangan Waktu', 'required');
			$this->form_validation->set_rules('waktumulaimasuk', 'Waktu Mulai Masuk', 'required');
			$this->form_validation->set_rules('waktuselesaimasuk', 'Waktu Selesai Masuk', 'required');
			$this->form_validation->set_rules('toleransi', 'Toleransi Keterlambatan', 'required');
			$this->form_validation->set_rules('waktumulaikeluar', 'Waktu Mulai Keluar', 'required');
			$this->form_validation->set_rules('waktuselesaikeluar', 'Waktu Selesai Keluar', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->Mwaktu_absensi->store($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Waktu berhasil di set'));
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
		$d['data'] = $this->Mwaktu_absensi->shows($kode);
		$this->load->view('Absens/waktuabsensi/edit', $d);
	}
	public function update()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('idwaktu', 'Id Waktu', 'required');
			$this->form_validation->set_rules('ketwaktu', 'Keterangan Waktu', 'required');
			$this->form_validation->set_rules('waktumulaimasuk', 'Waktu Mulai Masuk', 'required');
			$this->form_validation->set_rules('waktuselesaimasuk', 'Waktu Selesai Masuk', 'required');
			$this->form_validation->set_rules('toleransi', 'Toleransi Keterlambatan', 'required');
			$this->form_validation->set_rules('waktumulaikeluar', 'Waktu Mulai Keluar', 'required');
			$this->form_validation->set_rules('waktuselesaikeluar', 'Waktu Selesai Keluar', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->Mwaktu_absensi->update($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Waktu absensi berhasil diupdate'));
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
		if (!$this->Mwaktu_absensi->destroy($kode)) {
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data waktu absensi'));
		} else {
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus data waktu absensi'));
		}
		redirect('wa');
	}
}
