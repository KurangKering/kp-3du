<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_peminjaman_ruangan extends Eloquent
{
	protected $table = 'peminjaman_ruangan';
	protected $fillable = [
		'nama',
		'kegiatan',
		'ruangan_id',
		'waktu_mulai',
		'waktu_selesai',
		'status',
	];


	public function ruangan()
	{
		return $this->belongsTo(new M_ruangan());
	}

	public function lembar_disposisi() {
		return $this->hasOne(new M_lembar_disposisi(), 'peminjaman_ruangan_id', 'id');
	}

}