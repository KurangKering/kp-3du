<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_isi_disposisi extends Eloquent
{
	protected $table = 'isi_disposisi';
	protected $fillable = ['lembar_disposisi_id','isi','from','destination'];

	public function lembar_disposisi()
	{
		return $this->belongsTo(new M_lembar_disposisi());
	}
	
	
}