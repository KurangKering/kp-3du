<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_lembar_disposisi extends Eloquent
{
	protected $table = 'lembar_disposisi';
	protected $fillable = ['nama','keperluan_id','ruangan_id','waktu_id','tgl_peminjaman'];



	public function reference() 
	{
		if ($this->reference_table === 'peminjaman_ruangan') {
			return $this->belongsTo(new M_peminjaman_ruangan(), 'reference_id');
		} 
		else if ($this->reference_table === 'pengajuan_inventaris') {
			return $this->belongsTo(new M_pengajuan_inventaris(), 'reference_id');
		}

	}

	public function keperluan()
	{
		return $this->belongsTo(new M_keperluan());
	}
	public function ruangan()
	{
		return $this->belongsTo(new M_ruangan());
	}
	public function waktu()
	{
		return $this->belongsTo(new M_waktu());
	}
	
}