<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Course extends Model
{
 
    use LogsActivity, softDeletes;

    protected $table = 'courses';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'duration',
       'duration_unit',
       'description',
       'department_id',
       'level_id',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that are logged.
     *
     * @var array
     */
    protected static $logAttributes = [
       'duration',
       'duration_unit',
       'description',
       'department_id',
       'level_id',
        'created_by',
        'updated_by'
    ];



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
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id')->withDefault();
    }

    /**
     * A verifier belongs to levels
     *      *
     * @return belongsTo
     */
    public function levels()
    {
        return $this->belongsTo(Level::class, 'level_id')->withDefault();
    }  

     /**
     * A verifier belongs to levels
     *      *
     * @return belongsTo
     */
    public function durationunits()
    {
        return $this->belongsTo(Durationunit::class, 'duration_unit')->withDefault();
    } 

      public function getCourseNameAttribute()
    {
        return  $this->levels->name ." [ ".$this->duration ." (".$this->durationunits->name.")]";
    } 
}
