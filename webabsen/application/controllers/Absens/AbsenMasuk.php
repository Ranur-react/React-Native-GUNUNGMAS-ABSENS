<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AbsenMasuk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('Absens/Mabsen_masuk');
	}
	public function index()
	{
		$data = [
			'title' => 'Data Absen Masuk',
			'page'  => 'Data Absen Masuk',
			'small' => '',
			'urls'  => '<li class="active">Data Absen Masuk</li>',
			'data'  => $this->Mabsen_masuk->getall()
		];
		$this->template->display('Absens/absenmasuk/index', $data);
	}
	
	
	public function destroy($kode)
	{
		if (!$this->Mabsen_masuk->destroy($kode)) {
			$this->session->set_flashdata('pesan', danger('Anda tidak bisa menghapus data absen masuk'));
		} else {
			$this->session->set_flashdata('pesan', sukses('Anda telah menghapus data absen masuk'));
		}
		redirect('am');
	}
}
