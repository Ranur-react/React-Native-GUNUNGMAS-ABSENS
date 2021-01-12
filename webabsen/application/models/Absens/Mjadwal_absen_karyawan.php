<?php
class Mjadwal_absen_karyawan extends CI_Model
{
	protected $tabel = 'jadwal_absen_karyawan';
	public function getall()
	{
		$this->db->from($this->tabel);
		$this->db->join('set_waktu_absens', 'id_waktu=id_shift_absensi');
		$this->db->join('set_lokasi', 'id_set_lokasi=id_lokasi_absensi');
		$this->db->join('karyawan', 'id_karyawan=id_karyawan_absensi');
		return $this->db->get()->result_array();
	}
	public function store($params)
	{
		$data = [
			'id_jadwal'   		 => $params['idjadwal'],
			'rentang_tanggal' => date("Y-m-d", strtotime($params['rentang'])),
			'id_shift_absensi'  => $params['shift'],
			'id_lokasi_absensi'   	 => $params['lokasi'],
			'id_karyawan_absensi'   	 => $params['karyawan'],
		];
		return $this->db->insert($this->tabel, $data);
	}
	public function shows($kode)
	{
		return $this->db->where('id_jadwal', $kode)->get($this->tabel)->row_array();
	}
	public function update($params)
	{
		$kode = $params['kode'];
		$data = [
			'id_jadwal'   		 => $params['idjadwal'],
			'rentang_tanggal' => date("Y-m-d", strtotime($params['rentang'])),
			'id_shift_absensi'  => $params['shift'],
			'id_lokasi_absensi'   	 => $params['lokasi'],
			'id_karyawan_absensi'   	 => $params['karyawan'],
		];
		return $this->db->where('id_jadwal', $kode)->update($this->tabel, $data);
	}
	public function destroy($kode)
	{
		return $this->db->simple_query("DELETE FROM " . $this->tabel . " WHERE id_jadwal='$kode'");
	}
	
}
