<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => ucwords('admin'),
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
            'token' => str_random(9999),
            'verifiedstatus'=>1, 
             'userable_type'=>'App/Staff', 
             'userable_id'=>1, 
             'password_changed_at'=>date('Y-m-d h:m:s'), 
             'status'=>1, 
        ]);
        $user->assignRole('administrator');

    }
}
