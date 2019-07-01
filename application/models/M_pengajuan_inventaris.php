<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_pengajuan_inventaris extends Eloquent
{
	protected $table = 'pengajuan_inventaris';
	protected $fillable = ['nama','keperluan_id','ruangan_id','waktu_id','tgl_peminjaman'];

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

	public function lembar_disposisi() {
		return $this->hasOne(new M_lembar_disposisi, 'reference_id')->where('reference_table', 'pengajuan_inventaris');
	}
	
}