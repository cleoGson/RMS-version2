<?php

namespace App\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Student extends Model
{
    use LogsActivity, softDeletes;

    protected $table = 'students';
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
            'marital_status', 
            'birth_date',
            'disability',
            'birth_place',
            'email', 
            'address', 
            'phone_no', 
            'student_number',
            'birth_country',
            'citzenship', 
            'created_by',
            'updated_by'
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
            'disability',
            'birth_place',
            'email', 
            'address', 
            'phone_no', 
            'student_number',
            'birth_country',
            'citzenship', 
            'created_by',
            'updated_by'
    ];



         /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function disability()
    {
        return $this->belongsTo(Disability::class, 'disability')->withDefault();
    }
        /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function countries()
    {
        return $this->belongsTo(Country::class, 'birth_country')->withDefault();
    }
        /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function citizens()
    {
        return $this->belongsTo(Country::class, 'citzenship')->withDefault();
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
