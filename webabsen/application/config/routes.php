<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logout'] = 'auth/logout';
$route['login'] = 'auth/validate';
$route['user'] = 'master/User';
$route['Usernamecek'] = 'auth/Usernamecek';
$route['Passwordcek'] = 'auth/Passwordcek';

$route['Home'] = 'Absens/HalamaUtama';
$route['wa'] = 'Absens/WaktuAbsensi';
$route['dk'] = 'Absens/DataKaryawan';
$route['la'] = 'Absens/LokasiAbsensi';
$route['am'] = 'Absens/AbsenMasuk';
$route['ap'] = 'Absens/AbsenPulang';
$route['jak'] = 'Absens/JadwalAbsenKaryawan';
$route['lah'] = 'Absens/LaporanAbsenHarian';
$route['lam'] = 'Absens/LaporanAbsenMingguan';
