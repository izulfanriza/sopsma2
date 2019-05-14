<?php
namespace App\Exports;
use App\Detailsiswa;
​
use Excel;
​
class Detailsiswa implements FromCollection
{
    public function collection()
    {
        return Detailsiswa::all();
    }
}