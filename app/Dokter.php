<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'm_dokter';
    protected $fillable = ['dokter_user_id', 'dokter_nama', 'dokter_jenis_kelamin', 'dokter_tanggal_lahir', 'dokter_alamat', 'dokter_no_handphone', 'dokter_email', 'dokter_created_date'];
}
