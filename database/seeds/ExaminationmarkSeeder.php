<?php

use Illuminate\Database\Seeder;
use App\Model\Examinationmarks;
class ExaminationmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $examinationmarks = array(
        array('id' => '1','examinationtype_id' => '1','marks' => '20','out_of' => '100','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-06 17:28:04','updated_at' => '2019-12-06 17:28:04','deleted_at' => NULL),
        array('id' => '2','examinationtype_id' => '2','marks' => '20','out_of' => '100','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-06 17:28:19','updated_at' => '2019-12-06 17:28:19','deleted_at' => NULL),
        array('id' => '3','examinationtype_id' => '3','marks' => '10','out_of' => '100','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-06 17:28:34','updated_at' => '2019-12-06 17:28:34','deleted_at' => NULL),
        array('id' => '4','examinationtype_id' => '6','marks' => '50','out_of' => '100','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-06 17:29:05','updated_at' => '2019-12-06 17:29:05','deleted_at' => NULL)
        );
    Examinationmarks::insert($examinationmarks);
    }
}
