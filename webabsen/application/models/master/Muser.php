<?php
class Muser extends CI_Model
{
	protected $tabel = 'user';
	public function getall()
	{
		return $this->db->get($this->tabel)->result_array();
	}
	public function get_guru()
	{
		$this->db->from('guru');
		$this->db->join('matapelajaran', 'bidangstudiguru=idmapel');
		$this->db->where("idguru NOT IN (select kode_user from user where level_user='2')");
		return $this->db->get()->result_array();
	}
	public function get_siswa()
	{
		$this->db->from('siswa');
		$this->db->join('jurusan', 'id_jurusan=jurusan_siswa');
		$this->db->where("id_siswa NOT IN (select kode_user from user where level_user='3')");
		return $this->db->get()->result_array();
	}
	public function level()
	{
		$data = array(
			'1' => 'Admin',
			'2' => 'Guru',
			'3' => 'Siswa'
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
			$query = $this->db->where('idguru', $data['kode_user'])->get('guru')->row_array();
			$nama = $query['namaguru'];
		} else if ($data['level_user'] == '3') {
			$query = $this->db->where('id_siswa', $data['kode_user'])->get('siswa')->row_array();
			$nama = $query['nama_siswa'];
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
