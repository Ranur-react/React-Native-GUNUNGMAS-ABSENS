<?php 
$obj=file_get_contents('php://input');
$objSon=json_decode($obj,true);
$MESSAGE['Respon-------------FILES>']=$_FILES;
	$target_dir = "uploads";
		if (!file_exists($target_dir)) {
		mkdir($target_dir,777,true);
	}
		if(move_uploaded_file($_FILES['imagos']['tmp_name'], $target_dir."/".rand()."_".time().".jpeg")){
			$MESSAGE['Pesan']="Sukses !! Upload Foto Berhasil";
			$MESSAGE['kode']=1;

		}else{
			$MESSAGE['GAGAL']="Sorry !! Upload Foto GAGAL";
			$MESSAGE['kode']=0;
		}
 ?>