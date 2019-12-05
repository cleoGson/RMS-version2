<?php

namespace App\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Feesstructure extends Model
{
 use LogsActivity,softDeletes;

    protected $table = 'feesstructures';
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
          'updated_by',
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
          'updated_by',
    ];


   public function feesStructures(){
        return $this->belongsToMany(Feesamount::class ,'feestructure_amounts', 
        'feestructure_id', 'feesamount_id',)->withTimestamps();
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
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by')->withDefault();
    }
}
