<?php

namespace App\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Grade;

class Grademark extends Model
{
    use LogsActivity, softDeletes;

    protected $table = 'grademarks';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'grade_id',
        'minimum_marks',
        'maximum_marks',
        'grade_point',
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
        'grade_id', 
        'minimum_marks',
        'maximum_marks',
        'grade_point',
        'created_by',
        'updated_by'
    ];



      /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id')->withDefault();
    }

     public function getGradeMarksAttribute()
    {
        return $this->grades->name." ( ".$this->minimum_marks.'/'.$this->maximum_marks." point-".$this->grade_point." )";
    }
    
    public function getGradeRangeAttribute(){
            $grade_name= $this->grades->name;
            $max_mark= $this->maximum_marks;
            $min_marks=$this->minimum_marks;
            $grading_package=array(
                'grade'=>$grade_name,
                'max_marks'=>$max_mark,
                'min_marks'=>$min_marks,
                'grade_point'=>$this->grade_point,
                'remarks'=>$this->grades->remarks,
            );
        return  $grading_package;
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
