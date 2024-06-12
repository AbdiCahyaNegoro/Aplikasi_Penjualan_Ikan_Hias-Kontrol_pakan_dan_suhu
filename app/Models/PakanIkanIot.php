<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PakanIkanIot extends Model
{
    use HasFactory;

    protected $table = 'pakanikaniot';

    protected $fillable = [
        'waktu', 'TakaranPakan',
    ];
}
