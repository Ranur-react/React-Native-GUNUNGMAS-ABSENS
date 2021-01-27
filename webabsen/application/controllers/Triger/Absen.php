<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mauth');
        $this->load->model('Absens/Mdata_karyawan');
        $this->load->model('Absens/Mabsen_masuk');
    }
    public function Simpanke($value='')
    {
        # code...
    }
    public function index()
    {
        $MESSAGE['Respon-------------Awal>']="..........................";
        $obj=file_get_contents('php://input');
        $objSon=json_decode($obj,true);
        $MESSAGE['POST>']=$_POST['ID'];
        $target_dir = "AsetKaryawan_Foto/FotoAbsen".$_POST['StatusAbsen']."/".$_POST['NamaKaryawan'];
            if (!file_exists($target_dir)) {
                mkdir($target_dir,777,true);
            }
                if(move_uploaded_file($_FILES['imagos']['tmp_name'], $target_dir."/".rand()."_".time().".jpeg")){
                    $MESSAGE['Pesan']="Sukses !! Upload Foto Berhasil";
                    $MESSAGE['URLFOLDER']=$target_dir."/".rand()."_".time().".jpeg";
                    $MESSAGE['kode']=1;

                }else{
                    $MESSAGE['GAGAL']="Sorry !! Upload Foto GAGAL";
                    $MESSAGE['kode']=0;
                }

        echo json_encode($MESSAGE);
    }
}
