<?php

use Illuminate\Database\Seeder;
use App\Model\Center;
class CenterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Dar es salaam',
            'display_name'=>'Dar es salaam'],
            ['name'=>'Mwanza',
            'display_name'=>'Mwanza'],
            ['name'=>'Kilimanjaro',
            'display_name'=>'Kilimanjaro'
            ],
            ['name'=>'Dodoma',
            'display_name'=>'Dodoma'],
            ['name'=>'Arusha',
            'display_name'=>'Arusha'
            ] 
            
    ];
    Center::insert($data);
    }
}
