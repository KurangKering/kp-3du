<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isi_Disposisi extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{	
		$this->vars['dataIsi'] = $this->M_isi_disposisi->get();

		return view('private.isi_disposisi.index', $this->vars);
	}

}

/* End of file Peminjaman.php */
/* Location: ./application/controllers/private/Peminjaman.php */