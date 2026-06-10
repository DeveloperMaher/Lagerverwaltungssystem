<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialList extends Model
{
    use HasFactory;
    protected $table = 'add_to_matieral_list';
    protected $fillable = [
        'name_material'
    ];
    public $timestamps = false;
}
