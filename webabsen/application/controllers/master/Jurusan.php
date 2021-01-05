<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('master/MJurusan');
	}
	public function index()
	{
		$data = [
			'title' => 'Jurusan',
			'page'  => 'Jurusan',
			'small' => 'List data Jurusan ',
			'urls'  => '<li class="active">Jurusan</li>',
			'data'  => $this->MJurusan->getall()
		];
		$this->template->display('master/jur/index', $data);
	}
	public function create()
	{
		$this->load->view('master/jur/create');
	}
	public function store()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('nama', 'Jurusan', 'required|is_unique[jurusan.nama_jurusan]');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$all = $this->input->post(null, TRUE);
				$this->MJurusan->store($all);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data Jurusan berhasil tersimpan.'));
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
		if (!$this->MJurusan->destroy($kode)) {
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data jurusan.'));
		} else {
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus data jurusan.'));
		}
		redirect('jr');
	}
	public function edit()
	{
		$kode = $this->input->post('kode');
		$d['data'] = $this->MJurusan->shows($kode);
		$this->load->view('master/jur/edit', $d);
	}
	public function update()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('nama', 'Jurusan', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->MJurusan->update($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data jurusan berhasil diupdate.'));
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
