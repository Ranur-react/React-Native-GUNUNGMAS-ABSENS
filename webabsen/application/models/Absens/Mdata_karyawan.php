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
		$karyawan= $this->db->insert($this->tabel, $data);

		$data_user = [
			'kode_user' => $params['idkaryawan'],
			'email' => $params['email'],
			'password' => md5('123'),
			'level_user' => '2',
			'status_user' => '1',
		];
		$this->db->set('created_at', 'NOW()', FALSE);
		$user= $this->db->insert('user',$data_user);
		return array($karyawan,$user);
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
