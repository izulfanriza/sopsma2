<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detailsiswa extends Model
{
	public $timestamps = false;
	protected $table = 'detail_siswas';
	protected $primaryKey = 'id_detail_siswa';

	public function siswa(){
        return $this->belongsTo('Siswa');
    }

    public function kelas(){
        return $this->belongsTo('Kelas');
    }
}

