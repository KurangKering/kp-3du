<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembar_Disposisi extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{	
		$this->vars['dataLembar'] = $this->M_lembar_disposisi->get();

		return view('private.lembar_disposisi.index', $this->vars);
	}


	public function create_lembar_disposisi($tableName,$id) {
		switch ($tableName) {
			case '':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}

}

/* End of file Peminjaman.php */
/* Location: ./application/controllers/private/Peminjaman.php */