<?php

namespace App\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Staff extends Model
{
    use LogsActivity, softDeletes;

    protected $table = 'staff';
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
                'check_no',
                'staff_number',
                'birth_country',
                'citzenship',
                'department_id',
                'designation_id',
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
                'marital_status',
                'birth_date',
                'disability',
                'birth_place',
                'email',
                'address',
                'phone_no',
                'check_no',
                'staff_number',
                'birth_country',
                'citzenship',
                'department_id',
                'designation_id',
                'created_by',
                'updated_by'
    ];

    /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function maritals()
    {
        return $this->belongsTo(Marital::class, 'marital_status')->withDefault();
    }
        /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function disabilityData()
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
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id')->withDefault();
    }

      /**
     * An applicant belongs to users
     *      *
     * @return belongsTo
     */
    public function designations()
    {
        return $this->belongsTo(Designation::class, 'designation_id')->withDefault();
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


    public function userAccount() {
        return $this->morphMany(User::class, 'userable')->orderBy('id','DESC');
    }
}
