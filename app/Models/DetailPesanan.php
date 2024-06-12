<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detailpesanan';
    protected $primaryKey = 'id_detailpesanan';
    
    protected $fillable = [
        'id_pesanan', 
        'id_produk', 
        'jumlah', 
        'qty', 
        'harga_satuan',
    ];
}
