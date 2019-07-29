<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->vars['data_user'] = $this->M_users->latest()->get();
		$this->vars['roles'] = $this->M_roles->pluck('role_name', 'id');
		return view('private.user.index', $this->vars);

	}

	public function store() 
	{	

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('role_id', 'Hak Akses','required');
		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();
			
		} else {
			$form_data = $this->input->post();
			$input = [
				'nama' => $form_data['nama'],
				'username' => $form_data['username'],
				'email' => $form_data['email'],
				'password' => md5($form_data['password']),
				'role_id' => $form_data['role_id'],
			];
			$new_user = $this->M_users->create($input);
			if ($new_user) {
				$this->vars['status'] = 'success';
			}
		}
		

		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}
	public function update()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('role_id', 'Hak Akses','required');
		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();
			
		} else {
			$form_data = $this->input->post();
			$input = [
				'nama' => $form_data['nama'],
				'username' => $form_data['username'],
				'email' => $form_data['email'],
				'role_id' => $form_data['role_id'],
			];
			if (!empty($form_data['password'])) {
				$input['password']  = md5($form_data['password']);
			}

			$update_user = $this->M_users->findOrFail($form_data['id'])->update($input);
			if ($update_user) {
				$this->vars['status'] = 'success';
			}
		}
		

		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}
	public function info($id)
	{
		$user = $this->M_users->findOrFail($id);
		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($user, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}


	public function validate()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
	}

	

}

/* End of file User.php */
/* Location: ./application/controllers/admin/User.php */