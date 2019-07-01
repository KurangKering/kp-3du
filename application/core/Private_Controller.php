<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Capsule\Manager as DB;

class Private_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_users');
		$this->load->model('M_roles');
		$this->load->model('M_waktu');
		$this->load->model('M_ruangan');
		$this->load->model('M_keperluan');
		$this->load->model('M_peminjaman_ruangan');
		$this->load->model('M_lembar_disposisi');
		$this->load->model('M_pengajuan_inventaris');
		$this->load->model('M_isi_disposisi');
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