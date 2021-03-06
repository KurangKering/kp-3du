<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_isi_disposisi extends Eloquent
{
	protected $table = 'isi_disposisi';
	protected $fillable = [
		'lembar_disposisi_id',
		'status',
		'isi_penolakan',
		'from_role_id',
		'destination_role_id'
	];

	public function lembar_disposisi()
	{
		return $this->belongsTo(new M_lembar_disposisi());
	}
	public function from_role()
	{
		return $this->belongsTo(new M_roles(), 'from_role_id', 'id');
	}
	public function destination_role()
	{
		return $this->belongsTo(new M_roles(), 'destination_role_id', 'id');
	}


}