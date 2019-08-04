<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_peminjaman_barang extends Eloquent
{
	protected $table = 'peminjaman_barang';
	protected $fillable = [
		'nama',
		'kegiatan',
		'waktu_mulai',
		'status',
		'waktu_pengembalian',

	];

	public function det_peminjaman_barang()
	{
		return $this->hasMany(new M_det_peminjaman_barang(), 'peminjaman_barang_id', 'id');

	}
	
}