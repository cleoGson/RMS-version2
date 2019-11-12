<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

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
         'classsection_id',
         'grade_curricular',
         'minimum_capacity',
         'maximum_capacity',
         'curricular_id',
         'year_id',
         'created_by',
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
         'classsection_id',
         'grade_curricular',
         'minimum_capacity',
         'maximum_capacity',
         'curricular_id',
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
    public function gradings()
    {
        return $this->belongsTo(Gradecurricular::class, 'grade_curricular')->withDefault();
    }

    public function curricular()
    {
        return $this->belongsTo(Curricular::class, 'curricular_id')->withDefault();
    }
    
      /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function classsections()
    {
        return $this->belongsTo(Classsection::class, 'classsection_id')->withDefault();
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

