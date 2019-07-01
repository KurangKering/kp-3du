<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Private_Controller {

	public function index()
	{
		return view('private.dashboard');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/admin/Dashboard.php */