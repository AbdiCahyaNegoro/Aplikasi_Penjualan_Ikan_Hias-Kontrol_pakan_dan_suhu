<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuhuAirIot extends Model
{
    use HasFactory;

    protected $table = 'suhuairiot';

    protected $fillable = [
        'waktu',
        'nilaisuhu',
    ];
}
