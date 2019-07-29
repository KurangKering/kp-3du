<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_daftar_barang extends Eloquent
{
	protected $table = 'daftar_barang';
	protected $fillable = [
		'nama_barang',
		'satuan'
	];

	public function det_peminjaman_barang()
	{
		return $this->hasMany(new M_det_peminjaman_barang());
	}


}