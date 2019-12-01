<?php

namespace App\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Feesamount extends Model
{
  use LogsActivity,softDeletes;

    protected $table = 'feesamounts';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
          'year_id',
          'fees_id',
          'amount',
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
          'year_id',
          'fees_id',
          'amount',
          'status',
          'approved',
          'approved_by',
          'created_by',
          'updated_by',
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
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by')->withDefault();
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
    public function fees()
    {
        return $this->belongsTo(Fees::class, 'fees_id')->withDefault();
    }

      public function getFeeNameAttribute()
    {
       return $this->fees->name." [".$this->amount.' (year-'.$this->years->name.") ]";
    }
}
