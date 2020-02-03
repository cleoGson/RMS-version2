<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
class Curricular extends Model
{
    use LogsActivity, softDeletes;

    protected $table = 'curriculars';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'semester_id',
        'year_id',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that are logged.
     *
     * @var array
     */
    protected static $logAttributes = [
        'name',
        'semester_id', 
        'year_id',
        'created_by',
        'updated_by'
    ];



    public function curricularSubjects(){
        return $this->belongsToMany(Subject::class ,'curriculars_subjects', 
        'curricular_id', 'subject_id')->withPivot('status','locked')->withTimestamps();
    }


     public function compulsoryCurricularSubjects(){
        return $this->belongsToMany(Subject::class ,'curriculars_subjects', 
        'curricular_id', 'subject_id')->withPivot('status','locked')->whereStatus(1);
    }

      public function optionalCurricularSubjects(){
        return $this->belongsToMany(Subject::class ,'curriculars_subjects', 
        'curricular_id', 'subject_id')->withPivot('status','locked')->whereStatus('0');
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

      /**
     * A verifier belongs to users
     *      *
     * @return belongsTo
     */
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by')->withDefault();
    }
  
}
