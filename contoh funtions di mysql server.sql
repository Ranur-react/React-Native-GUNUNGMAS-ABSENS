DELIMITER $$
CREATE FUNCTION attCountDisplin(var CHAR(10),startdate DATE,enddate DATE, idkaryawan VARCHAR(50)) RETURNS INT DETERMINISTIC

BEGIN
DECLARE jml INT;

SELECT COUNT(*) AS jumlah INTO jml  FROM `jadwal_absen_karyawan` 
			JOIN  `detail_jadwal` ON `id_jadwal_detail`=`id_jadwal`
			JOIN `karyawan` ON `id_karyawan` =`id_karyawan_detail`
			JOIN `set_lokasi` ON `id_set_lokasi` =`id_lokasi_absensi`
			WHERE tanggal BETWEEN startdate AND enddate
			AND status_displin=var AND id_karyawan=idkaryawan;

RETURN jml;
END$$

DELIMITER ;

SELECT attCount('m','2022-01-07','2022-01-14');
