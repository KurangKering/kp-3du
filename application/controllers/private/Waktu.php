<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waktu extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$dataWaktu = $this->M_waktu->get();

		$this->vars['data_waktu'] = $dataWaktu;


	}

}

/* End of file Waktu.php */
/* Location: ./application/controllers/private/Waktu.php */