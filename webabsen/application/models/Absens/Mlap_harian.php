<?php
class Mlap_harian extends CI_Model
{
	protected $tabel = 'karyawan';
	public function getall()
	{

		return $this->db->query("SELECT *
FROM karyawan
JOIN absen_masuk ON id_karyawan=id_karyawan_masuk
LEFT JOIN  absen_keluar ON id_karyawan=id_karyawan_keluar
GROUP BY `id_absen_masuk`
		")->result_array();
	}

	public function shows($param)
	{
		$dateStart = date("Y-m-d", strtotime($param['awal']));


		return $this->db->query("SELECT `nama_karyawan`,`tanggal_masuk` AS tanggal,jam_masuk,jam_keluar,foto_masuk,foto_keluar,status_kehadiran,`surat_izinnya`,`surat_sakitnya`
FROM karyawan
JOIN `detail_jadwal` ON `id_karyawan_detail`=`id_karyawan` 
LEFT JOIN absen_masuk ON `id_set_jadwal_Masuk`=`id_jadwal_detail`
LEFT JOIN `absen_keluar` ON `id_set_jadwal_keluar`=`id_karyawan_detail`
LEFT JOIN `surat_izin` ON `id_karyawan_izin`=`id_karyawan_detail`
LEFT JOIN `surat_sakit` ON `id_karyawan_sakit`=`id_karyawan_detail`
WHERE tanggal ='$dateStart' AND status_kehadiran!='0'
GROUP BY id_karyawan_detail
ORDER BY tanggal DESC
")->result_array();
	}

	public function tampildata()
	{
		return $this->db->query("SELECT nama_karyawan,tanggal_masuk,jam_masuk,foto_masuk,jam_keluar,foto_keluar,ket FROM karyawan
JOIN absen_masuk ON id_karyawan=id_karyawan_masuk
JOIN absen_keluar ON id_karyawan=id_karyawan_keluar WHERE tanggal_masuk='$dateStart';")->result_array();
	}
}
