<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Examinationcurricular extends Model
{
   
    use LogsActivity,softDeletes;

    protected $table = 'examinationcurriculars';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name',
         'status',
         'year_id',
         'semester_id',
         'verified',
         'verified_by',
         'created_by',
         'updated_by',
    ];

    /**
     * The attributes that are logged.
     *
     * @var array
     */
    protected static $logAttributes = [
         'name',
         'status',
         'year_id',
         'semester_id',
         'verified',
         'verified_by',
         'created_by',
         'updated_by',
    ];

     public function examinationCurriculars(){
        return $this->belongsToMany(Examinationmarks::class ,'examinationcurricular_exammarks', 
        'examinationcurricular_id', 'examinationmark_id',)->withTimestamps();
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
     * A verifier belongs to users
     *      *
     * @return belongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->withDefault();
    }
}
