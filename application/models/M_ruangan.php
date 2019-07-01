<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_ruangan extends Eloquent
{
	protected $table = 'ruangan';
	protected $fillable = ['nama'];

	
}