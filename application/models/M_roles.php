<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_roles extends Eloquent
{
	protected $table = 'roles';
	protected $fillable = [
		'role_name',
	];

	public function users()
	{

		return $this->hasMany(new M_users());
	}

	public function lembar_disposisi()
	{

		return $this->hasMany(new M_lembar_disposisi());
	}

	public function from_isi_disposisi()
	{

		return $this->hasMany(new M_isi_disposisi());
	}
	public function destination_isi_disposisi()
	{

		return $this->hasMany(new M_isi_disposisi());
	}
}