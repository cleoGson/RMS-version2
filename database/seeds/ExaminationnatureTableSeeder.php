<?php

use Illuminate\Database\Seeder;
use App\Model\Examinationnature;
class ExaminationnatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $data=[
            ['name'=>'Normal',
            'display_name'=>'Nm'],
            ['name'=>'Supplementary',
            'display_name'=>'Sup'],
            ['name'=>'Special Examination',
            'display_name'=>'Spcl'
            ] 
    ];
    Examinationnature::insert($data);
    }
}
