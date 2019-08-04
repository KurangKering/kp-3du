<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan_Inventaris extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		$daftarPermintaan = $this->M_permintaan_inventaris->latest()->get();

		$this->vars['daftarPermintaan'] = $daftarPermintaan;


		return view('private.permintaan_inventaris.index', $this->vars);

	}

	public function create()
	{
		$daftarInventaris = $this->M_daftar_inventaris->get();
		$this->vars['daftarInventaris'] = $daftarInventaris;
		return view('private.permintaan_inventaris.create', $this->vars);
	}

	public function info($id)
	{
		$inventaris = $this->M_permintaan_inventaris->with('det_permintaan_inventaris.daftar_inventaris')->findOrFail($id);
		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($inventaris, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

	public function store() 
	{
		$post = $this->input->post();
		$response = $this->load->library('Response');
		if ($post['val_id'] == NULL) {
			$this->response->addError('Tidak Ada Barang yang di pilih', 'val_id');
		}
		$valSisa = $post['val_stock'];
		$valJumlah = $post['val_jumlah'];
		$valID = $post['val_id'];
		foreach (($post['val_id'] ?? []) as $k => $id) {

			if (!preg_match('/^\d+$/', $valJumlah[$k]) || $valJumlah[$k] <= 0)
				$this->response->addError('Jumlah Hanya Berisi Angka !', "$k");

			
		}

		if ($this->response->isSuccess())
		{

			$formPermintaan = [
				'tanggal' => date('Y-m-d H:i:s'),
			];
			$insertPermintaan = $this->M_permintaan_inventaris->create($formPermintaan);
			if ($insertPermintaan) {
				$formDetailPermintaan = [];
				foreach ($post['val_id'] as $key => $inventarisID) {

					$formDetailPermintaan = [
						'permintaan_inventaris_id' => $insertPermintaan->id,
						'daftar_inventaris_id' => $post['val_id'][$key],
						'jumlah' => $post['val_jumlah'][$key],
						'created_at' => date("Y-m-d H:i:s"),
						'updated_at' => date("Y-m-d H:i:s"),
					];
					$insertDetPermintaan = $this->M_det_permintaan_inventaris->insert($formDetailPermintaan);


					if ($insertDetPermintaan) {
						$inventarisUpdate = $this->M_daftar_inventaris
						->findOrFail($post['val_id'][$key]);

						$inventarisUpdate->stock = $inventarisUpdate->stock - $post['val_jumlah'][$key];
						$inventarisUpdate->save();
					}



				}

				

			}
		}

		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($this->response, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

	public function edit($id)
	{
		$dataPengajuan = $this->M_permintaan_inventaris
		->with('det_permintaan_inventaris.daftar_inventaris')
		->findOrFail($id);

		$requestedInventaris = [];
		foreach ($dataPengajuan->det_permintaan_inventaris as $key => $detPengajuan) {
			$requestedInventaris[$key]['det_permintaan_inventaris_id'] = $detPengajuan->id;
			$requestedInventaris[$key]['id'] = $detPengajuan->daftar_inventaris->id;
			$requestedInventaris[$key]['nama'] = $detPengajuan->daftar_inventaris->nama;
			$requestedInventaris[$key]['satuan'] = $detPengajuan->daftar_inventaris->satuan;
			$requestedInventaris[$key]['jumlah'] = $detPengajuan->jumlah;
		}

		$this->vars['dataPengajuan'] = $dataPengajuan;
		$this->vars['requestedInventaris'] = $requestedInventaris;
		return view('private.permintaan_inventaris.edit', $this->vars);
	}
	public function update()
	{

		$post = $this->input->post();
		$response = $this->load->library('Response');
		if ($post['val_id'] == NULL) {
			$this->response->addError('Tidak Ada Barang yang di pilih', 'val_id');
		}
		$valSisa = $post['val_sisa'];
		$valJumlah = $post['val_jumlah'];
		$valID = $post['val_id'];
		foreach (($post['val_id'] ?? []) as $k => $id) {

			if (!preg_match('/^\d+$/', $valJumlah[$k]) || $valJumlah[$k] <= 0)
				$this->response->addError('Jumlah Hanya Berisi Angka !', "$k");

			
		}

		if ($this->response->isSuccess())
		{
			$post = $this->input->post();

			$pengajuan = $this->M_permintaan_inventaris->with('det_permintaan_inventaris')->findOrFail($post['pengajuan_inventaris_id']);
			$MasterDetIDs = $pengajuan->det_permintaan_inventaris->pluck('id');
			$postDetID = $post['val_det_id'];
			$postJumlah = $post['val_jumlah'];
			$postInventarisID = $post['val_id'];
   			/**
         	* aksi hapus det_permintaan_inventaris jika barang di hapus
         	*/
         	foreach ($MasterDetIDs as $key => $value) {
         		$index = array_search($value, $postDetID);
         		if ($index === FALSE) {
         			$delDetail = $this->M_depermintaan_pengajuan_inventaris->findOrFail($value)->delete();
         		} 
         	}
         	foreach ($postDetID as $key => $value) {
         		if ($value == 'undefined') {
         			$newDetPengajuan = $this->M_depermintaan_pengajuan_inventaris->create([
         				'pengajuan_inventaris_id' => $pengajuan->id,
         				'daftar_inventaris_id' => $postInventarisID[$key],
         				'jumlah' => $postJumlah[$key],
         			]);
         		} else 
         		{
         			$detPengajuan = $this->M_depermintaan_pengajuan_inventaris->where('id', $value)->get()->first();
         			if ($detPengajuan) {
         				$detPengajuan->daftar_inventaris_id = $postInventarisID[$key];
         				$detPengajuan->jumlah = $postJumlah[$key];
         				$detPengajuan->save();
         			} 
         		}
         	}


         }



         $this->output
         ->set_content_type('application/json', 'utf-8')
         ->set_output(json_encode($this->response, JSON_HEX_APOS | JSON_HEX_QUOT))
         ->_display();

         exit;

     }

     public function delete()
     {
     	$id = $this->input->post('id');

     	$dataPermintaan = $this->M_permintaan_inventaris
     	->with('det_permintaan_inventaris')
     	->findOrFail($id);

     	$dataPermintaan->det_permintaan_inventaris->each(function($i) {
     		$i->delete();
     	});
     	$dataPermintaan->delete();


     	$response['status'] = 'success';
     	$this->output
     	->set_content_type('application/json', 'utf-8')
     	->set_output(json_encode($response, JSON_HEX_APOS | JSON_HEX_QUOT))
     	->_display();

     	exit;
     }

 }

 /* End of file Permintaan_Inventaris.php */
/* Location: ./application/controllers/private/Permintaan_Inventaris.php */