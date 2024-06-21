<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TmpKaryawan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Absens/Mtmp_karyawan');
	}
	public function index()
	{
		$js = file_get_contents('php://input');
		 $obj = json_decode($js,true);
		 $i=count($obj);
		for ($r=0; $r < $i ; $r++) { 
				$this->Mtmp_karyawan->store($obj[$r]);
		}
		$data['pesan']="BIsa";
		echo json_encode($data);
	}

	
}
