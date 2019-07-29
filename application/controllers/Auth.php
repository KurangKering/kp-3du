<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		
	}

	public function login()
	{
		return view('login');
		
	}

	public function doLogin()
	{
		$this->load->model('M_users');
		$post = $this->input->post();

		$whereClause = [
			'username' => $post['username'],
			'password' => md5($post['password']),
		];
		$user = $this->M_users->where($whereClause)->first();
		$response['status'] = 'error';
		$response['messages'] = $this->form_validation->error_array();
		if (count($user) > 0 ) {
			$array = array(
				'user_id' => $user->id,
			);

			$this->session->set_userdata('user', $array);

			$response['status'] = 'success';
		}


		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($response, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;

		

	}
	public function logout()
	{

		$this->session->sess_destroy();
		redirect(site_url('login'));
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */