<?php
class MJurusan extends CI_Model
{
	protected $tabel = 'jurusan';
	public function getall()
	{
		return $this->db->get($this->tabel)->result_array();
	}
	public function store($params)
	{
		$data = [
			'nama_jurusan'   => $params['nama']
		];
		return $this->db->insert($this->tabel, $data);
	}
	public function shows($kode)
	{
		return $this->db->where('id_jurusan', $kode)->get($this->tabel)->row_array();
	}
	public function update($params)
	{
		$kode = $params['kode'];
		$data = [
			'nama_jurusan'   => $params['nama'],
		];
		return $this->db->where('id_jurusan', $kode)->update($this->tabel, $data);
	}
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_jurusan='$kode'");
	}
}
