<?php
class Mlap_bulanan extends CI_Model
{
	protected $tabel = 'jadwal_absen_karyawan';
	public function getall()
	{
		return $this->db->query("SELECT `id_karyawan`,`nama_karyawan`, `lokasi`,
				 
				(SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` != 'null'AND `status_kehadiran` != '0')
				 AS hadir,

				 (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 's')
				 AS sakit,
				 
				  (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 'i')
				 AS izin,
				 (SELECT COUNT(`status_displin`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` != 'null'AND `status_displin` = '0')
				 AS status_displin
				 FROM `jadwal_absen_karyawan` 
				JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
				JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
				JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
				GROUP BY `id_karyawan`;")->result_array();
	}
	
	public function showsSlips($kode,$empId)

	{
	$v=$kode;
	$a=$v.' month';
	$date = date_create('2020-12-01');
	date_add($date, date_interval_create_from_date_string($a));
	$d=date_format($date, 'Y-m');
		return $this->db->query("SELECT `id_karyawan`,`nama_karyawan`, `lokasi`,`nama_jabatan`,
				 
				(SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` != 'null'AND `status_kehadiran` != '0' )
				 AS hadir,

				 (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 's')
				 AS sakit,
				 
				  (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 'i')
				 AS izin,
				 (SELECT COUNT(`status_displin`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_displin` != 'null' AND `status_displin` = '0')
				 AS status_displin,
				 tanggal,
				 `rentangSet`,
				`tb_jabatan`.`gapok` AS gapok,
				`tb_jabatan`.`tunjangan_disiplin` AS tdisplin,
				`tb_jabatan`.`potongan_disiplin` AS pdisplin
				 FROM `jadwal_absen_karyawan` 
				JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
				JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
				JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
				JOIN `tb_jabatan` ON `tb_jabatan`.`id_jabatan`=karyawan.`jabatan_id`
				WHERE  MONTH(tanggal)='$v' and id_karyawan='$empId'
				GROUP BY `id_karyawan`")->result_array();
	}
	public function shows($kode)

	{
		$v = $kode['PilBulan'];
		$a = $v . ' month';
		$date = date_create('2020-12-01');
		date_add($date, date_interval_create_from_date_string($a));
		$d = date_format($date, 'Y-m');
		return $this->db->query("SELECT `id_karyawan`,`nama_karyawan`, `lokasi`,`nama_jabatan`,
				 
				(SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` != 'null'AND `status_kehadiran` != '0' )
				 AS hadir,

				 (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 's')
				 AS sakit,
				 
				  (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 'i')
				 AS izin,
				 (SELECT COUNT(`status_displin`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_displin` != 'null' AND `status_displin` = '0')
				 AS status_displin,
				 tanggal,
				`rentangSet`,
				`tb_jabatan`.`gapok` AS gapok,
				`tb_jabatan`.`tunjangan_disiplin` AS tdisplin,
				`tb_jabatan`.`potongan_disiplin` AS pdisplin
				 FROM `jadwal_absen_karyawan` 
				JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
				JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
				JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
				JOIN `tb_jabatan` ON `tb_jabatan`.`id_jabatan`=karyawan.`jabatan_id`
				WHERE  MONTH(tanggal)='$v' 
				GROUP BY `id_karyawan`")->result_array();
	}

	public function tampildata()
	{
		return $this->db->query("SELECT `id_karyawan`,`nama_karyawan`, `lokasi`,
 
(SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = '1')
 AS hadir,

 (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 's')
 AS sakit,
 
  (SELECT COUNT(`status_kehadiran`) FROM `detail_jadwal` WHERE `id_karyawan`=`id_karyawan_detail` AND `status_kehadiran` = 'i')
 AS izin
 
 FROM `jadwal_absen_karyawan` 
JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
GROUP BY `id_karyawan`;")->result_array();
	}
}
