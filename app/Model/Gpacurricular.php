<?php

namespace App\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Gpacurricular extends Model
{
   use LogsActivity, softDeletes;

    protected $table = 'gpacurriculars';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'year_id',
        'status', 
        'approved', 
        'approved_by', 
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
        'year_id',
        'status', 
        'approved', 
        'approved_by', 
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

    public function gpaCurricular(){
        return $this->belongsToMany(Gparange::class ,'gpacurricular_gparanges', 
        'gpacurricular_id', 'gparange_id',)->withTimestamps();
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
    public function updator()
    {
        return $this->belongsTo(User::class, 'updated_by')->withDefault();
    }

    
     /**
     * A verifier belongs to users
     *      *
     * @return belongsTo
     */
    public function approvedBy()
        {
        return $this->belongsTo(User::class, 'approved_by')->withDefault();
        }
}
