<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_hi',
        'description_en',
        'description_hi',
        'open_date',
        'close_date',
        'file_path',
    ];

    protected $casts = [
        'open_date' => 'date',
        'close_date' => 'date',
    ];
}
