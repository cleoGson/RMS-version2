<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Model\Curricular;
use App\Model\Gpacurricular;
use App\Model\Academicyear;
use App\Model\Gradecurricular;
use App\Model\Examinationcurricular;

class Classsetup extends Model
{

    use LogsActivity,softDeletes;

    protected $table = 'classsetups';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name',
         'class_id',
         'grade_curricular',
         'minimum_capacity',
         'maximum_capacity',
         'locked',
         'result_system',
         'gpa_curricular',
         'gpa_applicable',
         'fees_structure',
         'year_id',
         'approved',
         'created_by',
         'approved_by',
         'updated_by',
         'status',

    ];

    /**
     * The attributes that are logged.
     *
     * @var array
     */
    protected static $logAttributes = [
         'name',
         'class_id',
         'grade_curricular',
         'minimum_capacity',
         'maximum_capacity',
         'locked',
         'result_system',
         'gpa_curricular',
         'gpa_applicable',
         'fees_structure',
         'year_id',
         'created_by',
         'updated_by',
         'status',
    ];

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
    public function centers()
    {
        return $this->belongsTo(Classroom::class, 'class_id')->withDefault();
    }

          /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function gpa()
    {
        return $this->belongsTo(Gpacurricular::class, 'gpa_curricular')->withDefault();
    }


       /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function feesStructureAmount()
    {
        return $this->belongsTo(Feesstructure::class, 'fees_structure')->withDefault();
    }
       /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function gradings()
    {
     return $this->belongsTo(Gradecurricular::class, 'grade_curricular')->withDefault();
    }

    public function subjectCurriculars(){
        return $this->belongsToMany(Curricular::class ,'classsetups_curricular', 
        'classsetup_id' ,'curricular_id')->withTimestamps();
    }
      public function examinationCurriculars(){
        return $this->belongsToMany(Examinationcurricular::class ,'classsetups_examcurricular', 
         'classsetup_id','examcurricular_id')->withTimestamps();
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
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    /**
     * A verifier belongs to users
     *      *
     * @return belongsTo
     */
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by')->withDefault();
    }
}

