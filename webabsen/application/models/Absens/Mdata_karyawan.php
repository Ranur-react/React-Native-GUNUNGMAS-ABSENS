<?php
class Mdata_karyawan extends CI_Model
{
	protected $tabel = 'karyawan';
	protected $tabeluser = 'user';
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
			'jabatan_id' => $params['jabatan'],
		];
		$karyawan = $this->db->insert($this->tabel, $data);

		$data_user = [
			'kode_user' => $params['idkaryawan'],
			'email' => $params['email'],
			'password' => md5('123'),
			'level_user' => '4',
			'status_user' => '1',
		];
		$this->db->set('created_at', 'NOW()', FALSE);
		$user = $this->db->insert('user', $data_user);
		return array($karyawan, $user);
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
		$this->db->simple_query("DELETE FROM " . $this->tabeluser . " WHERE kode_user='$kode'");

		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_karyawan='$kode'");
	}

	public function tampildata()
	{
		return $this->db->query("SELECT * FROM karyawan;")->result_array();
	}
}
