<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanAbsenHarian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('Absens/Mlap_harian');
	}
	public function index()
	{
		$data = [
			'title' => 'Laporan Absensi Harian',
			'page'  => 'Laporan Absensi Harian',
			'small' => '',
			'urls'  => '<li class="active">Laporan Absensi Harian</li>',
			'data'  => $this->Mlap_harian->getall()
		];
		$this->template->display('Absens/lapharian/index', $data);
	}
}
