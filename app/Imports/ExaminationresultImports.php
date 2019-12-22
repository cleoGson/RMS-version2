<?php

namespace App\Imports;

use App\Model\Examinationresult;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Crypt;



class ExaminationresultImports implements ToCollection,WithHeadingRow
{


     protected $request;

    public function __construct(Object $request)
    {
        $this->request = $request;
    }
   
    public function collection(Collection $rows)
    {
      foreach($rows->toArray() as $data){
          $student_id=intval($data['id']);
          $semester_id=$this->request->semester_id;
          $subject_id=$this->request->subject;
          $class_id=$this->request->class_id;
          $year_id=$this->request->year_id;
          $classsection_id=$this->request->classsection_id;
          $examination_type=$this->request->examination_type;
          $student_marks=$data['marks'];
          $studed_validation=Examinationresult::where([
            ['academicyear_student_id','=',$student_id],
            ['semester_id','=',$semester_id],
            ['class_id','=',$class_id],
            ['examinationtype_id','=',$examination_type],
            ['subject_id','=',$subject_id]])->count();
            if($studed_validation<1){
             $dataz[]=[
                'academicyear_student_id'=> $student_id,
                'marks'=> $student_marks,
                'examination_nature'=>1,
                'remarks'=>$data['remarks'],
                'semester_id'=>$semester_id,
                'classsection_id'=>$classsection_id,
                'examinationtype_id'=>$examination_type,
                'class_id'=>$class_id,
                'year_id'=>$year_id,
                'subject_id'=>$subject_id,
                'created_by'=>auth()->id(),
            ];
            }
        }
      Examinationresult::insert($dataz);
    }
}
