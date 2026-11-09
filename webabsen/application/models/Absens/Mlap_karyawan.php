<?php
class Mlap_karyawan extends CI_Model
{
	protected $tabel = 'karyawan';
	public function getall()
	{
		$this->db->from($this->tabel);
		return $this->db->get()->result_array();
	}
	
	public function shows($kode)
	{
		return $this->db->where('id_karyawan', $kode)->get($this->tabel)->row_array();
	}

	public function tampildata()
	{
		return $this->db->query("SELECT * FROM karyawan;")->result_array();
	}
}
