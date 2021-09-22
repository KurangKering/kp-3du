<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Capsule\Manager as DB;

class Private_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_daftar_barang');
		$this->load->model('M_daftar_inventaris');
		$this->load->model('M_det_peminjaman_barang');
		$this->load->model('M_det_pengajuan_inventaris');
		$this->load->model('M_det_permintaan_inventaris');
		$this->load->model('M_isi_disposisi');
		$this->load->model('M_kegiatan');
		$this->load->model('M_lembar_disposisi');
		$this->load->model('M_peminjaman_barang');
		$this->load->model('M_peminjaman_ruangan');
		$this->load->model('M_pengajuan_inventaris');
		$this->load->model('M_permintaan_inventaris');
		$this->load->model('M_roles');
		$this->load->model('M_ruangan');
		$this->load->model('M_users');

		if (!$this->session->userdata('user')) {
			redirect('login');
		}

		$user_id = $this->session->userdata('user')['user_id'];
		$user = $this->M_users->findOrFail($user_id);
		$this->vars['currentRole'] = $user->role;
		$this->vars['currentUser'] = $user;

		$roleName = strtolower($user->role->role_name);

		$arr = [
			'admin' => [
				'dashboard.*',
				'user.*',

			],
			'umum' => [
				'dashboard.*',
				'ruangan.*',
				'daftar_barang.*',
				'daftar_inventaris.*',
				'peminjaman_ruangan.*',
				'peminjaman_barang.*',
				'pengajuan_inventaris.*',
				'permintaan_inventaris.*',
				'lembar_disposisi.*',
				'isi_disposisi.*',
			],
			'kabag tu' => [
				'dashboard.*',
				'lembar_disposisi.*',
				'isi_disposisi.*',
				'peminjaman_ruangan.rekap',
				'peminjaman_barang.rekap',
				'peminjaman_barang.indexReadOnly',
			],
			'dekan' => [
				'dashboard.*',
				'peminjaman_ruangan.rekap',
				'peminjaman_barang.rekap',
				'peminjaman_barang.indexReadOnly',

			],
		];

		// $pattern = "peminjaman_ruangan.*";
		// $pattern = "private\/$pattern";
		// $URI = "private/peminjaman_ruangan/info/12";
		// if (preg_match("/^$pattern$/", $URI))
		// {
		// 	echo 'sdf';
		// }
		// die();


		$isFound = false;
		$URI = $this->uri->uri_string();
		if ($URI == 'private') {
			return;
		}
		foreach ($arr[$roleName] as $k => $pattern) {
			$pattern = "private\/$pattern";

			if (preg_match("/^$pattern$/", $URI))
			{
				$isFound = true;
				break;
			}
		}
		if (!$isFound) {
			show_error('Tidak memiliki akses', '403');
		}


	}


	public function delete($table, $id)
	{
		$item = DB::table($table)->where('id', $id)->delete();

		$this->vars['status'] = $item ? 'success' : 'error';
		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

}

/* End of file Admin_controller.php */
/* Location: ./application/core/Admin_controller.php */