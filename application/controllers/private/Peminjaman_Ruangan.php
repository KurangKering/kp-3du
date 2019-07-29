<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_Ruangan extends Private_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index()
	{
		$dataPeminjaman  = $this->M_peminjaman_ruangan->latest()->get();
		$dataPeminjaman->each(function($i) {
			$tanggal = indoDate($i->waktu_mulai, 'd-m-Y');
			$waktuMulai = indoDate($i->waktu_mulai, 'H:i');
			$waktuSelesai = indoDate($i->waktu_selesai, 'H:i');
			$i->tanggal = "$tanggal | $waktuMulai - $waktuSelesai";
		});
		
		$this->vars['dataPeminjaman'] = $dataPeminjaman;
		return view('private.peminjaman_ruangan.index', $this->vars);
	}	

	public function create()
	{

		$this->vars['dataRuangan'] = $this->M_ruangan->get();
		return view("private.peminjaman_ruangan.create", $this->vars);

	}

	public function store()
	{
		
		$post = $this->input->post();
		$inTanggal = date("Y-m-d", strtotime($post['inputTanggal']));
		$inWaktuMulai = date('Y-m-d H:i:s', strtotime($inTanggal . ' ' . $post['inputWaktuMulai']));
		$inWaktuSelesai = date('Y-m-d H:i:s', strtotime($inTanggal . ' ' . $post['inputWaktuSelesai']));

		$formPeminjaman = [
			'nama' => $post['inputNama'],
			'kegiatan' => $post['inputKegiatan'],
			'ruangan_id' => $post['inputRuangan'],
			'waktu_mulai' => $inWaktuMulai,
			'waktu_selesai' => $inWaktuSelesai,
			'status' => '1',
		];
		$this->vars['status'] = 'error';
		$peminjaman = $this->M_peminjaman_ruangan->create($formPeminjaman);
		if ($peminjaman) {
			$formLembarDisposisi = [
				'position_role_id' => hHasDisposisiRoles()['1']['id'],
				'status' => '1',
				'tanggal' => date("Y-m-d H:i:s"),
				'peminjaman_ruangan_id' => $peminjaman->id,
			];
			$lembarDisposisi = $this->M_lembar_disposisi->create($formLembarDisposisi);
			$this->vars['status'] = 'success';
		}
		

		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

	public function terima_peminjaman($id)
	{	
		$peminjaman_ruangan = $this->M_peminjaman_ruangan->findOrFail($id);
		$peminjaman_ruangan->tanggal = indoDate($peminjaman_ruangan->waktu_mulai, 'd-m-Y');
		$peminjaman_ruangan->waktuMulai = indoDate($peminjaman_ruangan->waktu_mulai, 'H:i');
		$peminjaman_ruangan->waktuSelesai = indoDate($peminjaman_ruangan->waktu_selesai, 'H:i');


		$peminjaman_ruangan->lembar_disposisi->isi_disposisi->each(function($i) {
			$i->isiDisposisi = hIsiDisposisi($i->status);
			if ($i->status == '-1') {
				$i->isiDisposisi = $i->isiDisposisi . ' dengan alasan ' . $i->isi_penolakan;
			}
		});

		$similiarPeminjaman = $this->M_peminjaman_ruangan->where([
			'ruangan_id' => $peminjaman_ruangan->ruangan_id,
			'status' => '2',
		])
		->whereDate('waktu_mulai', indoDate($peminjaman_ruangan->waktu_mulai, 'Y-m-d'))
		->get();

		$similiarPeminjaman->each(function($similiar) {
			$similiar->tanggal = indoDate($similiar->waktu_mulai, 'd-m-Y');
			$similiar->waktuMulai = indoDate($similiar->waktu_mulai, 'H:i');
			$similiar->waktuSelesai = indoDate($similiar->waktu_selesai, 'H:i');
		});
		

		$this->vars['similiarPeminjaman'] = $similiarPeminjaman;
		$this->vars['peminjamanRuangan'] = $peminjaman_ruangan;
		$this->vars['allRole'] = $this->M_roles->get();
		$this->vars['dataRuangan'] = $this->M_ruangan->get();



		return view('private.peminjaman_ruangan.terima_peminjaman', $this->vars);
	}

	public function info($id)
	{
		$peminjaman = $this->M_peminjaman_ruangan->with('ruangan')->findOrFail($id);
		$peminjaman->statusPeminjaman = hStatusPeminjaman($peminjaman->status);

		$tanggal = indoDate($peminjaman->waktu_mulai, 'd-m-Y');
		$waktuMulai = indoDate($peminjaman->waktu_mulai, 'H:i');
		$waktuSelesai = indoDate($peminjaman->waktu_selesai, 'H:i');
		$peminjaman->tanggal = "$tanggal | $waktuMulai - $waktuSelesai";
		
		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($peminjaman, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}


	function load_similiar_peminjaman() 
	{
		$getData = $this->input->get();


		$similiarPeminjaman = '';
		if ($getData['ruangan_id'] != '' && $getData['tanggal'] != '') {
			$similiarPeminjaman = $this->M_peminjaman_ruangan->with('ruangan')->where([
				'ruangan_id' => $getData['ruangan_id'],
				'status' => '2',
			])
			->whereDate('waktu_mulai', date("Y-m-d", strtotime($getData['tanggal'])))
			->get();

			$similiarPeminjaman->each(function($similiar) {
				$similiar->tanggal = indoDate($similiar->waktu_mulai, 'd-m-Y');
				$similiar->waktuMulai = indoDate($similiar->waktu_mulai, 'H:i');
				$similiar->waktuSelesai = indoDate($similiar->waktu_selesai, 'H:i');
			});

		}


		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($similiarPeminjaman, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}
	public function update()
	{
		$post = $this->input->post();
		$inRuangan = $post['inputRuangan'];
		$inTanggal = date("Y-m-d", strtotime($post['inputTanggal']));
		$inWaktuMulai = date('Y-m-d H:i:s', strtotime($inTanggal . ' ' . $post['inputWaktuMulai']));
		$inWaktuSelesai = date('Y-m-d H:i:s', strtotime($inTanggal . ' ' . $post['inputWaktuSelesai']));


		$peminjaman = $this->M_peminjaman_ruangan->findOrFail($post['peminjaman_ruangan_id']);
		$peminjaman->status = $post['valueSubmit'];
		if($post['valueSubmit'] == '2')
		{
			$peminjaman->ruangan_id = $inRuangan;
			$peminjaman->waktu_mulai = $inWaktuMulai;
			$peminjaman->waktu_selesai = $inWaktuSelesai;
		}

		$peminjaman->save();

		
		$this->vars['status'] = 'success';

		$this->output
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($this->vars, JSON_HEX_APOS | JSON_HEX_QUOT))
		->_display();

		exit;
	}

}

/* End of file Peminjaman.php */
/* Location: ./application/controllers/private/Peminjaman.php */