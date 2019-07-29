<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_lembar_disposisi extends Eloquent
{
	protected $table = 'lembar_disposisi';
	protected $fillable = [
		'position_role_id',
		'status',
		'tanggal',
		'peminjaman_ruangan_id',
	];



	public function peminjaman_ruangan()
	{
		return $this->belongsTo(new M_peminjaman_ruangan());
	}

	public function position_role()
	{
		return $this->belongsTo(new M_roles());
	}

	public function isi_disposisi()
	{
		return $this->hasMany(new M_isi_disposisi(), 'lembar_disposisi_id', 'id');
	}




}