<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
	public $timestamps = false;
	protected $table = 'kelas';
	protected $primaryKey = 'id_kelas';

	public function detailsiswa(){
        return $this->hasMany('Detailsiswa');
    }

    public function tahunajaran(){
        return $this->belongsTo('Tahunajaran');
    }

}

