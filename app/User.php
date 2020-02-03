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
    use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
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
                            'reseted_ by',
                            'reseted_at',
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

     public function userable()
    {
        return $this->morphTo();
    }

     /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }
        /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id')->withDefault();
    }


    /**
     * A verifier belongs to users
     *      *
     * @return belongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by')->withDefault();
    }

    
    
    
}
