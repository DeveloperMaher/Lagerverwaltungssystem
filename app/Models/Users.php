<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'user_table';

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'status_user',
        'last_seen',
        'last_activity',
        'active_user',
        'last_logged_out'
    ];

    public $timestamps = false;
}
