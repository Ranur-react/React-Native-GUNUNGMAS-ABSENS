<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('master/MSiswa');
		$this->load->model('master/MJurusan');
	}
	public function index()
	{
		$data = [
			'title' => 'Siswa',
			'page'  => 'Data Siswa',
			'small' => 'List data siswa',
			'urls'  => '<li class="active">Siswa</li>',
			'data'  => $this->MSiswa->getall()
		];
		$this->template->display('master/siswa/index', $data);
	}
	public function create()
	{
		$d['djurus'] = $this->MJurusan->getall();
		$d['agama']  = $this->MSiswa->agama();
		$this->load->view('master/siswa/create', $d);
	}
	public function store()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('nisn', 'NISN', 'required|is_unique[siswa.nisn_siswa]');
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$all = $this->input->post(null, TRUE);
				$this->MSiswa->store($all);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data siswa berhasil tersimpan.'));
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
		if (!$this->MSiswa->destroy($kode)) {
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data siswa.'));
		} else {
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus data siswa.'));
		}
		redirect('siw');
	}
	public function edit()
	{
		$kode = $this->input->post('kode');
		$d['djurus'] = $this->MJurusan->getall();
		$d['agama']  = $this->MSiswa->agama();
		$d['data']   = $this->MSiswa->shows($kode);
		$this->load->view('master/siswa/edit', $d);
	}
	public function update()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('nisn', 'NISN', 'required');
			$this->form_validation->set_rules('nama', 'Nama', 'required');
			$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->MSiswa->update($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data siswa berhasil diupdate.'));
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
