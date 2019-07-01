<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keperluan extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		$dataKeperluan = $this->M_keperluan->get();

		$this->vars['data_keperluan'] = $dataKeperluan;

	}

}

/* End of file Keperluan.php */
/* Location: ./application/controllers/private/Keperluan.php */