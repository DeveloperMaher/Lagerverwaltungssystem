<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    use HasFactory;
    protected $table = 'lager_matieral';

    protected $fillable = [
        'material',
        'farbe',
        'höhe',
        'paket',
        'stück',
        'zweck',
        'date',
        'anmerkungen'
    ];

    public $timestamps = false;
}
