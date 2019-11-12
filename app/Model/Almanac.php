<?php

namespace App\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;


class Almanac extends Model
{
   
    use LogsActivity, softDeletes;

    protected $table = 'almanacs';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_date',
         'end_date',
         'center_id',
         'year_id',
         'event_id',
         'created_by',
         'updated_by',
         'description',

    ];

    /**
     * The attributes that are logged.
     *
     * @var array
     */
    protected static $logAttributes = [
        'start_date',
         'end_date',
         'center_id',
         'year_id',
         'event_id',
         'created_by',
         'updated_by',
         'description',

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
        return $this->belongsTo(Center::class, 'center_id')->withDefault();
    }
      /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function events()
    {
        return $this->belongsTo(Event::class, 'event_id')->withDefault();
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
