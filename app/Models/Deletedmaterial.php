<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deletedmaterial extends Model
{
    use HasFactory;
    protected $table = 'lager_deleted_material';

    protected $fillable = [
        'id',
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
