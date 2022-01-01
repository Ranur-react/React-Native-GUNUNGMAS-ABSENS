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
if (!function_exists('rupiah')) {
    function rupiah($uang)
    {
        $format = number_format($uang, 0, ",", ".");
        return $format;
    }
}
if (!function_exists('alfaHitungBulanan')) {
	function alfaHitungBulanan($dateRange)
	{

		$dateStart = substr($dateRange, 0, 10);
		$dateStart = date("Y-m-d", strtotime($dateStart));

		$dateEndSet = substr($dateRange, 12);
		//echo (date("Y-m-d", strtotime($dateEndSet)) >  date("Y-m-d")) !=true; 
		$dateEnd = date("Y-m-d", strtotime($dateEndSet));


		$date1 = new DateTime($dateStart);
		$date2 = new DateTime($dateEnd);
		$interval = $date1->diff($date2);
		return $interval->days+1;
	}
}
if (!function_exists('alfaHitung')) {
	function alfaHitung($dateRange)
	{
	
		$dateStart = substr($dateRange, 0, 10);
		$dateStart = date("Y-m-d", strtotime($dateStart));

		$dateEndSet = substr($dateRange, 12);
		//echo (date("Y-m-d", strtotime($dateEndSet)) >  date("Y-m-d")) !=true; 
		if ((date("Y-m-d", strtotime($dateEndSet)) <=  date("Y-m-d")) != true) {
			$dateEnd = date("Y-m-d");
			//echo "alfa sampai tanggal skerang";
			//
		} else {
			//echo "alfa sampai tanggal terakhir";
			$dateEnd = date("Y-m-d", strtotime($dateEndSet));
		}
		

		$date1 = new DateTime($dateStart);
		$date2 = new DateTime($dateEnd);
		$interval = $date1->diff($date2);
		return $interval->days;
	}
}
if (!function_exists('alfaHitungMingguan')) {
	function alfaHitungMingguan($dateRange,$dateMax)
	{
		$dateStart = substr($dateRange, 0, 10);
		$dateStart = date("Y-m-d", strtotime($dateStart));

		$dateEndSet = substr($dateRange, 12);
		//echo (date("Y-m-d", strtotime($dateEndSet)) >  date("Y-m-d")) !=true; 
		if ((date("Y-m-d", strtotime($dateEndSet)) <=  date("Y-m-d", strtotime($dateMax))  ) != true) {
			$dateEnd = date("Y-m-d", strtotime($dateMax));
			//echo "alfa sampai tanggal skerang";
			//
		} else {
			//echo "alfa sampai tanggal terakhir";
			$dateEnd = date("Y-m-d", strtotime($dateEndSet));
		}


		$date1 = new DateTime($dateStart);
		$date2 = new DateTime($dateEnd);
		$interval = $date1->diff($date2);
		return $interval->days;
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
