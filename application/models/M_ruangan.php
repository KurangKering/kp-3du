<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_ruangan extends Eloquent
{
	protected $table = 'ruangan';
	protected $fillable = [
		'nama_ruangan'
	];


	public function peminjaman_ruangan()
	{
		return $this->hasMany(new M_peminjaman_ruangan());
	}

	
}