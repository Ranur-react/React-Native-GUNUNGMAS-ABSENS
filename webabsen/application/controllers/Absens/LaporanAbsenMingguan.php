<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanAbsenMingguan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('Absens/Mlap_mingguan');
	}
	public function index()
	{
		$data = [
			'title' => 'Laporan Absensi Mingguan',
			'page'  => 'Laporan Absensi Mingguan',
			'small' => '',
			'urls'  => '<li class="active">Laporan Absensi Mingguan</li>',
			'data'  => $this->Mlap_mingguan->getall()
		];
		$this->template->display('Absens/lapmingguan/index', $data);
	}
}
