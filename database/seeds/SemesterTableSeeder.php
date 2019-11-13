<?php

use Illuminate\Database\Seeder;
use App\Model\Semester;
class SemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Semester I',
            'display_name'=>'Semester I'],
            ['name'=>'Semester II',
            'display_name'=>'Semester II']
    ];
    Semester::insert($data);
    }
}
