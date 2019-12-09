<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
class AcademicyearStudent extends Model
{
    use LogsActivity,softDeletes;

    protected $table = 'academicyear_students';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'student_id',
       'year_id',
       'studentstatus_id',
       'class_id',
       'classsetup_id',
       'created_by',
       'updated_by',
       'reporting_date',
       'remarks'
    ];

    /**
     * The attributes that are logged.
     *
     * @var array
     */
    protected static $logAttributes = [
       'student_id',
       'year_id',
       'studentstatus_id',
       'class_id',
       'classsetup_id',
       'classsection_id', 
       'created_by',
       'updated_by',
       'reporting_date',
       'remarks'
    ];



      /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by')->withDefault();
    }
      public function student()
    {
        return $this->belongsTo(Student::class, 'student_id')->withDefault();
    }
       
    public function studentStatus()
    {
        return $this->belongsTo(Studentstatus::class, 'studentstatus_id')->withDefault();
    }

      public function classSetup()
    {
        return $this->belongsTo(Classsetup::class,'classsetup_id')->withDefault();
    }

      public function class()
    {
        return $this->belongsTo(Classroom::class,'class_id')->withDefault();
    }

      public function classSection()
    {
        return $this->belongsTo(Classsection::class,'classsection_id')->withDefault();
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
     * A verifier belongs to users
     *      *
     * @return belongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class,'updated_by')->withDefault();
    }
}
