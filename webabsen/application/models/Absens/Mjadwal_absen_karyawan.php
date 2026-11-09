<?php
class Mjadwal_absen_karyawan extends CI_Model
{
	protected $tabel = 'jadwal_absen_karyawan';
	public function getall()
	{
		$this->db->from($this->tabel);
		$this->db->join('set_waktu_absens', 'id_waktu=id_shift_absensi');
		$this->db->join('set_lokasi', 'id_set_lokasi=id_lokasi_absensi');
		$this->db->join('detail_jadwal', 'id_jadwal=id_jadwal_detail');
		return $this->db->get()->result_array();
	}

public function getCustomeAll()
{
	return $this->db->query("SELECT * FROM `jadwal_absen_karyawan`
JOIN `detail_jadwal` ON `detail_jadwal`.`id_jadwal_detail`=`jadwal_absen_karyawan`.`id_jadwal`
JOIN  `set_waktu_absens` ON `set_waktu_absens`.`id_waktu` = `jadwal_absen_karyawan`.`id_shift_absensi`
JOIN `set_lokasi` ON `set_lokasi`.`id_set_lokasi` = `jadwal_absen_karyawan`.`id_lokasi_absensi`
JOIN `karyawan` ON `karyawan`.`id_karyawan`=`detail_jadwal`.`id_karyawan_detail`")->result_array();
}

public function getCustome($p)
{
	$v=$p['PilBulan'];
	$a=$v.' month';
	$date = date_create('2020-12-01');
	date_add($date, date_interval_create_from_date_string($a));
	$d=date_format($date, 'Y-m');
	$lok=$p['pilLokasi'];
	
	$qry=$this->db->query("SELECT * FROM `jadwal_absen_karyawan` JOIN `detail_jadwal` ON `detail_jadwal`.`id_jadwal_detail`=`jadwal_absen_karyawan`.`id_jadwal` JOIN  `set_waktu_absens` ON `set_waktu_absens`.`id_waktu` = `jadwal_absen_karyawan`.`id_shift_absensi` JOIN `set_lokasi` ON `set_lokasi`.`id_set_lokasi` = `jadwal_absen_karyawan`.`id_lokasi_absensi` JOIN `karyawan` ON `karyawan`.`id_karyawan`=`detail_jadwal`.`id_karyawan_detail` WHERE `detail_jadwal`.`tanggal` LIKE '%$d%' AND id_set_lokasi LIKE '$lok' ORDER BY `detail_jadwal`.`tanggal` ASC")->result_array();
	 return $qry;
}

public function getCustomeID($p)
{
date_default_timezone_set('Asia/Jakarta');
	
	$d=date("Y-m-d");
	// echo "Tanggal";
	// echo $d;
	
	 return $this->db->query("SELECT * FROM `jadwal_absen_karyawan` 
JOIN `detail_jadwal` ON `detail_jadwal`.`id_jadwal_detail`=`jadwal_absen_karyawan`.`id_jadwal` 
JOIN  `set_waktu_absens` ON `set_waktu_absens`.`id_waktu` = `jadwal_absen_karyawan`.`id_shift_absensi` 
JOIN `set_lokasi` ON `set_lokasi`.`id_set_lokasi` = `jadwal_absen_karyawan`.`id_lokasi_absensi` 
JOIN `karyawan` ON `karyawan`.`id_karyawan`=`detail_jadwal`.`id_karyawan_detail` 
WHERE `detail_jadwal`.`tanggal`='$d' AND `detail_jadwal`.`id_karyawan_detail` = '$p' ORDER BY `detail_jadwal`.`tanggal` ASC");
}

	// public function store($params)
	// {
	// 	$data = [
	// 		'id_jadwal'   		 => $params['idjadwal'],
	// 		'rentang_tanggal' => date("Y-m-d", strtotime($params['rentang'])),
	// 		'id_shift_absensi'  => $params['shift'],
	// 		'id_lokasi_absensi'   	 => $params['lokasi'],
	// 		'id_karyawan_absensi'   	 => $params['karyawan'],
	// 	];
	// 	return $this->db->insert($this->tabel, $data);
	// }


	public function storerange($params)
	{
			
				$tglR= $params['rentang'];
				$tglD=explode("-",str_replace(" ","",$tglR));
					 $i=0;
				foreach ($tglD as $k ) {$i++;}
				// $json['Data']  = date_diff( date('Y-m-d',strtotime($tglD[$i-1])), date('Y-m-d',strtotime($tglD[0])));
				$startTimeStamp = strtotime($tglD[0]);
				$endTimeStamp = strtotime($tglD[$i-1]);
				$timeDiff = abs($endTimeStamp - $startTimeStamp);
				$numberDays = $timeDiff/86400;  // 86400 seconds in one day
				$numberDays = intval($numberDays);
				
				
				 $data['id_jadwal']=$params['idjadwal'];
				 $data['rentangSet']=$params['rentang'];
				 $data['id_shift_absensi']=$params['shift'];
				 $data['id_lokasi_absensi']=$params['lokasi'];
				$this->db->insert($this->tabel, $data);
		$tmp=$this->db->query("SELECT * FROM `tmp_karyawan`")->result_array();
				for ($i=0; $i < $numberDays+1; $i++) { 
				$pDate = strtotime(date('d-m-Y',$startTimeStamp).'+ '.$i.' day');
				$dataDetail['tanggal']=date('Y-m-d',$pDate);
				$dataDetail['id_jadwal_detail']=$params['idjadwal'];
				foreach ($tmp as $key) {
							$dataDetail['id_karyawan_detail']=$key['id_karyawan_tmp'];
							$this->db->insert("detail_jadwal", $dataDetail);
						}
					}
$this->db->query("DELETE FROM `tmp_karyawan`");

		
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
