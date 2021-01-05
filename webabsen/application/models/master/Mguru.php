<?php
class Mguru extends CI_Model
{
	protected $tabel = 'guru';
	public function getall()
	{
		$this->db->from($this->tabel);
		$this->db->join('matapelajaran', 'bidangstudiguru=idmapel');
		return $this->db->get()->result_array();
	}
	public function store($params)
	{
		$data = [
			'nipguru' => $params['nip'],
			'namaguru' => $params['namaguru'],
			'tempatlahirguru' => $params['tempatlahir'],
			'tanggallahirguru' => date("Y-m-d", strtotime($params['tanggallahir'])),
			'jenkelguru' => $params['jeniskelamin'],
			'agamaguru' => $params['agama'],
			'alamatguru' => $params['alamat'],
			'bidangstudiguru' => $params['bidangstudi'],
			'hpguru' => $params['nohp'],
		];
		return $this->db->insert($this->tabel, $data);
	}
	public function shows($kode)
	{
		return $this->db->where('idguru', $kode)->get($this->tabel)->row_array();
	}
	public function update($params)
	{
		$kode = $params['kode'];
		$data = [
			'nipguru' => $params['nip'],
			'namaguru' => $params['namaguru'],
			'tempatlahirguru' => $params['tempatlahir'],
			'tanggallahirguru' => date("Y-m-d", strtotime($params['tanggallahir'])),
			'jenkelguru' => $params['jeniskelamin'],
			'agamaguru' => $params['agama'],
			'alamatguru' => $params['alamat'],
			'bidangstudiguru' => $params['bidangstudi'],
			'hpguru' => $params['nohp'],
		];
		return $this->db->where('idguru', $kode)->update($this->tabel, $data);
	}
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE idguru='$kode'");
	}
}
