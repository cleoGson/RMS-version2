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
            'blood_group',
            'email', 
            'address', 
            'photo',
            'phone_no', 
            'student_number',
            'birth_country',
            'citizenship', 
            'course',
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
            'blood_group',
            'email', 
            'address', 
            'phone_no', 
            'student_number',
            'birth_country',
            'citizenship', 
            'course',
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
        return $this->belongsTo(Country::class, 'citizenship')->withDefault();
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
     * Get all of the posts for the user.
     */
    public function academicYearStudents()
    {
        return $this->hasMany(AcademicyearStudent::class);
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
        return $this->firstname." ".$this->middlename." ".$this->lastname;
    }

      public function copyUser(){
        if(!User::where("email",$this->email)->exists()){
            $user = new User();
            $user->email = $this->email;
            $user->username = $this->username;
            $user->password_changed_at = now();
            $user->phone_no = '255123456789';
             $user->userable_type = "App/Student";
            $user->userable_id = $this->id;
            $user->center_id = $this->center_id??1;
            $user->password = '$2y$10$hYn98f2N.XEuW9SD3jE8Tu6ElWLD5dmPmQLqsU5ULFFxO89/0kO9.';
            $user->verifiedstatus = 1;
            $user->status = 1;
            $user->save();
        }
    }

 
}
