<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('sukses')) {
	function sukses($pesan)
	{
		$isi = '<div class="alert alert-dismissible" style="background-color: #d4edda;border-color: #c3e6cb;color: #155724;"><i class="fa fa-check-circle"></i> Success: ' . $pesan . '</div>';
		return $isi;
	}
}
if (!function_exists('danger')) {
	function danger($pesan)
	{
		$isi = '<div class="alert alert-dismissible" style="background-color: #f2dede;border-color: #ebccd1;color: #a94442;"><i class="fa fa-exclamation-circle"></i> Warning: ' . $pesan . '</div>';
		return $isi;
	}
}

if (!function_exists('info')) {
	function info($pesan)
	{
		$isi = '<div class="alert alert-dismissible" style="background-color: #d9edf7;border-color: #bce8f1;color: #214c61;"><i class="fa fa-exclamation-circle"></i> ' . $pesan . '</div>';
		return $isi;
	}
}
if (!function_exists('warning')) {
	function warning($pesan)
	{
		$isi = '<div class="alert" style="background-color: #fff3cd; border-color: #ffeeba; color: #856404;"><i class="fa fa-exclamation-circle"></i> ' . $pesan . '</div>';
		return $isi;
	}
}
