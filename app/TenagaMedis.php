<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaMedis extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = 'm_tenaga_medis';
    protected $fillable = ['tm_user_id', 'tm_nama', 'tm_jenis_kelamin', 'tm_tanggal_lahir', 'tm_alamat', 'tm_no_handphone', 'tm_email', 'tm_created_date'];
}
