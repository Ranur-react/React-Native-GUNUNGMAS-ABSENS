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


		return $this->db->query("SELECT nama_karyawan,tanggal_masuk,jam_masuk,foto_masuk,jam_keluar,foto_keluar,ket FROM karyawan
JOIN absen_masuk ON id_karyawan=id_karyawan_masuk
JOIN absen_keluar ON id_karyawan=id_karyawan_keluar WHERE tanggal_masuk='$dateStart';")->result_array();
	}

	public function tampildata()
	{
		return $this->db->query("SELECT nama_karyawan,tanggal_masuk,jam_masuk,foto_masuk,jam_keluar,foto_keluar,ket FROM karyawan
JOIN absen_masuk ON id_karyawan=id_karyawan_masuk
JOIN absen_keluar ON id_karyawan=id_karyawan_keluar WHERE tanggal_masuk='$dateStart';")->result_array();
	}
}
