<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';
    protected $primaryKey = 'id_pengiriman';


    protected $fillable = [
        'id_pesanan',
        'tanggal_pengiriman',
        'status',
        'nama_foto_resi',
        'folder',
    ];
    public $timestamps = false;
}
