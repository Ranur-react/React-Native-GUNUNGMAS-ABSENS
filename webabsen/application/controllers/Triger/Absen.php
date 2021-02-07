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
        $this->load->model('Absens/Mabsen_pulang');
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
        $MESSAGE['POST>']=$_POST;

        $target_dir = "AsetKaryawan_Foto/FotoAbsen".$_POST['StatusAbsen']."/".$_POST['NamaKaryawan'];
        $RANDO_val=rand();
        $URI= $target_dir."/".$RANDO_val."-".$_POST['StatusAbsen']."_".date('Y-m-d').".jpeg";


        //REVERAL ENROLMENT FOR INSERT
            $ID="ABK-".$_POST['ID']."-".$RANDO_val;
            $IDKARYAWAN=$_POST['ID'];
            $IDJADWAL=$_POST['id_jadwal'];
            $JAM=$_POST['jam_Capture'];
            $LA=$_POST['la'];
            $LO=$_POST['lo'];
            $Displin=$_POST['Displin'];
            $FOTO=base_url().$URI;


        //




            if (!file_exists($target_dir)) {
                mkdir($target_dir,777,true);
            }
                if(move_uploaded_file($_FILES['imagos']['tmp_name'],$URI)){
                        if ($_POST['StatusAbsen'] == "Masuk") {
                                        //Input Data Masuk-----------
                            $this->db->query("INSERT INTO `absen_masuk` VALUES ('$ID', '$IDKARYAWAN', '$IDJADWAL','$JAM',NOW(),'$LA','$LO','$FOTO','HADIR'); ");
                            $this->db->query("UPDATE `db_pklabsensi`.`detail_jadwal` SET `status_kehadiran` = '1' , `status_displin` = '$Displin' WHERE `id_jadwal_detail` = '$IDJADWAL' AND `id_karyawan_detail` = '$IDKARYAWAN' AND `tanggal` = DATE_FORMAT(NOW(), '%Y-%m-%d');");
                            $MESSAGE['Respond']=true;


                        }elseif ($_POST['StatusAbsen'] == "Pulang") {
                            $this->db->query("INSERT INTO `absen_keluar` VALUES ('$ID', '$IDKARYAWAN', '$IDJADWAL','$JAM',NOW(),'$LA','$LO','$FOTO'); ");
                                       
                            $MESSAGE['Respond']=true;

                        }else{
                            $MESSAGE['Respond']=false;

                        }

                        // if ($_POST['StatusAbsen'] =="Pulang") {
                        //     $this->db->query("INSERT INTO `absen_keluar` VALUES ('$ID', '$IDKARYAWAN', '$IDJADWAL','$JAM',NOW(),'$LA','$LO','$FOTO'); ");
                        //     # code...
                        //                         $MESSAGE['Pesan']="Sukses !! Upload Foto Masuk Berhasil";
                        //                         $MESSAGE['kode']=1;
                        //                         $MESSAGE['Respond']=true;
                        // }elseif ($_POST['StatusAbsen'] =="Masuk") {
                        //     //Input Data Masuk-----------
                        //     $this->db->query("INSERT INTO `absen_masuk` VALUES ('$ID', '$IDKARYAWAN', '$IDJADWAL','$JAM',NOW(),'$LA','$LO','$FOTO'); ");
                        //     //Input data kehadiran dan displin
                        //     $this->db->query("UPDATE `db_pklabsensi`.`detail_jadwal` SET `status_kehadiran` = '1' , `status_displin` = '$Displin' WHERE `id_jadwal_detail` = '$IDJADWAL' AND `id_karyawan_detail` = '$IDKARYAWAN' AND `tanggal` = DATE_FORMAT(NOW(), '%Y-%m-%d');");
                        //     $MESSAGE['Pesan']="Sukses !! Upload Foto Pulang Berhasil";
                        //                         $MESSAGE['kode']=1;
                        //                         $MESSAGE['Respond']=true;
                        // }else{
                        //                         $MESSAGE['Pesan']="Gagal !! Periksa Jadwal mu lebih baik lagi";
                        //                         $MESSAGE['kode']=0;
                        //                         $MESSAGE['Respond']=false;
                        // }




                }else{
                    $MESSAGE['Respond']=false;
                    $MESSAGE['GAGAL']="Sorry !! Upload Foto GAGAL";
                    $MESSAGE['kode']=0;
                }

        echo json_encode($MESSAGE);
    }
}
