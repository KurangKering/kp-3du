<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		$dataRuangan = $this->M_ruangan->get();

		$this->vars['dataRuangan'] = $dataRuangan;

		return view('private.ruangan.index', $this->vars);

	}

	public function info($id)
	{
		$ruangan = $this->M_ruangan->findOrFail($id);
		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($ruangan, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

	public function store() 
	{	

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();
			
		} else {
			$form_data = $this->input->post();
			$input = [
				'nama' => $form_data['nama'],
			];
			$new_ruangan = $this->M_ruangan->create($input);
			if ($new_ruangan) {
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
		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();
			
		} else {
			$form_data = $this->input->post();
			$input = [
				'nama' => $form_data['nama'],
			];
		

			$update_ruangan = $this->M_ruangan->findOrFail($form_data['id'])->update($input);
			if ($update_ruangan) {
				$this->vars['status'] = 'success';
			}
		}
		

		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

}

/* End of file Ruangan.php */
/* Location: ./application/controllers/private/Ruangan.php */