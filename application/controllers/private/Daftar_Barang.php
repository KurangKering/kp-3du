<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_Barang extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		$dataBarang = $this->M_daftar_barang->latest()->get();

		$this->vars['dataBarang'] = $dataBarang;

		return view('private.daftar_barang.index', $this->vars);

	}

	public function info($id)
	{
		$barang = $this->M_daftar_barang->findOrFail($id);
		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($barang, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

	public function store() 
	{	
		$this->form_validation->set_rules('nama_barang', 'Nama', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();

			
		} else {
			$form_data = $this->input->post();
			$input = [
				'nama_barang' => $form_data['nama_barang'],
				'satuan' => $form_data['satuan'],
			];
			$new_ruangan = $this->M_daftar_barang->create($input);
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
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();
			
		} else {
			$form_data = $this->input->post();
			$input = [
				'nama' => $form_data['nama'],
				'satuan' => $form_data['satuan'],
			];
		

			$update_ruangan = $this->M_daftar_barang->findOrFail($form_data['id'])->update($input);
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

/* End of file Daftar_Barang.php */
/* Location: ./application/controllers/private/Daftar_Barang.php */