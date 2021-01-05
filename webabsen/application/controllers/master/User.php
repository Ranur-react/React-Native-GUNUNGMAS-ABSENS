<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('master/Muser');
	}
	public function index()
	{
		$data = [
			'title' => 'Akun',
			'page'  => 'Akun',
			'small' => 'List data Akun',
			'urls'  => '<li class="active">Akun</li>',
			'data'  => $this->Muser->getall()
		];
		$this->template->display('master/user/index', $data);
	}
	public function create()
	{
		$d['level'] = $this->Muser->level();
		$this->load->view('master/user/create', $d);
	}
	public function get_select()
	{
		$level = $this->input->post('level');
		$data  = "";
		$label = "";
		if ($level == '1' || $level == "") {
			$display = "none";
		} else if ($level == '2') {
			$result  = $this->Muser->get_guru();
			$label   = "Guru";
			$display = "block";
			$data    .= "<option value=''>-- Pilih Guru --</option>";
			foreach ($result as $ka) {
				$data .= "<option value='$ka[idguru]'>$ka[namaguru]</option>";
			}
		} else if ($level == '3') {
			$result  = $this->Muser->get_siswa();
			$label   = "Siswa";
			$display = "block";
			$data    .= "<option value=''>-- Pilih Siswa --</option>";
			foreach ($result as $ka) {
				$data .= "<option value='$ka[id_siswa]'>$ka[nama_siswa]</option>";
			}
		}
		$json['data']    = $data;
		$json['label']   = $label;
		$json['display'] = $display;
		echo json_encode($json);
	}
	public function store()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$params = $this->input->post(null, TRUE);
			if ($params['level'] != '1') {
				$this->form_validation->set_rules('kode', 'User', 'required');
			}
			$this->form_validation->set_rules('level', 'Level', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			$this->form_validation->set_message('is_unique', '%s sudah digunakan.');
			if ($this->form_validation->run() == TRUE) {
				$this->Muser->store($params);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data akun berhasil tersimpan.'));
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
		$d['data']  = $this->Muser->show($kode);
		$d['nama']  = $this->Muser->show_nama($kode);
		$d['level'] = $this->Muser->level();
		$this->load->view('master/user/edit', $d);
	}
	public function update()
	{
		if ($this->input->is_ajax_request() == TRUE) {
			$this->form_validation->set_rules('email', 'Nama', 'required');
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			if ($this->form_validation->run() == TRUE) {
				$param = $this->input->post(null, TRUE);
				$this->Muser->update($param);
				$json['status'] = true;
				$this->session->set_flashdata('pesan', sukses('Data akun berhasil diupdate.'));
			} else {
				$json['status'] = false;
				$json['pesan']  = $this->form_validation->error_array();
			}
			echo json_encode($json);
		} else {
			exit('data tidak bisa dieksekusi');
		}
	}
	public function status($kode)
	{
		$this->Muser->status($kode);
		$this->session->set_flashdata('pesan', sukses('Anda telah merubah status akun.'));
		redirect('user');
	}
	public function destroy($kode)
	{
		if (!$this->Muser->destroy($kode))
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data akun.'));
		else
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus data akun.'));
		redirect('user');
	}
}
