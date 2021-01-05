<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('master/Mguru');
		$this->load->model('master/Msiswa');
		$this->load->model('master/Mmapel');
	}
	public function index()
	{
		$data = [
			'title' => 'Guru',
			'page'  => 'Guru',
			'small' => 'List data guru',
			'urls'  => '<li class="active">Guru</li>',
			'data'  => $this->Mguru->getall()
		];
		$this->template->display('master/guru/index', $data);
	}
	public function create()
	{
		$d['dbidangstudi'] = $this->Mmapel->getall();
		$d['agama'] = $this->Msiswa->agama();
		$this->load->view('master/guru/create', $d);
	}
	public function store()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('nip', 'NIP', 'required|is_unique[guru.nipguru]');
			$this->form_validation->set_rules('namaguru', 'Nama', 'required');
			$this->form_validation->set_rules('tempatlahir', 'Tempat lahir', 'required');
			$this->form_validation->set_rules('tanggallahir', 'Tanggal lahir', 'required');
			$this->form_validation->set_rules('jeniskelamin', 'Jenis kelamin', 'required');
			$this->form_validation->set_rules('agama', 'Agama', 'required');
			$this->form_validation->set_rules('bidangstudi', 'Bidang studi', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			$this->form_validation->set_rules('nohp', 'No HP', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->Mguru->store($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data guru berhasil tersimpan.'));
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
		$d['dbidangstudi'] = $this->Mmapel->getall();
		$d['agama'] = $this->Msiswa->agama();
		$d['data'] = $this->Mguru->shows($kode);
		$this->load->view('master/guru/edit', $d);
	}
	public function update()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('nip', 'NIP', 'required');
			$this->form_validation->set_rules('namaguru', 'Nama', 'required');
			$this->form_validation->set_rules('tempatlahir', 'Tempat lahir', 'required');
			$this->form_validation->set_rules('tanggallahir', 'Tanggal lahir', 'required');
			$this->form_validation->set_rules('jeniskelamin', 'Jenis kelamin', 'required');
			$this->form_validation->set_rules('agama', 'Agama', 'required');
			$this->form_validation->set_rules('bidangstudi', 'Bidang studi', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			$this->form_validation->set_rules('nohp', 'No HP', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$params = $this->input->post(null, TRUE);
				$this->Mguru->update($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data guru berhasil diupdate.'));
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
		if (!$this->Mguru->destroy($kode)) {
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data guru.'));
		} else {
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus guru.'));
		}
		redirect('gr');
	}
}
