<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_Inventaris extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		$dataInventaris = $this->M_daftar_inventaris->latest()->get();

		$this->vars['dataInventaris'] = $dataInventaris;

		return view('private.daftar_inventaris.index', $this->vars);

	}

	public function info($id)
	{
		$inventaris = $this->M_daftar_inventaris->findOrFail($id);
		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($inventaris, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

	public function store() 
	{	
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		$this->form_validation->set_rules('stock', 'Stock', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();

			
		} else {
			$form_data = $this->input->post();
			$input = [
				'nama' => $form_data['nama'],
				'satuan' => $form_data['satuan'],
				'stock' => $form_data['stock'],
			];
			$newBarang = $this->M_daftar_inventaris->create($input);
			if ($newBarang) {
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
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		$this->form_validation->set_rules('stock', 'Stock', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();
			
		} else {
			$form_data = $this->input->post();
			$input = [
				'nama' => $form_data['nama'],
				'satuan' => $form_data['satuan'],
				'stock' => $form_data['stock'],
			];
		

			$update_ruangan = $this->M_daftar_inventaris->findOrFail($form_data['id'])->update($input);
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

/* End of file Daftar_Inventaris.php */
/* Location: ./application/controllers/private/Daftar_Inventaris.php */