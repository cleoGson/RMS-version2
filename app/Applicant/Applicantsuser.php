<?php

namespace App\Applicant;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Applicantsuser extends Authenticatable
{
  use Notifiable;

        protected $guard = 'applicants';

        protected $fillable = [
            'name', 'email', 'password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
}
