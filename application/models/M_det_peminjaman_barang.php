<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_det_peminjaman_barang extends Eloquent
{
	protected $table = 'det_peminjaman_barang';
	protected $fillable = [
		'peminjaman_barang_id',
		'daftar_barang_id',
		'jumlah',
	];


	public function daftar_barang()
	{
		return $this->belongsTo(new M_daftar_barang());
	}

	public function peminjaman_barang()
	{
		return $this->belongsTo(new M_peminjaman_barang());
	}



}