<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanAbsenTahunan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('Absens/Mlap_tahunan');
	}
	public function index()
	{
		$data = [
			'title' => 'Laporan Absensi Tahunan',
			'page'  => 'Laporan Absensi Tahunan',
			'small' => '',
			'urls'  => '<li class="active">Laporan Absensi Tahunan</li>',
			'data'  => $this->Mlap_tahunan->getall()
		];
		$this->template->display('Absens/laptahunan/index', $data);
	}

	public function cetak()
	{
		$a = $this->uri->segment(4);
		$d['PilTahun']=$a;
		$data = [
			'data'  => $this->Mlap_tahunan->shows($d),
			'tahun' => $a,
			
		];
		$this->load->view('Absens/laptahunan/cetak',$data);

	}

	public function TabelPeriode()
	{
		$all = $this->input->post(null, TRUE);
		$data['dataVar'] = $this->Mlap_tahunan->shows($all);

		$this->load->view('Absens/laptahunan/tabel',$data);
		
	}
}
