<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_Inventaris extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		return view('private.pengajuan_inventaris.index', $this->vars);
	}

}

/* End of file Peminjaman.php */
/* Location: ./application/controllers/private/Peminjaman.php */