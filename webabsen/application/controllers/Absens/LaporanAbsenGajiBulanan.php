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
		$this->template->display('Absens/lapbulanangaji/index', $data);
	}
public function pimpinan()
{
		$data = [
			'title' => 'Laporan Gaji  Bulanan Pimpinan',
			'page'  => 'Laporan Gaji  Bulanan Pimpinan',
			'small' => '',
			'urls'  => '<li class="active">Laporan Gaji  Bulanan Pimpinan</li>',
			'data'  => $this->Mlap_bulanan->getall()
		];
		$this->template->display('Absens/lapbulanangaji/pimpinan/index', $data);
}
	public function cetak()
	{
		$month = $this->uri->segment(4);
		$emp = $this->uri->segment(5);
		$tahun = $this->uri->segment(6);
		$data = [
			'dataVar'  => $this->Mlap_bulanan->showsSlips($month,$emp, $tahun),
			'bulan' => $month,
			
		];
		$this->load->view('Absens/lapbulanangaji/cetak',$data);

	}
	

	public function TabelPeriode()
	{
		$all = $this->input->post(null, TRUE);
		$data['dataVar'] = $this->Mlap_bulanan->shows($all);

		$this->load->view('Absens/lapbulanangaji/tabel',$data);
		
	}
	public function TabelPeriodePimpinan()
	{
		$all = $this->input->post(null, TRUE);
		$data['dataVar'] = $this->Mlap_bulanan->shows($all);

		$this->load->view('Absens/lapbulanangaji/pimpinan/tabel', $data);
	}
	public function cetakpimpinan()
	{
		$all['PilBulan'] = $this->uri->segment(4);
		$all['PilTahun'] = $this->uri->segment(6);
		$data = [
			'dataVar'  => $this->Mlap_bulanan->shows($all),
			'bulan' => $this->uri->segment(4),
			'tahun' => $this->uri->segment(5),

		];
		$this->load->view('Absens/lapbulanangaji/pimpinan/cetak', $data);
	}
}
