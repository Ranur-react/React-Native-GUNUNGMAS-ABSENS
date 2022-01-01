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
			'title' => 'Laporan Absensi per Periode Tanggal',
			'page'  => 'Laporan Absensi per Periode Tanggal',
			'small' => '',
			'urls'  => '<li class="active">Laporan Absensi Mingguan</li>',
			
		];
		$this->template->display('Absens/lapmingguan/index', $data);
	}

	public function cetak()
	{
		$all['awal']= $awal = $this->uri->segment(4);
		$all['akhir']=$akhir = $this->uri->segment(5);

		$data = [
			'data'  => $data['dataVar'] = $this->Mlap_mingguan->shows($all),
			'awal'  => date("Y-m-d", strtotime($all['awal'])),
			'akhir' => date("Y-m-d", strtotime($all['akhir'])),
		];
		$this->load->view('Absens/lapmingguan/cetak',$data);

	}
	public function TabelPeriode()
	{
		$all = $this->input->post(null, TRUE);
		$data['dataVar'] = $this->Mlap_mingguan->shows($all);
		$dateStart = date("Y-m-d", strtotime($all['awal']));
		$dateEnd = date("Y-m-d", strtotime($all['akhir']));
		$date1 = new DateTime($dateStart);
		$date2 = new DateTime($dateEnd);
		$interval = $date1->diff($date2);
		$data['hari'] = ($interval->days)+1;

		$this->load->view('Absens/lapmingguan/tabel',$data);
		
	}
}
