<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HalamaUtama extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status_login') == true)
			cek_user();
		else
			redirect('logout');

	}





	public function index()
	{
		$data = [
			'title' => 'Guru',
			'page'  => 'Guru',
			'small' => 'List data guru',
			'urls'  => '<li class="active">Guru</li>',
			'data'  => ''
		];
		$this->template->display('Absens/Home/index', $data);
	}
}
