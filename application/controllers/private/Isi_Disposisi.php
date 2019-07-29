<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Isi_Disposisi extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{	
		$this->vars['dataIsi'] = $this->M_isi_disposisi->latest()->get();

		return view('private.isi_disposisi.index', $this->vars);
	}

	public function create()
	{	
		$post = $this->input->post();
		$post['isi_penolakan'] = isset($post['isi_penolakan']) ? $post['isi_penolakan'] : null;
		$allRole = $this->M_roles->get();
		$roleFrom = $allRole->where('id', $post['from_role_id'])->first();
		$roleUmum = $allRole->where('role_name', 'Umum')->first();
		$roleDestinationId = null;
		$roleTerakhir = $allRole->where('disposisi_level', $allRole->max('disposisi_level'))->first();
		$statusDisposisi = null;
		$positionRoleId = null;


		if ($post['isi_disposisi'] == '-1') {
			$roleDestinationId =$roleUmum->id;
			$statusDisposisi = '2';
			$positionRoleId = $roleUmum->id;

		}
		else if ($post['isi_disposisi'] == '1') {
			if ($roleFrom->disposisi_level == $roleTerakhir->disposisi_level) {
				$roleDestinationId =$roleUmum->id;
				$statusDisposisi = '2';
				$positionRoleId = $roleUmum->id;
			} else if ($roleFrom->disposisi_level < $roleTerakhir->disposisi_level) {
				$roleDestinationId = $allRole
				->where('disposisi_level', $roleFrom->disposisi_level + 1)
				->first()->id;
				$statusDisposisi = '1';
				$positionRoleId = $roleDestinationId;
			}
		}

		$lembarDisposisi = $this->M_lembar_disposisi->findOrFail($post['lembar_disposisi_id']);
		if ($lembarDisposisi->status == '2' && $lembarDisposisi->position_role_id == $roleUmum->id) {
			$this->vars['status'] == 'error';
		} else 
		{
			$lembarDisposisi->position_role_id = $positionRoleId;
			$lembarDisposisi->status = $statusDisposisi;
			$lembarDisposisi->save();

			$isiDisposisi = $this->M_isi_disposisi
			->create([
				'lembar_disposisi_id' => $post['lembar_disposisi_id'],
				'status' => $post['isi_disposisi'],
				'isi_penolakan' => $post['isi_penolakan'],
				'from_role_id' => $post['from_role_id'],
				'destination_role_id' => $roleDestinationId,
			]);

			$this->vars['status'] = 'success';
		}



		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
		

	}

}

/* End of file Peminjaman.php */
/* Location: ./application/controllers/private/Peminjaman.php */