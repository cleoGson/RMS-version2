<?php

use Illuminate\Database\Seeder;
use App\Model\Feesamount;
class FeesAmountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $feesamounts = array(
  array('id' => '1','fees_id' => '1','year_id' => '1','amount' => '100000000','status' => '1','approved' => '1','approved_by' => '2','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-06 17:23:49','updated_at' => '2019-12-06 17:23:49','deleted_at' => NULL),
  array('id' => '2','fees_id' => '2','year_id' => '1','amount' => '20000','status' => '1','approved' => '1','approved_by' => '2','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-06 17:24:05','updated_at' => '2019-12-06 17:24:05','deleted_at' => NULL),
  array('id' => '3','fees_id' => '3','year_id' => '1','amount' => '1000','status' => '1','approved' => '1','approved_by' => '2','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-06 17:24:49','updated_at' => '2019-12-06 17:24:49','deleted_at' => NULL)
    );
    Feesamount::insert($feesamounts);
    }
}
