<?php 
use Jenssegers\Blade\Blade;

if (!function_exists('view')) {
	function view($view, $data = []) {
		$path = APPPATH . 'views';
		$blade = new Blade($path, $path . '/cache');

		echo $blade->make($view, $data); 
	}
}


if (!function_exists('hDaftarPekerjaan')) {
	function hDaftarPekerjaan() {

		return [
			'Mahasiswa',
			'Pegawai',
		];

	}
}


if (!function_exists('indoDate')) {
	function indoDate ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = '') {
		if (trim ($timestamp) == '')
		{
			$timestamp = time ();
		}
		elseif (!ctype_digit ($timestamp))
		{
			$timestamp = strtotime ($timestamp);
		}
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
		$date_format = preg_replace ("/S/", "", $date_format);
		$pattern = array (
			'/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
			'/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
			'/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
			'/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
			'/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
			'/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
			'/April/','/June/','/July/','/August/','/September/','/October/',
			'/November/','/December/',
		);
		$replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
			'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
			'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
			'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
			'Oktober','November','Desember',
		);
		$date = date ($date_format, $timestamp);
		$date = preg_replace ($pattern, $replace, $date);
		if ($suffix) {
			$date = "{$date} {$suffix}";
		}
		return $date;
	} 
	
}

if (!function_exists('hStatusDisposisi')) {
	function hStatusDisposisi($input = null) {

		$arr =  [
			'1' => 'Proses',
			'2' => 'Selesai',
		];
		if ($input === null) {
			return $arr;
		}
		return $arr[$input];

	}
}


if (!function_exists('hStatusPeminjaman')) {
	function hStatusPeminjaman($input = null) {

		$arr =  [
			'-1' => 'Ditolak',
			'0' => 'Belum Diproses',
			'1' => 'Proses',
			'2' => 'Diterima',
		];
		if ($input === null) {
			return $arr;
		}
		return $arr[$input];

	}
}

if (!function_exists('hStatusPeminjamanBarang')) {
	function hStatusPeminjamanBarang($input = null) {

		$arr =  [
			'1' => 'Sedang dipinjam',
			'2' => 'Telah Dikembalikan',
		];
		if ($input === null) {
			return $arr;
		}
		return $arr[$input];

	}
}


if (!function_exists('hHasDisposisiRoles')) {
	function hHasDisposisiRoles($disposisi_level = null) {
		$CI =& get_instance();

		$arr = $CI->M_roles
		->where('disposisi_level', '!=', '0')
		->get()
		->mapWithKeys(function($i) {
			return [$i->disposisi_level => array('id' => $i->id, 'role_name' => $i->role_name)];
		});

		if ($disposisi_level === null | 0) {
			return $arr;
		}
		return $arr[$disposisi_level];

	}
}

if (!function_exists('hRoleUmum')) {
	function hRoleUmum() {
		$CI =& get_instance();

		$roleUmum = $CI->M_roles->where('role_name', 'Umum')->firstOrFail();

	}
}
if (!function_exists('hIsiDisposisi')) {
	function hIsiDisposisi($input = null) {
		$arr = 
		[
			'1' => 'Diterima',
			'-1' => 'Ditolak',
		];

		if ($input === null) {
			return $arr;
		}
		return $arr[$input];

	}
}



