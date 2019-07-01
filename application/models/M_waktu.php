<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_waktu extends Eloquent
{
	protected $table = 'waktu';
	protected $fillable = ['mulai', 'selesai'];

	
}