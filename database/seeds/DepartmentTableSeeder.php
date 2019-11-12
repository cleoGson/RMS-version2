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
    
        for ($i=1; $i < 300; $i++) { 
            Department::create(
                  [ 
                'name' => "Air Receiver$i",
                 "display_name" => "Department$i",
                'created_by' => 1
                  ]
            );
        }
    
    }
}
