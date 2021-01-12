<?php
class Mlokasi_absensi extends CI_Model
{
	protected $tabel = 'set_lokasi';
	public function getall()
	{
		$this->db->from($this->tabel);
		return $this->db->get()->result_array();
	}
	public function store($params)
	{
		$data = [
			'id_set_lokasi' => $params['idlokasi'],
			'latitude' => $params['latitude'],
			'longitude' => $params['longitude'],
			'lokasi' => $params['lokasi'],
		];
		return $this->db->insert($this->tabel, $data);
	}
	public function shows($kode)
	{
		return $this->db->where('id_set_lokasi', $kode)->get($this->tabel)->row_array();
	}
	public function update($params)
	{
		$kode = $params['kode'];
		$data = [
			'id_set_lokasi' => $params['idlokasi'],
			'latitude' => $params['latitude'],
			'longitude' => $params['longitude'],
			'lokasi' => $params['lokasi'],
		];
		return $this->db->where('id_set_lokasi', $kode)->update($this->tabel, $data);
	}
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_set_lokasi='$kode'");
	}
}
