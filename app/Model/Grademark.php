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
        'display_name',
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
        'display_name',
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
