<?php

namespace App\Http\Controllers\Examination;
use App\Http\Controllers\Controller;
use App\Model\Examinationnaature;
use App\Model\Examinationresult;
use App\Model\Examinationcurricular;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Model\Academicyear;
use App\Model\Classsection;
use App\Model\Classroom;
use App\Model\Gradecurricular;
use App\Model\AcademicyearStudent;
use App\Model\Curricular;
use App\Model\Feesstructure;
use App\Rules\MarksvalidatorRule;
use App\Rules\ResultPostingRule;
use App\Model\Examinationnature;
use App\Model\Classsetup;
use App\Exports\AcademicyearStudentExport;
use App\Imports\ExaminationresultImports;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Examination\ExaminationresultRequest;
use DB;
use Crypt;
use App\Model\Semester;

class ClassreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if(!is_null($request->year_id)){
        $this->validate($request,[
            'year_id'=>'required|exists:academicyears,id',
        ]);
        }
         $classes=Classroom::pluck('name','id')->toArray();
          $years=Academicyear::pluck('name','id')->toArray();
          $year_id = !is_null($request->year_id) ?  $request->year_id : Academicyear::whereStatus('open')->first()->id;
          $year_data=Academicyear::findOrFail($year_id);
          foreach($classes as $key=>$value){
            $student_data=AcademicyearStudent::with(['student'])->where([['class_id','=',$key],['year_id','=', $year_id]]);
           $studentsprovider[$key]=array('students'=>$student_data->get(),
                                    'number_student'=>$student_data->count(),
                                    'year'=>$year_data->name,
                                    'class_id'=>$key,
                                    'class_name'=>$value,
                                    'year_id'=> $year_id,
                                    'classsetup_name'=>!is_null($student_data->first()) ? $student_data->first()->classSetup->name : "",
                                    'classsetup_id'=>!is_null($student_data->first()) ? $student_data->first()->classSetup->id : 0,

                                    
                                );
          }
     return view('examinations.class_reports.index',compact(['studentsprovider','years'])); 

    }
     public function studentsLists(DataTables $dataTables,$classid,$yearid){    
                $classsetup_id=1;
         $students =  $student_data=AcademicyearStudent::with(['createdBy','student','createdBy','years','studentStatus','class','classSetup','classSection'])
                ->where([['class_id','=',$classid],['year_id','=',$yearid]])->get();  
          $yeardetails=Academicyear::findOrFail($yearid);
         $setup_data=Classsetup::findOrFail($classsetup_id);
         $grading_curricular=$setup_data->gradings->gradeCurricular->pluck('grade_range','id')->toArray();
         $semesters=Semester::pluck('name','id')->toArray();
         $semisters=$setup_data->examinationCurriculars->pluck('semester_id','id')->toArray();

         foreach($semisters  as $key=>$value){
             $subjectCurricular=Curricular::findOrFail($key);
             $examinations=Examinationcurricular::findOrFail($key);
              $examinationtype=$examinations->examinationCurriculars->pluck('partial_name_two','examinationtype_id')->toArray();
              $subjects=$subjectCurricular->curricularSubjects->pluck('name','id')->toArray();
              foreach($students as $studentData){

              foreach($subjects as $keysubj=>$valuesubj){

              foreach( $examinationtype as $keyExam=>$valueExam){
             $data_marks=Examinationresult::where([['academicyear_student_id','=',$studentData->id],['year_id','=',$yearid],
             ['semester_id','=',$value],['subject_id','=',$keysubj],['examinationtype_id','=',$keyExam]])->first();
             $marksvalue=!is_null($data_marks) ?  $data_marks['marks'] : 0;
             $marks_provider[$keyExam]=array(
                 'marks'=>$marksvalue,
                 'exam_type'=>$valueExam,
             );
             $total_marks[$keyExam]=$marksvalue;
            }
            $markssum=array_sum($total_marks);
            foreach($grading_curricular as $gradingpackage){
                    if(($markssum >= $gradingpackage['min_marks']) && ($markssum <= $gradingpackage['max_marks'] ) ){
                      $grade_required= $gradingpackage['grade'];
                      $grade_point = $gradingpackage['grade_point'];
                      $grade_remark= $gradingpackage['remarks'];
                      break;
                    }
            }
             $subject_provider[$keysubj.$key]=array(
                 'exam_marks'=>$marks_provider,
                 'subject_name'=>$valuesubj,
                 'total_marks'=>$markssum,
                 'point'=>$grade_point,
                 'grade'=>$grade_required,
                 'remarks'=>$grade_remark,
             );

              }
      
              $all_results[$studentData->id]=array(
                'examinations'=>$subject_provider,
                'subject_number'=> count($subjects),
                'full_name'=>$studentData->student->full_name,
                'student_number'=>$studentData->student->student_number,
            );
            unset($subject_provider);

         }

         $data_all_data1[$value]=array(
             'result'=>$all_results,
             'semester_name'=>$semesters[$value],
             'examination_list'=>$examinationtype,
             'subject_list'=> $subjects,
         );
            
         }
        
         
                 $data_all_data = $data_all_data1;   
                 $classdetails=Classroom::findOrFail($classid);
                 $yeardetails=Academicyear::findOrFail($yearid);
    
                 return view('examinations.class_reports.student_list',compact('classdetails','yeardetails','data_all_data','grading_curricular'));
             }
}
