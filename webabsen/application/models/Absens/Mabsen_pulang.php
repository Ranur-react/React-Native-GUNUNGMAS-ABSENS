<?php
class Mabsen_pulang extends CI_Model
{
	protected $tabel = 'karyawan';
	public function getall()
	{
		$this->db->from($this->tabel);
			$this->db->join('absen_keluar', 'id_karyawan=id_karyawan_keluar');
		$this->db->join('jadwal_absen_karyawan', 'id_jadwal=id_set_jadwal_keluar');
		$this->db->join('set_waktu_absens', 'id_waktu=id_shift_absensi');
		return $this->db->get()->result_array();
	}
	
	public function shows($kode)
	{
			return $this->db->query("SELECT nama_karyawan,tanggal_keluar,waktu_mulai_keluar,jam_keluar,foto_keluar FROM karyawan
JOIN absen_keluar ON  id_karyawan=id_karyawan_keluar
JOIN jadwal_absen_karyawan ON id_jadwal=id_set_jadwal_keluar
JOIN set_waktu_absens ON id_waktu=id_shift_absensi;")->result_array();
	}

		public function tampildata()
	{
		return $this->db->query("SELECT nama_karyawan,tanggal_keluar,waktu_mulai_keluar,jam_keluar,foto_keluar FROM karyawan
JOIN absen_keluar ON  id_karyawan=id_karyawan_keluar
JOIN jadwal_absen_karyawan ON id_jadwal=id_set_jadwal_keluar
JOIN set_waktu_absens ON id_waktu=id_shift_absensi;")->result_array();
	}
	
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_absen_keluar='$kode'");
	}
}
