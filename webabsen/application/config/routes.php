<?php
defined('BASEPATH') or exit('No direct script access allowed');
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['Home'] = 'Absens/HalamaUtama';
$route['tahun-ajaran'] = 'master/tahunajaran';
$route['jr'] = 'master/Jurusan';
$route['kel'] = 'master/Kelas';
$route['siw'] = 'master/Siswa';
$route['mp'] = 'master/Matapelajaran';
$route['gr'] = 'master/Guru';
$route['logout'] = 'auth/logout';
$route['login'] = 'auth/validate';
$route['user'] = 'master/User';
$route['Usernamecek'] = 'auth/Usernamecek';
$route['Passwordcek'] = 'auth/Passwordcek';