<?php
class Mlap_harian extends CI_Model
{
	protected $tabel = 'karyawan';
	public function getall()
	{
		$this->db->from($this->tabel);
		$this->db->join('absen_masuk', 'id_karyawan=id_karyawan_masuk');
		$this->db->join('absen_keluar', 'id_karyawan=id_karyawan_keluar');
		return $this->db->get()->result_array();
	}
	
	public function shows($param)
	{
			$dateStart=date("Y-m-d", strtotime($param['awal']));


		return $this->db->query("SELECT `nama_karyawan`,tanggal,


(
SELECT `jam_masuk` FROM `absen_masuk` WHERE `id_set_jadwal_Masuk`=id_jadwal AND `id_karyawan_detail`=id_karyawan_masuk AND tanggal_masuk ='$dateStart'
)AS jam_masuk,

(
SELECT `foto_masuk` FROM `absen_masuk` WHERE `id_set_jadwal_Masuk`=id_jadwal AND `id_karyawan_detail`=id_karyawan_masuk AND tanggal_masuk ='$dateStart'
)AS foto_masuk,
 
 (
SELECT `jam_keluar` FROM `absen_keluar` WHERE `id_set_jadwal_keluar`=id_jadwal AND `id_karyawan_detail`=id_karyawan_keluar AND tanggal_keluar ='$dateStart'
)AS jam_keluar,

 (
SELECT foto_keluar FROM `absen_keluar` WHERE `id_set_jadwal_keluar`=id_jadwal AND `id_karyawan_detail`=id_karyawan_keluar AND tanggal_keluar ='$dateStart'
)AS foto_keluar, 


status_kehadiran

FROM `jadwal_absen_karyawan` 
				JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
				JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
				JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi` WHERE tanggal='$dateStart'
				GROUP BY `id_karyawan`;")->result_array();
	}

	public function tampildata()
	{
		return $this->db->query("SELECT nama_karyawan,tanggal_masuk,jam_masuk,foto_masuk,jam_keluar,foto_keluar,ket FROM karyawan
JOIN absen_masuk ON id_karyawan=id_karyawan_masuk
JOIN absen_keluar ON id_karyawan=id_karyawan_keluar WHERE tanggal_masuk='$dateStart';")->result_array();
	}
}
