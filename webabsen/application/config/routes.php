<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logout'] = 'auth/logout';
$route['login'] = 'auth/validate';
$route['user'] = 'Absens/User';
$route['Usernamecek'] = 'auth/Usernamecek';
$route['Passwordcek'] = 'auth/Passwordcek';

$route['Home'] = 'Absens/HalamaUtama';
$route['wa'] = 'Absens/WaktuAbsensi';
$route['dk'] = 'Absens/DataKaryawan';
$route['gaj'] = 'Absens/GajiKaryawan';


$route['la'] = 'Absens/LokasiAbsensi';
$route['am'] = 'Absens/AbsenMasuk';
$route['ap'] = 'Absens/AbsenPulang';
$route['jak'] = 'Absens/JadwalAbsenKaryawan';
$route['lah'] = 'Absens/LaporanAbsenHarian';
$route['lam'] = 'Absens/LaporanAbsenMingguan';
$route['lab'] = 'Absens/LaporanAbsenBulanan';
$route['lag'] = 'Absens/LaporanAbsenGajiBulanan';
$route['lagp'] = 'Absens/LaporanAbsenGajiBulanan/pimpinan';

$route['lat'] = 'Absens/LaporanAbsenTahunan';
$route['lk'] = 'Absens/LaporanKaryawan';
$route['tmp'] = 'Absens/TmpKaryawan';
