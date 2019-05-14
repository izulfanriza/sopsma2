<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahunajaran extends Model
{
	public $timestamps = false;
	protected $table = 'tahun_ajarans';
	protected $primaryKey = 'id_tahun_ajaran';

	public function kelas(){
        return $this->hasMany('Kelas');
    }
}

