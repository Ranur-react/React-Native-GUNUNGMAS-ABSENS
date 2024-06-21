<?php
class Mwaktu_absensi extends CI_Model
{
	protected $tabel = 'set_waktu_absens';
	public function getall()
	{
		$this->db->from($this->tabel);
		return $this->db->get()->result_array();
	}
	public function store($params)
	{
		$data = [
			'id_waktu' => $params['idwaktu'],
			'ket_waktu' => $params['ketwaktu'],
			'waktu_mulai_masuk' => $params['waktumulaimasuk'],
			'waktu_selesai_masuk' => $params['waktuselesaimasuk'],
			'toleransi' => $params['toleransi'],
			'waktu_mulai_keluar' => $params['waktumulaikeluar'],
			'waktu_selesai_keluar' => $params['waktuselesaikeluar'],
		];
		return $this->db->insert($this->tabel, $data);
	}
	public function shows($kode)
	{
		return $this->db->where('id_waktu', $kode)->get($this->tabel)->row_array();
	}
	public function update($params)
	{
		$kode = $params['kode'];
		$data = [
			'id_waktu' => $params['idwaktu'],
			'ket_waktu' => $params['ketwaktu'],
			'waktu_mulai_masuk' => $params['waktumulaimasuk'],
			'waktu_selesai_masuk' => $params['waktuselesaimasuk'],
			'toleransi' => $params['toleransi'],
			'waktu_mulai_keluar' => $params['waktumulaikeluar'],
			'waktu_selesai_keluar' => $params['waktuselesaikeluar'],
		];
		return $this->db->where('id_waktu', $kode)->update($this->tabel, $data);
	}
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_waktu='$kode'");
	}
}
