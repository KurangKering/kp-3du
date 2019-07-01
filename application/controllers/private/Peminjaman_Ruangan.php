<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_Ruangan extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		
		$this->vars['dataPeminjaman'] = $dd = $this->M_peminjaman_ruangan->get();
		$this->vars['dataDisposisiRoles'] = hIsDisposisiRoles();
		return view('private.peminjaman_ruangan.index', $this->vars);
	}

	public function info($id)
	{
		$user = $this->M_peminjaman_ruangan->with('keperluan', 'ruangan', 'waktu')->findOrFail($id);
		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($user, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

}

/* End of file Peminjaman.php */
/* Location: ./application/controllers/private/Peminjaman.php */