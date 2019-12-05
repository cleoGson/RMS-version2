<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Examinationmarks extends Model
{
  
    use LogsActivity,softDeletes;

    protected $table = 'examinationmarks';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'examinationtype_id',
         'marks',
         'out_of',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that are logged.
     *
     * @var array
     */
    protected static $logAttributes = [
         'examinationtype_id',
         'marks',
         'out_of',
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
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function types()
    {
        return $this->belongsTo(Examinationtype::class, 'examinationtype_id')->withDefault();
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
    public function getFullNameAttribute(){
        return $this->types->name ."(".$this->marks."/".$this->out_of.")";

    }
}
