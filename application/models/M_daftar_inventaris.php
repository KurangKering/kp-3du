<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_daftar_inventaris extends Eloquent
{
	protected $table = 'daftar_inventaris';
	protected $fillable = [
		'nama',
		'satuan',
		'stock'
	];

	public function det_pengajuan_inventaris()
	{
		return $this->hasMany(new M_det_pengajuan_inventaris());
	}
	public function det_permintaan_inventaris()
	{
		return $this->hasMany(new M_det_permintaan_inventaris());
	}


}