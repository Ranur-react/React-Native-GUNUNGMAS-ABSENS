<?php
class Mabsen_masuk extends CI_Model
{
	protected $tabel = 'absen_masuk';
	public function getall()
	{
		$this->db->from($this->tabel);
		return $this->db->get()->result_array();
	}
	
	public function shows($kode)
	{
		return $this->db->where('id_absen_masuk', $kode)->get($this->tabel)->row_array();
	}
	
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_absen_masuk='$kode'");
	}
}
