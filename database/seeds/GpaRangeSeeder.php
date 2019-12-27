<?php

use Illuminate\Database\Seeder;
use App\Model\Gparange;
class GpaRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 $gparanges = array(
  array('id' => '1','name' => 'First Class','from' => '4.4','to' => '5','locked' => '0','created_by' => '2','updated_by' => '2','created_at' => '2019-12-27 10:39:38','updated_at' => '2019-12-27 10:41:21','deleted_at' => NULL),
  array('id' => '2','name' => 'Upper Second','from' => '3.5','to' => '4.3','locked' => '0','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-27 12:00:34','updated_at' => '2019-12-27 12:00:34','deleted_at' => NULL),
  array('id' => '3','name' => 'lower Second','from' => '2.7','to' => '3.4','locked' => '0','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-27 12:01:19','updated_at' => '2019-12-27 12:01:19','deleted_at' => NULL),
  array('id' => '4','name' => 'Pass','from' => '2','to' => '2.6','locked' => '0','created_by' => '2','updated_by' => NULL,'created_at' => '2019-12-27 12:01:59','updated_at' => '2019-12-27 12:01:59','deleted_at' => NULL)
);
Gparange::insert($gparanges);

    }
}
