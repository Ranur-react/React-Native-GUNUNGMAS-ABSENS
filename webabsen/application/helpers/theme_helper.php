<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('theme')) {
	function theme()
	{
		$link = base_url() . 'assets/';
		return $link;
	}
}

if (!function_exists('cek_user')) {
	function cek_user()
	{
		$CI = &get_instance();
		if ($CI->session->userdata('status_login') != true) {
			redirect('logout');
		}
	}
}

if (!function_exists('title')) {
	function title()
	{
		return $value = 'E-Learning SMAN 2 Lubuk Alung';
	}
}

if (!function_exists('iduser')) {
	function iduser()
	{
		$ci = &get_instance();
		return $ci->session->userdata('kode');
	}
}

if (!function_exists('user')) {
	function user()
	{
		$ci = &get_instance();
		$kode = $ci->session->userdata('kode');
		$data = $ci->db->where('id_user', $kode)->get('user')->row();
		if ($data->level_user == 1) {
			$user = 'Administrator';
		} else if ($data->level_user == 2) {
			$query = $ci->db->where('idguru', $data->kode_user)->get('guru')->row();
			$user = $query->namaguru;
		} else if ($data->level_user == 3) {
			$query = $ci->db->where('id_siswa', $data->kode_user)->get('siswa')->row();
			$user = $query->nama_siswa;
		}
		return $user;
	}
}

if (!function_exists('nisn')) {
	function nisn()
	{
		$ci = &get_instance();
		$kode = $ci->session->userdata('kode');
		$data = $ci->db->where('id_user', $kode)->get('user')->row();
		if ($data->level_user == 1) {
			$nisn = null;
		} else if ($data->level_user == 2) {
			$query = $ci->db->where('idguru', $data->kode_user)->get('guru')->row();
			$nisn = $query->nipguru;
		} else if ($data->level_user == 3) {
			$query = $ci->db->where('id_siswa', $data->kode_user)->get('siswa')->row();
			$nisn = $query->nisn_siswa;
		}
		return $nisn;
	}
}

if (!function_exists('role')) {
	function role()
	{
		$ci = &get_instance();
		$kode = $ci->session->userdata('kode');
		$data = $ci->db->where('id_user', $kode)->get('user')->row();
		if ($data->level_user == 1) {
			$role = 'Administrator';
		} else if ($data->level_user == 2) {
			$role = 'Guru';
		} else if ($data->level_user == 3) {
			$role = 'Siswa';
		}
		return $role;
	}
}

if (!function_exists('level')) {
	function level()
	{
		$ci = &get_instance();
		$kode = $ci->session->userdata('kode');
		$data = $ci->db->where('id_user', $kode)->get('user')->row();
		return $data->level_user;
	}
}

if (!function_exists('foto')) {
	function foto()
	{
		return $value = base_url() . 'assets/dist/img/profile.png';
	}
}

if (!function_exists('bergabung')) {
	function bergabung()
	{
		return $value = 'Member since Nov. 2012';
	}
}
