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

		$daftarSedangDipinjam = $this->M_peminjaman_barang->where('status', '1')->get();

		$daftarBarangDipinjam = collect();

		$dataBarang->each(function($mstBarang) use($daftarSedangDipinjam){
			$jumlah = 0;
			$daftarSedangDipinjam->each(function($daftarSedang) use($mstBarang, &$jumlah) {

				$daftarSedang->det_peminjaman_barang
				->where('daftar_barang_id', $mstBarang->id)
				->first(function($i) use(&$jumlah){
					$jumlah += $i->jumlah;
				});


			});

			$mstBarang->digunakan = $jumlah;
		});


		$this->vars['dataBarang'] = $dataBarang;

		return view('private.daftar_barang.index', $this->vars);

	}

	public function info($id)
	{
		$barang = $this->M_daftar_barang->findOrFail($id);

		$daftarSedangDipinjam = $this->M_peminjaman_barang
		->with(['det_peminjaman_barang' => function($j) {

		}])
		->whereHas('det_peminjaman_barang', function($i) use($barang) {
			$i->where('daftar_barang_id', $barang->id);
		})
		->where('status', '1')
		->get();

		$jumlah = 0;
		$daftarSedangDipinjam->each(function($daftarSedang) use($barang, &$jumlah) {

			$daftarSedang->det_peminjaman_barang
			->where('daftar_barang_id', $barang->id)
			->first(function($i) use(&$jumlah){
				$jumlah += $i->jumlah;
			});


		});

		$barang->digunakan = $jumlah;

		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($barang, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

	public function store() 
	{	
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		$this->form_validation->set_rules('total', 'Total', 'trim|required');
		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();

			
		} else {
			$form_data = $this->input->post();
			$input = [
				'nama_barang' => $form_data['nama_barang'],
				'satuan' => $form_data['satuan'],
				'total' => $form_data['total'],
			];
			$newBarang = $this->M_daftar_barang->create($input);
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
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required');
		$this->form_validation->set_rules('total', 'Total', 'trim|required');

		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();
			
		} else {
			$form_data = $this->input->post();
			$input = [
				'nama' => $form_data['nama'],
				'satuan' => $form_data['satuan'],
				'total' => $form_data['total'],
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