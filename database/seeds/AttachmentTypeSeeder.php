<?php

use Illuminate\Database\Seeder;
use App\Model\Attachmenttype;
class AttachmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data=[
            ['name'=>'Certificate',
            'display_name'=>'Certificate'],
            ['name'=>'Letter',
            'display_name'=>'Letter'
            ]          
    ];
        Attachmenttype::insert($data);
    }
}
