<?php

use Illuminate\Database\Seeder;
use App\Setting\Bloodgroup;

class BloodgroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $data=[
            ['name'=>'A RhD positive (A+)',
            'display_name'=>'A RhD positive (A+)'],
            ['name'=>'A RhD negative (A-) ',
            'display_name'=>'A RhD negative (A-) '],
            ['name'=>'B RhD positive (B+) ',
            'display_name'=>'B RhD positive (B+) '
            ],
            ['name'=>'B RhD negative (B-) ',
            'display_name'=>'B RhD negative (B-) '],
            ['name'=>'O RhD positive (O+) ',
            'display_name'=>'O RhD positive (O+) '
            ] ,
             ['name'=>'O RhD negative (O-) ',
            'display_name'=>'O RhD negative (O-) '],
            ['name'=>'AB RhD positive (AB+) ',
            'display_name'=>'AB RhD positive (AB+) '],
            ['name'=>'AB RhD negative (AB-) ',
            'display_name'=>'AB RhD negative (AB-) ']              
    ];
        Bloodgroup::insert($data);
    }
}
