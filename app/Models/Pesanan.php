<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    
    protected $table = 'pesanan'; // Nama tabel sesuai dengan skema database
    protected $primaryKey = 'id_pesanan'; // Nama primary key

    protected $fillable = [
        'id_user',
        'status',
        'tanggalpesanan',
        'totalpesanan',
    ];
    public $timestamps = false;
}
