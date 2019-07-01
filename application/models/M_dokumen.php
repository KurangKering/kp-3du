<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class M_dokumen extends Eloquent
{
	protected $table = 'dokumen';
	protected $fillable = ['keperluan'];


}