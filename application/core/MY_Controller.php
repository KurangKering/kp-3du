<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
	 * General Variable
	 * @var Array
	 */
	protected $vars = [];


	public function __construct()
	{
		parent::__construct();
		
	}	

}

require_once(APPPATH.'/core/Public_Controller.php');
require_once(APPPATH.'/core/Private_Controller.php');

/* End of file MY_controller.php */
/* Location: ./application/core/MY_controller.php */