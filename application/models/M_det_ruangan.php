<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_det_ruangan extends Eloquent
{
	protected $table = 'det_ruangan';
	protected $fillable = [
		'ruangan_id',
		'nama_inventaris',
		'jumlah',
		'satuan'
	];


	public function ruangan()
	{
		return $this->belongsTo(new M_ruangan());
	}

}