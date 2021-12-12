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
	public function Simpanke($value = '')
	{
		# code...
	}
	public function index()
	{
		$MESSAGE['Respon-------------Awal>'] = "..........................";
		$obj = file_get_contents('php://input');
		$objSon = json_decode($obj, true);
		$MESSAGE['POST>'] = $_POST;

		$target_dir = "AsetKaryawan_Foto/FotoAbsen" . $_POST['StatusAbsen'] . "/" . $_POST['NamaKaryawan'];
		$RANDO_val = rand();
		$URI = $target_dir . "/" . $RANDO_val . "-" . $_POST['StatusAbsen'] . "_" . date('Y-m-d') . ".jpeg";


		//REVERAL ENROLMENT FOR INSERT
		$ID = "ABK-" . $_POST['ID'] . "-" . $RANDO_val;
		$IDKARYAWAN = $_POST['ID'];
		$IDJADWAL = $_POST['id_jadwal'];
		$JAM = $_POST['jam_Capture'];
		$LA = $_POST['la'];
		$LO = $_POST['lo'];
		$Displin = $_POST['Displin'];
		$FOTO = base_url() . $URI;


		//




		if (!file_exists($target_dir)) {

			if (mkdir($target_dir, 777, true)) {
				$MESSAGE['dirCreateInfo'] = "berhasil Membuat Folder Baru";
			} else {
				$MESSAGE['dirCreateInfo'] = "Gagal Membuat Folder Baru";
			}
		} else {
			$MESSAGE['dirCreateInfo'] = "Folder sudah ada";
		}
		if (move_uploaded_file($_FILES['imagos']['tmp_name'], $URI)) {
			// if ($_POST['StatusAbsen'] == "Masuk") {
			// 	//Input Data Absen Masuk-----------
			// 	$this->db->query("INSERT INTO `absen_masuk` VALUES ('$ID', '$IDKARYAWAN', '$IDJADWAL','$JAM',NOW(),'$LA','$LO','$FOTO','HADIR'); ");

			// 	$this->db->query("UPDATE `detail_jadwal` SET `status_kehadiran` = 'm' , `status_displin` = '$Displin' WHERE `id_jadwal_detail` = '$IDJADWAL' AND `id_karyawan_detail` = '$IDKARYAWAN' AND `tanggal` = DATE_FORMAT(NOW(), '%Y-%m-%d');");

			// 	$MESSAGE['Respond'] = true;
			// } else {
			// 	//                                         //Input Data Absen Pulang-----------

			// 	$this->db->query("INSERT INTO `absen_keluar` VALUES ('$ID', '$IDKARYAWAN', '$IDJADWAL','$JAM',NOW(),'$LA','$LO','$FOTO'); ");
			// 	$this->db->query("UPDATE `detail_jadwal` SET `status_kehadiran` = '1'  WHERE `id_jadwal_detail` = '$IDJADWAL' AND `id_karyawan_detail` = '$IDKARYAWAN' AND `tanggal` = DATE_FORMAT(NOW(), '%Y-%m-%d');");

			// 	$MESSAGE['Respond'] = true;
			// }




			// $MESSAGE['pesan'] = "Mantap Upload Foto berhasil";
		} else {
			$MESSAGE['pesan'] = false;
			$MESSAGE['GAGAL'] = "Sorry !! Upload Foto GAGAL";
			$MESSAGE['kode'] = 0;
		}

		echo json_encode($MESSAGE);
	}
	public function Sakit()
	{
		$MESSAGE['Respon-------------Awal>'] = "..........................";
		$obj = file_get_contents('php://input');
		$objSon = json_decode($obj, true);
		$MESSAGE['POST>'] = $_POST;
		$MESSAGE['FILE>'] = $_FILES;



		$target_dir = "AsetKaryawan_DOKUMEN/SuratAbsen" . $_POST['StatusAbsen'] . "/" . $_POST['NamaKaryawan'];
		$RANDO_val = rand();
		$URI = $target_dir . "/" . $RANDO_val . "-" . $_POST['StatusAbsen'] . "_" . date('Y-m-d') . ".pdf";



		$ID = "DOC-" . $_POST['ID'] . "-" . $RANDO_val;
		$IDKARYAWAN = $_POST['ID'];
		$Status = $_POST['StatusAbsen'];
		$IDJADWAL = $_POST['id_jadwal'];
		$URL = base_url() . $URI;






		if (!file_exists($target_dir)) {
			mkdir($target_dir, 777, true);
		}


		if (move_uploaded_file($_FILES['Suratos']['tmp_name'], $URI)) {
			if ($_POST['StatusAbsen'] == "Sakit") {
				$this->db->query("INSERT INTO `surat_sakit` VALUES ('$ID', '$IDKARYAWAN',NOW(),'$Status','$URL'); ");


				$this->db->query("UPDATE `detail_jadwal` SET `status_kehadiran` = 's' WHERE `id_jadwal_detail` = '$IDJADWAL' AND `id_karyawan_detail` = '$IDKARYAWAN' AND `tanggal` = DATE_FORMAT(NOW(), '%Y-%m-%d');");

				$MESSAGE['Respond'] = true;
			} else if ($_POST['StatusAbsen'] == "Izin") {
				$this->db->query("INSERT INTO `surat_izin` VALUES ('$ID', '$IDKARYAWAN',NOW(),'$Status','$URL'); ");


				$this->db->query("UPDATE `detail_jadwal` SET `status_kehadiran` = 'i' WHERE `id_jadwal_detail` = '$IDJADWAL' AND `id_karyawan_detail` = '$IDKARYAWAN' AND `tanggal` = DATE_FORMAT(NOW(), '%Y-%m-%d');");
				$MESSAGE['Respond'] = true;
			} else {
				$MESSAGE['Respond'] = false;
			}
		} else {
			$MESSAGE['Respond'] = false;
			$MESSAGE['GAGAL'] = "Sorry !! Upload Foto GAGAL";
			$MESSAGE['kode'] = 0;
		}
		echo json_encode($MESSAGE);
	}
}
