<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanKaryawan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('Absens/Mlap_karyawan');
	}
	public function index()
	{
		$data = [
			'title' => 'Laporan Data Karyawan',
			'page'  => 'Laporan Data Karyawan',
			'small' => '',
			'urls'  => '<li class="active">Laporan Data Karyawan</li>',
			'data'  => $this->Mlap_karyawan->getall()
		];
		$this->template->display('Absens/lapkaryawan/index', $data);
	}

	public function cetak()
	{
		$a = $this->uri->segment(4);
		$data = [
			'data'  => $this->Mlap_karyawan->tampildata($a),
			
		];
		$this->load->view('Absens/lapkaryawan/cetak',$data);

	}
}
