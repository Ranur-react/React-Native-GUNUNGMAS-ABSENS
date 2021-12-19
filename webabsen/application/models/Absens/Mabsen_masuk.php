<?php
class Mabsen_masuk extends CI_Model
{
	protected $tabel = 'karyawan';
	public function getall()
	{
		$this->db->from($this->tabel);
		$this->db->join('absen_masuk', 'id_karyawan=id_karyawan_masuk');
		$this->db->join('jadwal_absen_karyawan', 'id_jadwal=id_set_jadwal_masuk');
		$this->db->join('set_waktu_absens', 'id_waktu=id_shift_absensi');
		return $this->db->get()->result_array();
	}

	public function getallHistoryMasuk($id)
	{
		// $this->db->from($this->tabel);
		// $this->db->join('absen_masuk', 'id_karyawan=id_karyawan_masuk');
		// $this->db->join('jadwal_absen_karyawan', 'id_jadwal=id_set_jadwal_masuk');
		// $this->db->join('set_waktu_absens', 'id_waktu=id_shift_absensi');
		// $this->db->join('set_lokasi', 'id_lokasi_absensi=id_set_lokasi');
		// $this->db->where('id_karyawan' , $id);
		return $this->db->query("SELECT*,
IF (status_kehadiran='1','pulang',IF(status_kehadiran='m','masuk',NULL)) AS absenHadir
FROM karyawan
JOIN `detail_jadwal` ON `id_karyawan_detail`=`id_karyawan`
JOIN jadwal_absen_karyawan ON id_jadwal=`id_jadwal_detail`
JOIN set_lokasi ON id_lokasi_absensi=id_set_lokasi 
JOIN absen_masuk ON `id_set_jadwal_Masuk`=`id_jadwal_detail`
LEFT JOIN `absen_keluar` ON `id_set_jadwal_keluar`=`id_jadwal`
WHERE   id_karyawan='$id' AND status_kehadiran!='0'
GROUP BY `tanggal`
ORDER BY `tanggal` DESC
")->result_array();
	}

	public function shows($kode)
	{
		return $this->db->query("SELECT nama_karyawan,tanggal_masuk,waktu_mulai_masuk,jam_masuk,foto_masuk FROM karyawan
JOIN absen_masuk ON  id_karyawan=id_karyawan_masuk
JOIN jadwal_absen_karyawan ON id_jadwal=id_set_jadwal_masuk
JOIN set_waktu_absens ON id_waktu=id_shift_absensi;")->result_array();
	}

	public function tampildata()
	{
		return $this->db->query("SELECT nama_karyawan,tanggal_masuk,waktu_mulai_masuk,jam_masuk,foto_masuk FROM karyawan
JOIN absen_masuk ON  id_karyawan=id_karyawan_masuk
JOIN jadwal_absen_karyawan ON id_jadwal=id_set_jadwal_masuk
JOIN set_waktu_absens ON id_waktu=id_shift_absensi;")->result_array();
	}

	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_absen_masuk='$kode'");
	}
}
