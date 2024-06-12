<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisproduk extends Model
{
    use HasFactory;

    protected $table = 'jenisproduk';
    protected $primaryKey = 'id_jenisproduk';
    
    protected $fillable = [
        'jenis'
    ];
    public $timestamps = false;
}
