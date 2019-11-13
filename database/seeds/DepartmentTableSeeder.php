<?php

use Illuminate\Database\Seeder;
use App\Model\Department;
class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'name'=>'Information Communication Technology',
                'display_name'=>'ICT'
            ],
            [
                'name'=>'Human Resource',
                'display_name'=>'HR'
            ],
            [
                'name'=>'Account',
                'display_name'=>'AC'
            ],
            [
                'name'=>'Marketing',
                'display_name'=>'MT'
            ]
        ];
       
            Department::insert($data);
    }
}
