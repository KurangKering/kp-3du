<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Quotes');
	}
	public function index()
	{

		$this->vars['quotes'] = $this->M_Quotes->latest()->get();
		$this->vars['daftar_berita'] = $this->M_news->latest()->take(8)->get();
		return view('public.index', $this->vars);
	}

}

/* End of file IndexController.php */
/* Location: ./application/controllers/IndexController.php */