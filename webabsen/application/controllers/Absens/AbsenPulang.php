<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AbsenPulang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('Absens/Mabsen_pulang');
	}
	public function index()
	{
		$data = [
			'title' => 'Data Absen Pulang',
			'page'  => 'Data Absen Pulang',
			'small' => '',
			'urls'  => '<li class="active">Data Absen Pulang</li>',
			'data'  => $this->Mabsen_pulang->getall()
		];
		$this->template->display('Absens/absenpulang/index', $data);
	}
	public function create()
	{

		$this->load->view('Absens/absenpulang/create','');
	}
	
	
	public function destroy($kode)
	{
		if (!$this->Mabsen_pulang->destroy($kode)) {
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data absen pulang'));
		} else {
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus data absen pulang'));
		}
		redirect('ap');
	}
}
