<?php

use Illuminate\Database\Seeder;
use App\Model\GradeMark;
class GradeMarksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $grademarks = array(
  array('id' => '1','name' => 'category A [100,81]','display_name' => NULL,'grade_id' => '1','minimum_marks' => '81','maximum_marks' => '100','grade_point' => '5','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-06 17:13:52','updated_at' => '2019-12-06 17:13:52','deleted_at' => NULL),
  array('id' => '2','name' => 'category B[61,80]','display_name' => NULL,'grade_id' => '1','minimum_marks' => '61','maximum_marks' => '80','grade_point' => '4','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-06 17:14:38','updated_at' => '2019-12-06 17:14:38','deleted_at' => NULL),
  array('id' => '3','name' => 'category C[41,60]','display_name' => NULL,'grade_id' => '3','minimum_marks' => '41','maximum_marks' => '60','grade_point' => '3','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-06 17:15:25','updated_at' => '2019-12-06 17:15:25','deleted_at' => NULL),
  array('id' => '4','name' => 'categoryD[21,40]','display_name' => NULL,'grade_id' => '8','minimum_marks' => '21','maximum_marks' => '40','grade_point' => '2','created_by' => '2','updated_by' => '2','created_at' => '2019-12-06 17:15:57','updated_at' => '2019-12-06 17:17:47','deleted_at' => NULL),
  array('id' => '5','name' => 'category F[0,20]','display_name' => NULL,'grade_id' => '5','minimum_marks' => '0','maximum_marks' => '20','grade_point' => '1','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-06 17:18:14','updated_at' => '2019-12-06 17:18:14','deleted_at' => NULL)
  );
GradeMark::insert($grademarks);
    }
}
