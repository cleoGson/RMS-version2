<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\User;
use Hash;
use Laratrust\Traits\LaratrustUserTrait;


/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
*/
class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    protected $fillable = ['email', 
                            'username', 
                            'password',
                            'token',
                            'verifiedstatus', 
                            'userable_type',
                            'userable_id', 
                            'password_changed_at',
                            'image', 
                            'status', 
                            'created_by', 
                            'updated_by',
                        ];
    
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    
    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    
    
    
}
