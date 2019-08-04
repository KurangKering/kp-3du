<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_permintaan_inventaris extends Eloquent
{
	protected $table = 'permintaan_inventaris';
	protected $fillable = [

		'tanggal',

	];


	public function det_permintaan_inventaris()
	{
		return $this->hasMany(new M_det_permintaan_inventaris(), 'permintaan_inventaris_id', 'id');

	}

}