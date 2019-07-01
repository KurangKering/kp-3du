<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_keperluan extends Eloquent
{
	protected $table = 'keperluan';
	protected $fillable = ['keperluan'];


}