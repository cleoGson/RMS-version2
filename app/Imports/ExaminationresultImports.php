<?php

namespace App\Imports;

use App\Model\Examinationresult;
use App\Model\Classsetup;
use App\Model\Examinationcurricular;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Validator;
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
       $max_marks=$this->maximumMarks($this->request->examination_type,$this->request->classsetup_id,$this->request->semester_id);
        $validator=Validator::make($rows->toArray(), [
             "*.id" => "required|integer|exists:academicyear_students,id",
             "*.marks"=>"required|numeric|max:$max_marks",
             "*.remarks"=>"nullable|string",
         ]);
         if ($validator->fails()) {
        return redirect('/examination/classdetails/'.$this->request->class_id.'/'.$this->request->classsetup_id.'/'.$this->request->semester_id)
                        ->withErrors($validator)->withInput();
        }         
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
        public function maximumMarks($examinationtnature_id,$classsetup_id,$semester_id){
          if(!is_null($classsetup_id) && !is_null($semester_id)){ 
         $setup_data=Classsetup::findOrFail($classsetup_id);
         $semisters=$setup_data->examinationCurriculars->pluck('semester_id','id')->toArray();
         $exam_curricular_id=(!is_null($semisters) & in_array($semester_id,$semisters)) ? $semisters[$semester_id] :null;
         if(!is_null($exam_curricular_id)){
         $examinations=Examinationcurricular::findOrFail($exam_curricular_id);
         $examinationtype=$examinations->examinationCurriculars->pluck('marks','examinationtype_id')->toArray();
         $max_marks=(!is_null($examinationtype) & array_key_exists($examinationtnature_id,$examinationtype)) ? $examinationtype[$examinationtnature_id] :null;
         return $max_marks;
         }
       }
     }

}
