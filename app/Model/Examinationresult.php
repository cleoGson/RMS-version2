<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use Crypt;
use App\Model\Semester;
use App\Model\Classroom;
use App\Model\Classsection;
use App\Model\AcademicyearStudent;
use App\Model\Student;
use App\Model\Examinationtype;

class Examinationresult extends Model
{   
    use LogsActivity,softDeletes;
    protected $table = 'examinationresults';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'class_id',
         'classsection_id',
         'examination_nature',
         'student_id',
         'academicyear_student_id',
         'examinationtype_id',
         'semester_id',
         'year_id',
         'subject_id',
         'created_by',
         'updated_by',
         'marks',
         'remarks',
    ];

    /**
     * The attributes that are logged.
     *
     * @var array
     */
    protected static $logAttributes = [
         'class_id',
         'classsection_id',
         'examination_nature',
         'student_id',
         'academicyear_student_id',
         'examinationtype_id',
         'semester_id',
         'year_id',
         'subject_id',
         'created_by',
         'updated_by',
         'marks',
         'remarks',
    ];


    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setmarksAttribute($value)
    {
        $this->attributes['remarks'] = Crypt::encrypt($value);
    }

   
    

     /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function classes()
    {
        return $this->belongsTo(Classroom::class, 'class_id')->withDefault();
    }

         /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id')->withDefault();
    }


         /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function classsections()
    {
        return $this->belongsTo(Classection::class, 'subject_id')->withDefault();
    }
 
    /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id')->withDefault();
    }


          /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function academicyearStudent()
    {
        return $this->belongsTo(AcademicyearStudent::class, 'academicyear_student_id')->withDefault();
    }


         /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function examinationsType()
    {
        return $this->belongsTo(Examinationtype::class, 'examinationtype_id')->withDefault();
    }


    
       /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function years()
    {
        return $this->belongsTo(Academicyear::class, 'year_id')->withDefault();
    }

         /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function semesters()
    {
        return $this->belongsTo(Semester::class, 'semester_id')->withDefault();
    }

      /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    /**
     * A verifier belongs to users
     *      *
     * @return belongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->withDefault();
    }
}
