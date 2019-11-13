<?php

use Illuminate\Database\Seeder;
use App\Model\Marital;
class MaritalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Married',
            'display_name'=>'Married'],
            ['name'=>'Single',
            'display_name'=>'Single'],
            ['name'=>'Widow',
            'display_name'=>'Widow'
            ],
            ['name'=>'Devourced',
            'display_name'=>'Devource'],
            ['name'=>'Widower',
            'display_name'=>'Widower'
            ],
               
    ];
    Marital::insert($data);
    }
}
