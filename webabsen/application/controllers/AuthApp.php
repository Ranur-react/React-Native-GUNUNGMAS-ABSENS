<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthApp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mauth');
        $this->load->model('Absens/Mdata_karyawan');
        $this->load->model('Absens/Mjadwal_absen_karyawan');
        $this->load->model('Absens/Mabsen_masuk');
    }
    	public function index()
	{
	    
	    echo "bisa di akses";
	}
    
	public function histoMasuk()
	{
		$js = file_get_contents('php://input');
         $obj = json_decode($js,true);
         $ID = $obj['IDkaryawan'];
		$qry=$this->Mabsen_masuk->getallHistoryMasuk($ID);
		
		if ($qry) {
			$database = [];
			// foreach ($variable as $key ) {
			// 	$database[]=$variable;
			// }
			$data['data'] = $qry;
		
			$data['pesan'] = "";
			$data['status'] = true;
		}else{
			$data['data'] = "";
			$data['pesan'] = "Data gagal diambil dari database";
			$data['status'] = false;
		}
		echo json_encode($data);
	}
    // public function index()
    // {
    //     if ($this->session->userdata('status_login') == TRUE) {
    //         redirect('Home');
    //     } else {
    //         $this->load->view('login');
    //     }
    // }

    public function Usernamecek()
    {
        $usrname = trim($this->input->post('username'));
        $check_user = $this->Mauth->check_user($usrname);
        $this->form_validation->set_rules('username', 'Username', 'callback_username_check[' . $check_user->num_rows() . ']');
        if ($this->form_validation->run() == TRUE) {
            $json['status'] = TRUE;
        } else {
            $json['status'] = FALSE;
        }
        echo json_encode($json);
    }
    public function CekdataKaryawan($id)
    {
                 return $data=$this->Mdata_karyawan->shows($id);
    }
    public function Passwordcek()
    {
         $js = file_get_contents('php://input');
         $obj = json_decode($js,true);
         $usrname = $obj['username'];
         $password = $obj['password'];
        

        if ($this->Mauth->check_user($usrname)->num_rows()!=0 ) {
           if ($this->Mauth->check_pass($usrname, $password)->num_rows() !=0 ) {
                 $data=$this->Mauth->check_pass($usrname, $password)->row_array();
                 $dk=$this->Mdata_karyawan->shows($data['kode_user']);
                                $json['IDkaryawan'] = $data['kode_user'];
                                 if (!$dk==null) $json['namakaryawan'] = $dk['nama_karyawan']; 
                                    else $json['namakaryawan'] = "Admin";
                                $json['levelakses'] = $data['level_user'];
                                $json['status'] = $data['status_user'];
            $json['pesan'] = "Passowrd benar";
            } else {
                $json['status'] = FALSE;
                $json['pesan'] = "Password Salah";
            }
       }else{
             $json['status'] = FALSE;
                $json['pesan'] = "E-Mail Salah";
       }


        echo json_encode($json);
    }
    public function JadwalCek()
    {
         $js = file_get_contents('php://input');
         $obj = json_decode($js,true);
         $ID = $obj['IDkaryawan'];
        $qry= $this->Mjadwal_absen_karyawan->getCustomeID($ID);
        $dj= $qry->row_array();
        $json['Request--->'] = $ID;
                if ($qry->num_rows() >= 1) {
                    $json['respond'] = true;
                    $json['data'] = $dj;
                }else{
                    $json['respond'] = false;
                    $json['data'] = null;
                    $json['Pesan'] = "Jadwal Belum di set, Mohon hubungi Administrator";
                    $json['Jumlah Rows'] = $qry->num_rows();

                }
        echo json_encode($json);
        
    }

    public function logout()
    {
        //$this->session->sess_destroy();
        $this->session->unset_userdata('status_login', FALSE);
        $this->session->unset_userdata('kode');
        redirect(site_url());
    }
}