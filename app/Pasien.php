<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'm_pasien';
    protected $fillable = ['pasien_user_id', 'pasien_nama', 'pasien_jenis_kelamin', 'pasien_tanggal_lahir', 'pasien_alamat', 'pasien_no_handphone', 'pasien_email', 'pasien_created_date'];
}
