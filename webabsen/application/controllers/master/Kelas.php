<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('master/MJurusan');
		$this->load->model('master/MKelas');
	}
	public function index()
	{
		$data = [
			'title' => 'Kelas',
			'page'  => 'Tingkatan Kelas',
			'small' => 'List data tingkatan kelas',
			'urls'  => '<li class="active">Tingkatan Kelas</li>',
			'data'  => $this->MKelas->getall()
		];
		$this->template->display('master/kel/index', $data);
	}
	public function create()
	{
		$d['djurus'] = $this->MJurusan->getall();
		$this->load->view('master/kel/create', $d);
	}
	public function store()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('nama', 'Nama kelas', 'required|is_unique[kelas.nama_kelas]');
			$this->form_validation->set_rules('tingkat', 'Tingkatan kelas', 'required');
			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$all = $this->input->post(null, TRUE);
				$this->MKelas->store($all);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data tingkatan kelas berhasil tersimpan.'));
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
		if (!$this->MKelas->destroy($kode)) {
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data tingkatan kelas.'));
		} else {
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus data tingkatan kelas.'));
		}
		redirect('kel');
	}
	public function edit()
	{
		$kode = $this->input->post('kode');
		$d['djurus'] = $this->MJurusan->getall();
		$d['data'] = $this->MKelas->shows($kode);
		$this->load->view('master/kel/edit', $d);
	}
	public function update()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('nama', 'Nama kelas', 'required');
			$this->form_validation->set_rules('tingkat', 'Tingkatan kelas', 'required');
			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->MKelas->update($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data tingkatan kelas berhasil diupdate.'));
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
