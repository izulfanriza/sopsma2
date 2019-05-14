<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
	public $timestamps = false;
	protected $table = 'siswas';
	protected $primaryKey = 'nis';

	public function detailsiswa(){
        return $this->hasMany('Detailsiswa');
    }
}

