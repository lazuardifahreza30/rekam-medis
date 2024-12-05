<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 't_jadwal_kunjungan';
    protected $fillable = ['jk_pasien_id', 'jk_dokter_id', 'jk_jenis', 'jk_no_antrian', 'jk_keluhan', 'jk_status', 'jk_created_date'];
}
