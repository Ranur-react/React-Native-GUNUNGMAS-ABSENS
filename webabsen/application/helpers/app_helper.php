<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('idtahun')) {
    function idtahun()
    {
        $CI = &get_instance();
        $result = $CI->db->get_where('tahun_ajaran', array('status_tahun' => 1))->row_array();
        $data = $result['id_tahun'];
        return $data;
    }
}
if (!function_exists('tahun_aktif')) {
    function tahun_aktif()
    {
        $CI     = &get_instance();
        $result = $CI->db->get_where('tahun_ajaran', array('status_tahun' => 1))->row_array();
        if ($result['nama_tahun'] == null) {
            $data   = 'Tahun Belum Aktif';
        } else {
            $data   = $result['nama_tahun'];
        }
        return $data;
    }
}
