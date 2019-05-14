<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
	public $timestamps = false;
	protected $table = 'transaksis';
	protected $primaryKey = 'id_transaksi';

	// public function detailsiswa(){
 //        return $this->hasMany('Detailsiswa');
 //    }

    public function siswa(){
        return $this->belongsTo('Siswa');
    }

}

