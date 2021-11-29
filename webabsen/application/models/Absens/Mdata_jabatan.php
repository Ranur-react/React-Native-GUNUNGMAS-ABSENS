<?php
class Mdata_jabatan extends CI_Model
{
    protected $tabel = 'tb_jabatan';
    public function getall()
    {
        $this->db->from($this->tabel);
        return $this->db->get()->result_array();
    }

    public function shows($kode)
    {
        return $this->db->where('id_jabatan', $kode)->get($this->tabel)->row_array();
    }

    public function tampildata()
    {
        return $this->db->query("SELECT * FROM tb_jabatan;")->result_array();
    }
    public function store($params)
    {
        $data = [
            'id_jabatan' => $params['id'],
            'nama_jabatan' => $params['namakaryawan'],
            'gapok' => $params['gapok'],
            'tunjangan_disiplin' => $params['tunjangan'],
            'potongan_disiplin' => $params['potongan'],
        ];
        $jabatan = $this->db->insert($this->tabel, $data);
        return array($jabatan);
    }
}
