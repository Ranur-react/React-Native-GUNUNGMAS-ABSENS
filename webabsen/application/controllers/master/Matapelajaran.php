<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Matapelajaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('master/Mmapel');
	}
	public function index()
	{
		$data = [
			'title' => 'Mata Pelajaran',
			'page'  => 'Mata Pelajaran',
			'small' => 'List data mata pelajaran ',
			'urls'  => '<li class="active">Mata Pelajaran</li>',
			'data'  => $this->Mmapel->getall()
		];
		$this->template->display('master/mapel/index', $data);
	}
	public function create()
	{
		$this->load->view('master/mapel/create');
	}
	public function store()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('matapel', 'Mata Pelajaran', 'required|is_unique[matapelajaran.namamapel]');
			$this->form_validation->set_rules('singkatan', 'Singkatan', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->Mmapel->store($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data mata pelajaran berhasil tersimpan.'));
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
		$d['data'] = $this->Mmapel->shows($kode);
		$this->load->view('master/mapel/edit', $d);
	}
	public function update()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('matapel', 'Mata Pelajaran', 'required');
			$this->form_validation->set_rules('singkatan', 'Singkatan', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->Mmapel->update($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data mata pelajaran berhasil diupdate.'));
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
		if (!$this->Mmapel->destroy($kode)) {
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data mata pelajaran.'));
		} else {
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus data mata pelajaran.'));
		}
		redirect('mp');
	}
}
