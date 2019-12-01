<?php

namespace App\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Familymember extends Model
{
    use LogsActivity, softDeletes;

    protected $table = 'familymembers';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'sex',
        'birth_date',
        'memberable_type',
        'memberable_id',
        'address',
        'disability',
        'phone_no',
        'email',
        'relationship',
        'created_by',
        'updated_by',

    ];

    /**
     * The attributes that are logged.
     *
     * @var array
     */
    protected static $logAttributes = [
        'firstname',
        'middlename',
        'lastname',
        'sex',
        'birth_date',
        'memberable_type',
        'address',
        'memberable_id',
        'disability',
        'phone_no',
        'email',
        'relationship',
        'created_by',
        'updated_by',
    ];

     public function memberable(){
        return $this->morphTo();
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

      public function disability()
    {
        return $this->belongsTo(Disability::class, 'disability')->withDefault();
    }

       public function relationship()
    {
        return $this->belongsTo(Familyrelationship::class, 'relationship')->withDefault();
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
