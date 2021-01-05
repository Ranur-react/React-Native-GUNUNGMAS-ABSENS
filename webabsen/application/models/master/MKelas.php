<?php
class MKelas extends CI_Model
{
	protected $tabel = 'kelas';
	public function getall()
	{
		$this->db->from($this->tabel);
		$this->db->join('jurusan', 'id_jurusan=jurusan_kelas');
		return $this->db->get()->result_array();

		// return $this->db->get($this->tabel)->result_array();
	}
	public function store($params)
	{
		$data = [
			'nama_kelas'   	  => $params['nama'],
			'tingkatan_kelas' => $params['tingkat'],
			'jurusan_kelas'   => $params['jurusan'],
		];
		return $this->db->insert($this->tabel, $data);
	}
	public function shows($kode)
	{
		return $this->db->where('id_kelas', $kode)->get($this->tabel)->row_array();
	}
	public function update($params)
	{
		$kode = $params['kode'];
		$data = [
			'nama_kelas'   	  => $params['nama'],
			'tingkatan_kelas' => $params['tingkat'],
			'jurusan_kelas'   => $params['jurusan'],
		];
		return $this->db->where('id_kelas', $kode)->update($this->tabel, $data);
	}
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_kelas='$kode'");
	}
}
