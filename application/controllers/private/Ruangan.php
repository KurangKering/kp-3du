<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruangan extends Private_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$dataRuangan = $this->M_ruangan->latest()->get();

		$this->vars['dataRuangan'] = $dataRuangan;

		return view('private.ruangan.index', $this->vars);
	}

	public function info($id)
	{
		$ruangan = $this->M_ruangan->with('det_ruangan')->findOrFail($id);
		$ruangan->det_ruangan->each(function ($q) {
			$q->nama = $q->nama_inventaris;
		});
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($ruangan, JSON_HEX_APOS | JSON_HEX_QUOT))
			->_display();

		exit;
	}

	public function store()
	{

		$this->form_validation->set_rules('nama', 'Nama Ruangan', 'trim|required');
		$this->form_validation->set_rules('val_nama[]', 'Nama Inventaris', 'required');
		$this->form_validation->set_rules('val_jumlah[]', 'Jumlah', 'required');
		$this->form_validation->set_rules('val_satuan[]', 'Satuan', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();
		} else {
			$formData = $this->input->post();
			$input = [
				'nama' => $formData['nama'],
			];
			$inserRuangan = $this->M_ruangan->create($input);
			if ($inserRuangan) {
				$valNama = $formData['val_nama'];
				$valSatuan = $formData['val_satuan'];
				$valJumlah = $formData['val_jumlah'];

				$inputDetailRuangan = [];
				foreach ($valNama as $key => $nama) {
					$inputDetailRuangan[] = [
						'ruangan_id' => $inserRuangan->id,
						'nama_inventaris' => $valNama[$key],
						'jumlah' => $valJumlah[$key],
						'satuan' => $valSatuan[$key],
					];
				}
				$insertDetRuangan = $this->M_det_ruangan->insert($inputDetailRuangan);
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
		$this->form_validation->set_rules('val_nama[]', 'Nama Inventaris', 'required');
		$this->form_validation->set_rules('val_jumlah[]', 'Jumlah', 'required');
		$this->form_validation->set_rules('val_satuan[]', 'Satuan', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->vars['status'] = 'error';
			$this->vars['messages'] = validation_errors();
		} else {
			$post = $this->input->post();
			$input = [
				'nama' => $post['nama'],
			];

			$ruangan = $this->M_ruangan->with('det_ruangan')->findOrFail($post['id']);

			$arrayNama = $post['val_nama'];
			$arrayJumlah = $post['val_jumlah'];
			$arraySatuan = $post['val_satuan'];
			$arrayDetailRuangan = $post['val_detail_ruangan_id'];
			$jumlahDetail = count($arrayNama);

			$detailLama = array_values(array_filter($arrayDetailRuangan));
			$detailDiDatabase = $ruangan->det_ruangan->pluck('id')->toArray();
			$detailHapus = array_values(array_diff($detailDiDatabase, $detailLama));

			for ($i = 0; $i < count($detailHapus); $i++) {
				$this->M_det_ruangan->findOrFail($detailHapus[$i])->delete();
			}

			for ($i = 0; $i < $jumlahDetail; $i++) {
				
				$valuesDetail = [
					'nama_inventaris' => $arrayNama[$i],
					'jumlah' => $arrayJumlah[$i],
					'satuan' => $arraySatuan[$i],
				];

				if (!empty($arrayDetailRuangan[$i])) {

					$this->M_det_ruangan->where('id', $arrayDetailRuangan[$i])->update($valuesDetail);

				} else {

					$valuesDetail['ruangan_id'] = $post['id'];

					$this->M_det_ruangan->insert($valuesDetail);
				}
			}

			$ruangan->update($post);

			$this->vars['status'] = 'success';
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
			->_display();

		exit;
	}

	public function detail()
	{
		$id = $this->input->post('id');
		$ruangan = $this->M_ruangan->with('det_ruangan')->findOrFail($id);

		$this->vars['status'] = 'success';
		$this->vars['ruangan'] = $ruangan;

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
			->_display();

		exit;
	}

	public function delete()
	{
		$id = $this->input->post('id');

		$ruangan = $this->M_ruangan->with('det_ruangan')->findOrFail($id);
		$ruangan->det_ruangan->each(function ($q) {
			$q->delete();
		});

		$ruangan->delete();

		
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
			->_display();

		exit;
	}
}

/* End of file Ruangan.php */
/* Location: ./application/controllers/private/Ruangan.php */