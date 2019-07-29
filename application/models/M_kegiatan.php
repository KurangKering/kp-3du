<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_kegiatan extends Eloquent
{
	protected $table = 'kegiatan';
	protected $fillable = [
		'nama_kegiatan'
	];

	public function det_peminjaman_barang()
	{
		return $this->hasMany(new M_det_peminjaman_barang());
	}


}