<?php
class Mabsen_pulang extends CI_Model
{
	protected $tabel = 'absen_keluar';
	public function getall()
	{
		$this->db->from($this->tabel);
		return $this->db->get()->result_array();
	}
	
	public function shows($kode)
	{
		return $this->db->where('id_absen_keluar', $kode)->get($this->tabel)->row_array();
	}
	
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_absen_keluar='$kode'");
	}
	public function insert($parm)
	{
		
		$this->db->query("INSERT INTO `db_pklabsensi`.`absen_keluar` VALUES ('idkeluar', 'K001', 'J001','jam',NOW(),'la','lo','fot'); ");
	}
}
