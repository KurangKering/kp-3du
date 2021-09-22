<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Mpdf;
use Illuminate\Database\Capsule\Manager as DB;

class Peminjaman_Barang extends Private_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$dataPeminjaman = $this->M_peminjaman_barang->latest()->get();
		$dataPeminjaman->each(function ($i) {
			$tanggal = indoDate($i->waktu_mulai, 'd-m-Y');
			$waktuMulai = indoDate($i->waktu_mulai, 'H:i');
			$waktuSelesai = indoDate($i->waktu_selesai, 'H:i');
			$i->tanggal = "$tanggal | $waktuMulai - $waktuSelesai";
		});
		$this->vars['dataPeminjaman'] = $dataPeminjaman;
		return view('private.peminjaman_barang.index', $this->vars);
	}

	public function indexReadOnly()
	{
		$dataPeminjaman = $this->M_peminjaman_barang->latest()->get();
		$dataPeminjaman->each(function ($i) {
			$tanggal = indoDate($i->waktu_mulai, 'd-m-Y');
			$waktuMulai = indoDate($i->waktu_mulai, 'H:i');
			$waktuSelesai = indoDate($i->waktu_selesai, 'H:i');
			$i->tanggal = "$tanggal | $waktuMulai - $waktuSelesai";
		});
		$this->vars['dataPeminjaman'] = $dataPeminjaman;
		return view('private.peminjaman_barang.index_read_only', $this->vars);
	}

	public function info($id)
	{
		$peminjamanBarang = $this->M_peminjaman_barang->with('det_peminjaman_barang.daftar_barang')->findOrFail($id);
		$tanggal = indoDate($peminjamanBarang->waktu_mulai, 'd-m-Y');
		$waktuMulai = indoDate($peminjamanBarang->waktu_mulai, 'd-m-Y H:i');
		$waktuPengembalian = $peminjamanBarang->waktu_pengembalian ? indoDate($peminjamanBarang->waktu_pengembalian, 'd-m-Y H:i') : '-';

		$peminjamanBarang->waktuMulai = $waktuMulai;
		$peminjamanBarang->waktuPengembalian = "$waktuPengembalian";

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($peminjamanBarang, JSON_HEX_APOS | JSON_HEX_QUOT))
			->_display();

		exit;
	}

	public function create()
	{
		$daftarBarang = $this->M_daftar_barang->get();
		$daftarPeminjaman = $this->M_peminjaman_barang->with('det_peminjaman_barang')->get();

		$daftarSedangDipinjam = $daftarPeminjaman->where('status', '1');


		$daftarBarangDipinjam = collect();

		$daftarBarang->each(function ($mstBarang) use ($daftarSedangDipinjam) {
			$jumlah = 0;
			$daftarSedangDipinjam->each(function ($daftarSedang) use ($mstBarang, &$jumlah) {

				$daftarSedang->det_peminjaman_barang
					->where('daftar_barang_id', $mstBarang->id)
					->first(function ($i) use (&$jumlah) {
						$jumlah += $i->jumlah;
					});
			});

			$mstBarang->sisa = $mstBarang->total - $jumlah;
		});

		$this->vars['daftarBarang'] = $daftarBarang;

		return view('private.peminjaman_barang.create', $this->vars);
	}
	public function store()
	{
		$response = $this->load->library('Response');


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

			if ($valSisa[$k] < $valJumlah[$k])
				$this->response->addError('Jumlah lebih besar dari sisa !', "$k");
		}


		$emptyTmpName = empty($_FILES['inputSyarat']['tmp_name']) ? true : false;
		$validFormats = ['image/png', 'image/jpg', 'image/jpeg'];
		$wrongFormat = (in_array($_FILES['inputSyarat']['type'], $validFormats)) ? false : true;

		if ($emptyTmpName) {
			$this->response->addError('Tidak ada file yang dipilih', 'inputSyarat');
		} else {
			if ($wrongFormat) {
				$this->response->addError('Hanya boleh memasukkan gambar', 'inputSyarat');
			}
		}
		$addErrorFile = $this->response->isSuccess() ? false : true;

		if (!$addErrorFile) {

			$fileToUpload = $_FILES['inputSyarat'];

			$file = [
				'field' => 'inputSyarat',
				'file' => $fileToUpload,

			];
			$uploadResponse = hUpload($file);

			$isUploaded = !empty($uploadResponse['upload_data']);

			if (!$isUploaded) {
				$errorsUpload = $uploadResponse['error'];
				$this->response->addError($errorsUpload, 'inputSyarat');
			}

			if ($this->response->isSuccess()) {
				$fileNameUploaded = $uploadResponse['upload_data']['file_name'];
				$inTanggal = date("Y-m-d", strtotime($post['inputTanggal']));
				$inWaktuMulai = date('Y-m-d H:i:s', strtotime($inTanggal . ' ' . $post['inputWaktuMulai']));
				// $inWaktuSelesai = date('Y-m-d H:i:s', strtotime($inTanggal . ' ' . $post['inputWaktuSelesai']));

				$formPeminjaman = [
					'nama' => $post['inputNama'],
					'kegiatan' => $post['inputKegiatan'],
					'waktu_mulai' => $inWaktuMulai,
					'waktu_selesai' => NULL,
					'bukti' => $fileNameUploaded,
					'status' => '1',
				];
				DB::beginTransaction();
				try {
					$insertPeminjaman = $this->M_peminjaman_barang->create($formPeminjaman);
					if ($insertPeminjaman) {
						$formDetailPeminjaman = [];
						foreach ($post['val_id'] as $key => $barangID) {
							$formDetailPeminjaman[] = [
								'peminjaman_barang_id' => $insertPeminjaman->id,
								'daftar_barang_id' => $post['val_id'][$key],
								'jumlah' => $post['val_jumlah'][$key],
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s"),
							];
						}
						$insertDetPeminjaman = $this->M_det_peminjaman_barang->insert($formDetailPeminjaman);
					}
					DB::commit();
				} catch (\Throwable $th) {
					DB::rollback();
				}
			}
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->response, JSON_HEX_APOS | JSON_HEX_QUOT))
			->_display();

		exit;
	}
	public function update()
	{
		$response = $this->load->library('Response');
		if ($this->input->post('val_id') == NULL) {
			$this->response->addError('Tidak Ada Barang yang di pilih', 'val_id');
		}
		foreach (($this->input->post('val_jumlah') ?? []) as $k => $jumlah) {
			if (!preg_match('/^\d+$/', $jumlah) || $jumlah <= 0)
				$this->response->addError('Value Hanya Berisi Angka !', "val_jumlah[$k]");
		}
		if ($this->response->isSuccess()) {
			$post = $this->input->post();
			$inTanggal = date("Y-m-d", strtotime($post['inputTanggal']));
			$inWaktuMulai = date('Y-m-d H:i:s', strtotime($inTanggal . ' ' . $post['inputWaktuMulai']));
			$inWaktuSelesai = date('Y-m-d H:i:s', strtotime($inTanggal . ' ' . $post['inputWaktuSelesai']));
			$peminjaman = $this->M_peminjaman_barang->with('det_peminjaman_barang')->findOrFail($post['peminjaman_barang_id']);
			$MasterDetIDs = $peminjaman->det_peminjaman_barang->pluck('id');
			$postDetID = $post['val_det_id'];
			$postJumlah = $post['val_jumlah'];
			$postBarangID = $post['val_id'];
			/**
			 * aksi hapus det_peminjaman_barang jika barang di hapus
			 */
			foreach ($MasterDetIDs as $key => $value) {
				$index = array_search($value, $postDetID);
				if ($index === FALSE) {
					$delDetail = $this->M_det_peminjaman_barang->findOrFail($value)->delete();
				}
			}
			foreach ($postDetID as $key => $value) {
				if ($value == 'undefined') {
					$newDetPeminjaman = $this->M_det_peminjaman_barang->create([
						'peminjaman_barang_id' => $peminjaman->id,
						'daftar_barang_id' => $postBarangID[$key],
						'jumlah' => $postJumlah[$key],
					]);
				} else {
					$detPeminjaman = $this->M_det_peminjaman_barang->where('id', $value)->get()->first();
					if ($detPeminjaman) {
						$detPeminjaman->daftar_barang_id = $postBarangID[$key];
						$detPeminjaman->jumlah = $postJumlah[$key];
						$detPeminjaman->save();
					}
				}
			}

			$formPeminjaman = [
				'nama' => $post['inputNama'],
				'kegiatan' => $post['inputKegiatan'],
				'waktu_mulai' => $inWaktuMulai,
				'waktu_selesai' => $inWaktuSelesai,
				'status' => $post['status'],
			];
			if ($post['status'] == '2') {
				$inTanggalPengembalian = date("Y-m-d", strtotime($post['inputTanggalPengembalian']));
				$inWaktuPengembalian = date('Y-m-d H:i:s', strtotime($inTanggalPengembalian . ' ' . $post['inputWaktuPengembalian']));
				$formPeminjaman['waktu_pengembalian'] = $inWaktuPengembalian;
			} else {
				$peminjaman->waktu_pengembalian = NULL;
			}

			$updatePeminjaman = $peminjaman->update($formPeminjaman);
		}



		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($this->response, JSON_HEX_APOS | JSON_HEX_QUOT))
			->_display();

		exit;
	}

	public function edit($id)
	{
		$peminjaman = $this->M_peminjaman_barang->with('det_peminjaman_barang')->findOrFail($id);

		$daftarBarang = $this->M_daftar_barang->get();
		$daftarPeminjaman = $this->M_peminjaman_barang->with('det_peminjaman_barang')->get();

		$daftarSedangDipinjam = $daftarPeminjaman
			->where('status', '1')
			->where('id', '!=', $peminjaman->id);


		$daftarBarangDipinjam = collect();

		$daftarBarang->each(function ($mstBarang) use ($daftarSedangDipinjam) {
			$jumlah = 0;
			$daftarSedangDipinjam->each(function ($daftarSedang) use ($mstBarang, &$jumlah) {

				$daftarSedang->det_peminjaman_barang
					->where('daftar_barang_id', $mstBarang->id)
					->first(function ($i) use (&$jumlah) {
						$jumlah += $i->jumlah;
					});
			});

			$mstBarang->sisa = $mstBarang->total - $jumlah;
		});

		$requestedBarang = [];
		foreach ($peminjaman->det_peminjaman_barang as $key => $detPeminjaman) {
			$requestedBarang[$key]['det_peminjaman_barang_id'] = $detPeminjaman->id;
			$requestedBarang[$key]['id'] = $detPeminjaman->daftar_barang->id;
			$requestedBarang[$key]['nama'] = $detPeminjaman->daftar_barang->nama_barang;
			$requestedBarang[$key]['satuan'] = $detPeminjaman->daftar_barang->satuan;
			$requestedBarang[$key]['jumlah'] = $detPeminjaman->jumlah;
			$requestedBarang[$key]['sisa'] = $daftarBarang->where('id', $detPeminjaman->daftar_barang->id)->sum('sisa');
		}

		$peminjaman->tanggal = date('d-m-Y', strtotime($peminjaman->waktu_mulai));
		$peminjaman->waktuMulai = date('H:i', strtotime($peminjaman->waktu_mulai));
		$peminjaman->waktuSelesai = date('H:i', strtotime($peminjaman->waktu_selesai));

		$peminjaman->tanggalPengembalian = NULL;
		if ($peminjaman->status == '2') {
			$peminjaman->tanggalPengembalian = date('d-m-Y', strtotime($peminjaman->waktu_pengembalian));
			$peminjaman->waktuPengembalian = date('H:i', strtotime($peminjaman->waktu_pengembalian));
		}


		$this->vars['peminjamanBarang'] = $peminjaman;
		$this->vars['requestedBarang'] = $requestedBarang;
		$this->vars['daftarBarang'] = $daftarBarang;

		return view('private.peminjaman_barang.edit', $this->vars);
	}

	public function proses()
	{
		$post = $this->input->post();
		$update = $this->M_peminjaman_barang->findOrFail($post['id']);
		$update->status = $post['status'];
		$update->save();


		$response['status'] = 'success';
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_HEX_APOS | JSON_HEX_QUOT))
			->_display();

		exit;
	}


	public function delete()
	{
		$id = $this->input->post('id');

		$dataPeminjaman = $this->M_peminjaman_barang
			->with('det_peminjaman_barang')
			->findOrFail($id);

		$dataPeminjaman->det_peminjaman_barang->each(function ($i) {
			$i->delete();
		});
		$dataPeminjaman->delete();


		$response['status'] = 'success';
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_HEX_APOS | JSON_HEX_QUOT))
			->_display();

		exit;
	}

	public function cetak()
	{
		$id = $this->input->get('id');

		$dataPeminjaman = $this->M_peminjaman_barang
			->with('det_peminjaman_barang')
			->findOrFail($id);

		$tanggal = indoDate($dataPeminjaman->waktu_mulai, 'd-m-Y');
		$waktuMulai = indoDate($dataPeminjaman->waktu_mulai, 'H:i');
		$waktuSelesai = indoDate($dataPeminjaman->waktu_pengembalian, 'H:i');
		$dataPeminjaman->waktu = "$tanggal | $waktuMulai - $waktuSelesai";


		$view = $this->load->view('private/peminjaman_barang/cetak', ['data' => $dataPeminjaman], true);

		$mpdf = new Mpdf();
		$mpdf->SetTitle("Cetak Peminjaman Barang #{$id}");
		$mpdf->WriteHTML($view);
		$mpdf->Output("Daftar Peminjaman Barang #{$id}.pdf", 'I');
	}

	public function rekap()
	{
		$inputTahun = $this->input->get('inputTahun');
		$inputBulan = $this->input->get('inputBulan');

		$dataPeminjaman = $this->M_peminjaman_barang
			->with('det_peminjaman_barang');

		$query = DB::table('det_peminjaman_barang')
			->select(DB::raw('daftar_barang.nama_barang, SUM(det_peminjaman_barang.jumlah) AS jumlah, daftar_barang.satuan'))
			->join('peminjaman_barang', 'det_peminjaman_barang.peminjaman_barang_id', '=', 'peminjaman_barang.id')
			->join('daftar_barang', 'det_peminjaman_barang.daftar_barang_id', '=', 'daftar_barang.id');

		$tahun = null;
		if (!empty($inputTahun)) {
			$query = $query->whereYear('waktu_mulai', '=', (int) $inputTahun);
			$tahun = $inputTahun;
		}

		$bulan = null;
		if (!empty($inputBulan)) {
			$query = $query->whereMonth('waktu_mulai', '=', (int) $inputBulan);
			$bulan = $inputBulan;
		}
		$query = $query->groupBy('det_peminjaman_barang.daftar_barang_id');
		$dataPeminjaman = $query->get();

		$bulan = $bulan != null ? hBulanHuman($inputBulan) : null;
		$tahun = $tahun;
		$title = "Rekap Peminjaman Barang";
		$title = $bulan ? $title .= " Bulan {$bulan}" : $title;
		$title = $tahun ? $title .= " Tahun {$bulan}" : $title;

		$subtitleBulan = !empty($bulan) ? "Bulan {$bulan}" : "";
		$subtitleTahun = !empty($tahun) ? "Tahun {$tahun}" : "";
		$subtitles = [];

		array_push($subtitles, $subtitleBulan);
		array_push($subtitles, $subtitleTahun);


		$subtitle = implode(' ', array_filter($subtitles));

		$data = [
			'subtitle' => $subtitle,
			'bulan' => $bulan,
			'tahun' => $tahun,
			'dataPeminjaman' => $dataPeminjaman,
		];

		$view = $this->load->view('private/peminjaman_barang/rekap', $data, true);

		$mpdf = new Mpdf();

		$mpdf->SetTitle($title);
		$mpdf->WriteHTML($view);
		$mpdf->Output("{$title}.pdf", 'I');
	}
}

 /* End of file Peminjaman.php */
/* Location: ./application/controllers/private/Peminjaman.php */