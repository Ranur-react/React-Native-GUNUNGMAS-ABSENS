<?php
class Mlap_karyawan extends CI_Model
{
	protected $tabel = 'karyawan';
	public function getall()
	{
		return $this->db->query("SELECT * FROM karyawan JOIN `tb_jabatan` ON `id_jabatan`=jabatan_id;")->result_array();
	}
	
	public function shows($kode)
	{
		return $this->db->where('id_karyawan', $kode)->get($this->tabel)->row_array();
	}

	public function tampildata()
	{
		return $this->db->query("SELECT * FROM karyawan JOIN `tb_jabatan` ON `id_jabatan`=jabatan_id;")->result_array();
	}
}
