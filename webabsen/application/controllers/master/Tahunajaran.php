<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahunajaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('master/Mtahunajaran');
	}
	public function index()
	{
		$data = [
			'title' => 'Tahun Ajaran',
			'page'  => 'Tahun Ajaran',
			'small' => 'List data tahun ajaran ',
			'urls'  => '<li class="active">Tahun Ajaran</li>',
			'data'  => $this->Mtahunajaran->getall()
		];
		$this->template->display('master/tahun/index', $data);
	}
	public function create()
	{
		$this->load->view('master/tahun/create');
	}
	public function store()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('nama', 'Tahun ajaran', 'required|is_unique[tahun_ajaran.nama_tahun]');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->Mtahunajaran->store($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data tahun ajaran berhasil tersimpan.'));
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
		$d['data'] = $this->Mtahunajaran->shows($kode);
		$this->load->view('master/tahun/edit', $d);
	}
	public function update()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('nama', 'Tahun ajaran', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->Mtahunajaran->update($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data tahun ajaran berhasil diupdate.'));
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
		if (!$this->Mtahunajaran->destroy($kode)) {
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data tahun ajaran.'));
		} else {
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus data tahun ajaran.'));
		}
		redirect('tahun-ajaran');
	}
	public function status($kode)
	{
		$this->Mtahunajaran->status($kode);
		$this->session->set_flashdata('pesan', sukses('Anda telah merubah status tahun ajaran.'));
		redirect('tahun-ajaran');
	}
}
