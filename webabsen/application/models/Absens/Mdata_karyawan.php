<?php
class Mdata_karyawan extends CI_Model
{
	protected $tabel = 'karyawan';
	public function getall()
	{
		$this->db->from($this->tabel);
		return $this->db->get()->result_array();
	}
	public function store($params)
	{
		$data = [
			'id_karyawan' => $params['idkaryawan'],
			'nama_karyawan' => $params['namakaryawan'],
			'email' => $params['email'],
			'nohp' => $params['nohp'],
			'alamat' => $params['alamat'],
		];
		return $this->db->insert($this->tabel, $data);
	}
	public function shows($kode)
	{
		return $this->db->where('id_karyawan', $kode)->get($this->tabel)->row_array();
	}
	public function update($params)
	{
		$kode = $params['kode'];
		$data = [
			'id_karyawan' => $params['idkaryawan'],
			'nama_karyawan' => $params['namakaryawan'],
			'email' => $params['email'],
			'nohp' => $params['nohp'],
			'alamat' => $params['alamat'],
		];
		return $this->db->where('id_karyawan', $kode)->update($this->tabel, $data);
	}
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_karyawan='$kode'");
	}
}
