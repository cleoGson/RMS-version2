<?php

use Illuminate\Database\Seeder;
use App\Model\Course;
class CourseTableSeeder extends Seeder
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
            'duration'=>2, 
            'duration_unit'=>1, 
            'description'=>"Few Description",
            'department_id'=>1, 
            'level_id'=>1, 
            'created_by'=>1,
            ],
             
            
    ];
    Course::insert($data);
    }
}
