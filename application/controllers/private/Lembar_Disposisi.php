<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembar_Disposisi extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	//syarat disposisi  
	// lembar disposisi status  bukan 2 dan position role bukan umum
	// bila tidak terdapat data isi disposisi, maka position_role_id = current_role_id 
	// destination_role_id = current_role_id
	// 
	// setiap isi disposisi tidak ada yang from_role_id = current_role_id
	public function index()
	{	
		$roleUmum = hRoleUmum();
		$currentRole = $this->vars['currentRole'];
		$dataLembar =  $this->M_lembar_disposisi->latest()->get();
		$dataLembar->each(function($lembar) use ($roleUmum, $currentRole) {
			
			$lembar->availableDisposisi = false;

			if ($lembar->status != '2') {
				if (count($lembar->isi_disposisi) > 0) {

					$sudahDisposisi = $lembar->isi_disposisi
					->where('from_role_id', $currentRole->id)
					->first();

					if (!$sudahDisposisi) {
						$lembar->availableDisposisi = true;
					}
				}
				else  {
					if ($lembar->position_role_id == $currentRole->id) {
						$lembar->availableDisposisi = true;
					}
				}
				
			}
		});

		$this->vars['dataLembar'] = $dataLembar;

		return view('private.lembar_disposisi.index', $this->vars);
	}


	public function info($id)
	{
		$info = $this->M_lembar_disposisi->with('peminjaman_ruangan.ruangan',
			'isi_disposisi.from_role', 
			'isi_disposisi.destination_role')->findOrFail($id);

		$tanggal = indoDate($info->peminjaman_ruangan->waktu_mulai, 'd-m-Y');
		$waktuMulai = indoDate($info->peminjaman_ruangan->waktu_mulai, 'H:i');
		$waktuSelesai = indoDate($info->peminjaman_ruangan->waktu_selesai, 'H:i');
		$info->peminjaman_ruangan->tanggalWaktu = "$tanggal | $waktuMulai - $waktuSelesai";

		$info->peminjaman_ruangan->tanggal = indoDate($info->peminjaman_ruangan->waktu_mulai, 'd-m-Y');
		$info->peminjaman_ruangan->waktuMulai = indoDate($info->peminjaman_ruangan->waktu_mulai, 'H:i');
		$info->peminjaman_ruangan->waktuSelesai = indoDate($info->peminjaman_ruangan->waktu_selesai, 'H:i');

		$info->isi_disposisi->each(function($i) {
			$i->statusDisposisi = hIsiDisposisi($i->status);
			$i->isiDisposisi = hIsiDisposisi($i->status);

			if ($i->status == '-1') {
				$i->isiDisposisi = $i->isiDisposisi . ' dengan alasan ' . $i->isi_penolakan;
			}
		});
		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($info, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}


	public function create() {
		$input = [];
		$post = $this->input->post();
		if($post['valueSubmit'] === '1')
		{
			$input['position_role_id'] = $post['disposisiSatu']; 
			$input['file'] = ''; 
			$input['status'] = '1'; 
			$input['tanggal'] = date('Y-m-d H:i:s'); 
			$input['peminjaman_ruangan_id'] = $post['peminjamanRuanganId']; 
			$varCreate = $this->M_lembar_disposisi->create($input);
		}

		$varEditPeminjaman = $this->M_peminjaman_ruangan->find($post['peminjamanRuanganId']);
		$varEditPeminjaman->status = $post['valueSubmit'];
		$varEditPeminjaman->save();


		$this->vars['status'] = 'success';
		$this->vars['messages'] = ['Berhasil'];


		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

}

/* End of file Peminjaman.php */
/* Location: ./application/controllers/private/Peminjaman.php */