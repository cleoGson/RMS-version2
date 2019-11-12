<?php

namespace App\Model;
use App\User;
use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    protected $table = 'logs';
    
    protected $dates = ['last_login', 'last_logout'];

    protected $appends = ['email'];

    protected $fillable = [
        'last_login',
        'last_logout',
        'ip_address',
        'browser',
        'platform_family',
        'device_model',
        'browser_engine',
        'device_family',
        'browser_name',
        'browser_family',
        'platform_name',
        'is_bot',
        'auto_log',
        'user_id',
        'session_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function getEmailAttribute()
    {
        return $this->users->email;
    }

    public function getbotnameAttribute()
    {
        $isbot = $this->is_bot == 0 ? 'No' : 'Yes';

        return $isbot;
    }
}
