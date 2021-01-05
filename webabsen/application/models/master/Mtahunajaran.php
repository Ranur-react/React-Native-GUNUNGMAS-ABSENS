<?php
class Mtahunajaran extends CI_Model
{
	protected $tabel = 'tahun_ajaran';
	public function getall()
	{
		return $this->db->get($this->tabel)->result_array();
	}
	public function store($params)
	{
		$data = [
			'nama_tahun'   => $params['nama'],
			'status_tahun' => 0
		];
		return $this->db->insert($this->tabel, $data);
	}
	public function shows($kode)
	{
		return $this->db->where('id_tahun', $kode)->get($this->tabel)->row_array();
	}
	public function update($params)
	{
		$kode = $params['kode'];
		$data = [
			'nama_tahun'   => $params['nama'],
		];
		return $this->db->where('id_tahun', $kode)->update($this->tabel, $data);
	}
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_tahun='$kode'");
	}
	public function status($kode)
	{
		$data = $this->shows($kode);
		if ($data['status_tahun'] == '1') {
			$this->db->query("UPDATE " . $this->tabel . " SET status_tahun='0' WHERE id_tahun='$kode'");
		} else {
			$this->db->query("UPDATE " . $this->tabel . " SET status_tahun='0'");
			$this->db->query("UPDATE " . $this->tabel . " SET status_tahun='1' WHERE id_tahun='$kode'");
		}
	}
}
