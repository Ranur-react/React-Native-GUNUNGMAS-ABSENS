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
