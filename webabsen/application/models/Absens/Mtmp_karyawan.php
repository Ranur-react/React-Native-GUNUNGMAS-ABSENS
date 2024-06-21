<?php
class Mtmp_karyawan extends CI_Model
{
	protected $tabel = 'tmp_karyawan';
	public function getall()
	{
		$this->db->from($this->tabel);
		return $this->db->get()->result_array();
	}
	public function store($params)
	{
		return $this->db->query("INSERT INTO `tmp_karyawan`  SELECT*FROM `karyawan` WHERE `id_karyawan`='$params'; ");
	}
	public function shows($kode)
	{
		return $this->db->where('id_karyawan_tmp', $kode)->get($this->tabel)->row_array();
	}

	public function destroy($kode)
	{

		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_karyawan_tmp='$kode'");
	
	}
}
