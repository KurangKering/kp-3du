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

if (!function_exists('hReferenceTable')) {
	function hReferenceTable($input = null) {

		$arr =  [
			'peminjaman_ruangan' => 'Peminjaman Ruangan',
			'pengajuan_inventaris' => 'Pengajuan Inventaris',
		];
		if ($input === null) {
			return $arr;
		}
		return $arr[$input];

	}
}

if (!function_exists('hStatusDisposisi')) {
	function hStatusDisposisi($input = null) {

		$arr =  [
			'belum' => 'Belum',
			'proses' => 'Proses',
			'selesai' => 'Selesai',
		];
		if ($input === null) {
			return $arr;
		}
		return $arr[$input];

	}
}

if (!function_exists('hIsDisposisiRoles')) {
	function hIsDisposisiRoles($input = null) {
		$CI =& get_instance();
		$arr = $CI->M_roles->where('is_disposisi', '1')->pluck('role_name', 'id');
		if ($input === null) {
			return $arr;
		}
		return $arr[$input];

	}
}