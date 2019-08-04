<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_pengajuan_inventaris extends Eloquent
{
	protected $table = 'pengajuan_inventaris';
	protected $fillable = [
		'tanggal',
	];


	public function det_pengajuan_inventaris()
	{
		return $this->hasMany(new M_det_pengajuan_inventaris(), 'pengajuan_inventaris_id', 'id');

	}

}