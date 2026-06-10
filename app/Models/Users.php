<?php

namespace App\Models;
use Carbon\Carbon;
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

    public function getLastSeenTextAttribute()
    {
        if ($this->status_user === 'online') {
            return '<strong class="text-success">Online Jetzt</strong>';
        }

        return Carbon::parse($this->last_logged_out)
            ->locale('de')
            ->diffForHumans();
    }

    public function isOnline()
    {
        return $this->status_user === 'online';
    }

    public function getSessionDurationAttribute()
    {
        if ($this->isOnline()) {
            return 'Die Sitzung geht weiter';
        }

        if (!$this->last_seen || !$this->last_logged_out) {
            return '-';
        }

        return Carbon::parse($this->last_seen)
            ->diffInMinutes(Carbon::parse($this->last_logged_out))
            . ' Min';
    }
}
