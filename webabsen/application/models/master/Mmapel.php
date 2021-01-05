<?php
class Mmapel extends CI_Model
{
	protected $tabel = 'matapelajaran';
	public function getall()
	{
		return $this->db->get($this->tabel)->result_array();
	}
	public function store($params)
	{
		$data = [
			'namamapel'   => $params['matapel'],
			'singkatanmapel'   => $params['singkatan'],
		];
		return $this->db->insert($this->tabel, $data);
	}
	public function shows($kode)
	{
		return $this->db->where('idmapel', $kode)->get($this->tabel)->row_array();
	}
	public function update($params)
	{
		$kode = $params['kode'];
		$data = [
			'namamapel'   => $params['matapel'],
			'singkatanmapel'   => $params['singkatan'],
		];
		return $this->db->where('idmapel', $kode)->update($this->tabel, $data);
	}
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE idmapel='$kode'");
	}
}
