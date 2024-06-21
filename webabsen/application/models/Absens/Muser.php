<?php
class Muser extends CI_Model
{
	protected $tabel = 'user';
	public function getall()
	{
		return $this->db->get($this->tabel)->result_array();
	}
	public function get_karyawan()
	{
		$this->db->from('karyawan');
		$this->db->join('absen_masuk', 'id_karyawan=id_karyawan_masuk');
		$this->db->where("id_karyawan NOT IN (select kode_user from user where level_user='2')");
		return $this->db->get()->result_array();
	}
	
	public function level()
	{
		$data = array(
			'1' => 'Admin',
			'2' => 'Pemilik Toko',
			'3' => 'Kepala Toko',
			'4' => 'Karyawan'
		);
		return $data;
	}
	public function store($params)
	{
		if ($params['level'] == '1')
			$kode = '0';
		else
			$kode = $params['kode'];
		$data = [
			'kode_user'   => $kode,
			'email'       => $params['email'],
			'password'    => md5($params['password']),
			'level_user'  => $params['level'],
			'status_user' => 1
		];
		$this->db->set('created_at', 'NOW()', FALSE);
		return $this->db->insert($this->tabel, $data);
	}
	public function show($kode)
	{
		return $this->db->where('id_user', $kode)->get($this->tabel)->row_array();
	}
	public function show_nama($kode)
	{
		$data = $this->show($kode);
		if ($data['level_user'] == '1') {
			$nama = 'Admin';
		} else if ($data['level_user'] == '2') {
			$nama = 'Admin';
		} else if ($data['level_user'] == '3') {
			$nama = 'Admin';
		} else if ($data['level_user'] == '4') {
			$query = $this->db->where('id_karyawan', $data['kode_user'])->get('karyawan')->row_array();
			$nama = $query['nama_karyawan'];
		} 
		return $nama;
	}
	public function update($param)
	{
		$kode = $param['kode'];
		if (empty($param['password'])) {
			$data = [
				'email' => $param['email'],
			];
		} else {
			$data = [
				'email' => $param['email'],
				'password' => md5($param['password'])
			];
		}
		return $this->db->where('id_user', $kode)->update($this->tabel, $data);
	}
	public function status($kode)
	{
		$data = $this->show($kode);
		if ($data['status_user'] == '1') {
			$this->db->query("UPDATE " . $this->tabel . " SET status_user='0' WHERE id_user='$kode'");
		} else {
			$this->db->query("UPDATE " . $this->tabel . " SET status_user='1' WHERE id_user='$kode'");
		}
	}
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_user='$kode'");
	}
}
