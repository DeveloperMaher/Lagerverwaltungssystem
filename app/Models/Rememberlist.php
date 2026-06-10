<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rememberlist extends Model
{
    use HasFactory;
    protected $table = 'remember_list';

    protected $fillable = [
        'material',
        'farbe',
        'höhe',
        'stück',
        'status',
    ];
    
    public $timestamps = false;
}
