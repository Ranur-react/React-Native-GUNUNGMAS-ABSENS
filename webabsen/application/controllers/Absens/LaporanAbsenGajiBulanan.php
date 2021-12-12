<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanAbsenGajiBulanan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');
		$this->load->model('Absens/Mlap_bulanan');
	}
	public function index()
	{
		$data = [
			'title' => 'Laporan Gaji  Bulanan',
			'page'  => 'Laporan Gaji  Bulanan',
			'small' => '',
			'urls'  => '<li class="active">Laporan Absensi Bulanan</li>',
			'data'  => $this->Mlap_bulanan->getall()
		];
		$this->template->display('Absens/lapbulanan/index', $data);
	}

	public function cetak()
	{
		$a = $this->uri->segment(4);
		$d['PilBulan']=$a;
		$data = [
			'data'  => $this->Mlap_bulanan->shows($d),
			'bulan' => $a,
			
		];
		$this->load->view('Absens/lapbulanan/cetak',$data);

	}

	public function TabelPeriode()
	{
		$all = $this->input->post(null, TRUE);
		$data['dataVar'] = $this->Mlap_bulanan->shows($all);

		$this->load->view('Absens/lapbulanan/tabel',$data);
		
	}
}
