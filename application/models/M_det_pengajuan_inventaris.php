<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_det_pengajuan_inventaris extends Eloquent
{
	protected $table = 'det_pengajuan_inventaris';
	protected $fillable = [
		'pengajuan_inventaris_id',
		'daftar_inventaris_id',
		'jumlah'
	];

	

	public function daftar_inventaris()
	{
		return $this->belongsTo(new M_daftar_inventaris());
	}

	public function pengajuan_inventaris()
	{
		return $this->belongsTo(new M_pengajuan_inventaris());
	}


}