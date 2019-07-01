<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

class M_users extends Eloquent
{
	protected $table = 'users';
	protected $fillable = ['nama', 'username', 'email', 'password', 'role_id'];

	 /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
	 protected $hidden = [
	 	'password',
	 ];

	 public function role()
	 {
	 	return $this->belongsTo(new M_roles());
	 }

	}