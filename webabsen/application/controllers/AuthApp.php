<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthApp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mauth');
        $this->load->model('Absens/Mdata_karyawan');
    }
    public function index()
    {
        if ($this->session->userdata('status_login') == TRUE) {
            redirect('Home');
        } else {
            $this->load->view('login');
        }
    }










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
                 if (!$dk==null) $json['DataKARRRRYWAN'] = "Ada karyawan"; 
                    else $json['DataKARRRRYWAN'] = "GAK Ada karyawan";

                                $json['Data'] = $data;
                                $json['IDkaryawan'] = $data['kode_user'];
                                $json['namakaryawan'] = "Admin";
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

















    public function validate()
    {
        $usrname = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));
        $check_user = $this->Mauth->check_user($usrname);
        $check_pass = $this->Mauth->check_pass($usrname, $password);
        $this->form_validation->set_rules('username', 'Username', 'callback_username_check[' . $check_user->num_rows() . ']');
        $this->form_validation->set_rules('password', 'Password', 'callback_password_check[' . $check_pass->num_rows() . ']');
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(null, TRUE);
            $value = $this->Mauth->validate($post);
            $this->session->set_userdata('masuk', TRUE);
            if ($this->session->userdata('masuk') == TRUE) {
                $this->session->set_userdata('status_login', TRUE);
                $this->session->set_userdata('kode', $value['id_user']);
                $this->session->set_flashdata('pesan', sukses('Berhasli Login.'));
            } else {
                $this->session->session_destroy();
            }
            $json['status'] = TRUE;
        } else {
            $json['pesan'] = $this->form_validation->error_array();
        }
        echo json_encode($json);
    }
    public function username_check($username, $recordCount)
    {
        if ($username == null) {
            $this->form_validation->set_message('username_check', 'Username is required.');
            return false;
        } else if ($recordCount == 0) {
            $this->form_validation->set_message('username_check', 'Username is not correct.');
            return FALSE;
        } else {

            return true;
        }
    }
    public function password_check($password, $recordCount)
    {
        if ($password == null) {
            $this->form_validation->set_message('password_check', 'Password is required.');
            return false;
        } else if ($recordCount == 0) {
            $this->form_validation->set_message('password_check', 'Password is not correct.');
            return FALSE;
        } else {

            return true;
        }
    }
    public function logout()
    {
        //$this->session->sess_destroy();
        $this->session->unset_userdata('status_login', FALSE);
        $this->session->unset_userdata('kode');
        redirect(site_url());
    }
}
