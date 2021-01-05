<?php
class MSiswa extends CI_Model
{
	protected $tabel = 'siswa';
	public function getall()
	{
		$this->db->from($this->tabel);
		$this->db->join('jurusan', 'id_jurusan=jurusan_siswa');
		return $this->db->get()->result_array();
	}
	public function store($params)
	{
		$data = [
			'nisn_siswa'   		 => $params['nisn'],
			'nama_siswa'   		 => $params['nama'],
			'tempatlahir_siswa'  => $params['tempat_lahir'],
			'tanggallahir_siswa' => date("Y-m-d", strtotime($params['tanggal_lahir'])),
			'jenkel_siswa'   	 => $params['jenis_kelamin'],
			'agama_siswa'   	 => $params['agama'],
			'alamat_siswa'   	 => $params['alamat'],
			'jurusan_siswa'   	 => $params['jurusan'],
			'hp_siswa'   		 => $params['nohp'],
		];
		return $this->db->insert($this->tabel, $data);
	}
	public function shows($kode)
	{
		return $this->db->where('id_siswa', $kode)->get($this->tabel)->row_array();
	}
	public function update($params)
	{
		$kode = $params['kode'];
		$data = [
			'nisn_siswa'   		 => $params['nisn'],
			'nama_siswa'   		 => $params['nama'],
			'tempatlahir_siswa'  => $params['tempat_lahir'],
			'tanggallahir_siswa' => date("Y-m-d", strtotime($params['tanggal_lahir'])),
			'jenkel_siswa'   	 => $params['jenis_kelamin'],
			'agama_siswa'   	 => $params['agama'],
			'alamat_siswa'   	 => $params['alamat'],
			'jurusan_siswa'   	 => $params['jurusan'],
			'hp_siswa'   		 => $params['nohp'],
		];
		return $this->db->where('id_siswa', $kode)->update($this->tabel, $data);
	}
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_siswa='$kode'");
	}
	public function agama()
	{
		$data = array(
			'Islam',
			'Kristen',
			'Katolik',
			'Hindu',
			'Buddha',
			'Kong Hucu',
			'Lainnya'
		);
		return $data;
	}
}
