<?php

namespace App\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Gparange extends Model
{
   use LogsActivity, softDeletes;

    protected $table = 'gparanges';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'from',
        'to',
        'approved',
        'approved_by',
        'locked',
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
        'from',
        'to',
        'approved',
        'approved_by',
        'locked',
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
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getAprovedAttribute($value)
    {
        $approvalstatus = $this->approved==1 ? "Approved" : "Not Approved";
        return  $approvalstatus; 
    }
    public function getGpaNameAttribute(){
        return $this->name.' ['.$this->to.'-'.$this->from.']';
    }
    public function getGpaPackageAttribute(){

        $gpa_package=array(
            'name'=>$this->name,
            'from'=>$this->from,
            'to'=>$this->to,
        );
        return $gpa_package;

    }
}
