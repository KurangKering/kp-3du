<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_det_permintaan_inventaris extends Eloquent
{
	protected $table = 'det_permintaan_inventaris';
	protected $fillable = [
		'permintaan_inventaris_id',
		'daftar_inventaris_id',
		'jumlah'
	];

	

	public function daftar_inventaris()
	{
		return $this->belongsTo(new M_daftar_inventaris());
	}

	public function permintaan_inventaris()
	{
		return $this->belongsTo(new M_permintaan_inventaris());
	}


}