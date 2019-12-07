<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Attachment extends Model
{
 use LogsActivity, softDeletes;

    protected $table = 'attachments';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file',
        'attachment_type',
        'attachable_type',
        'attachable_id',
        'created_by',
        'updated_by',
        'remarks'
    ];

    /**
     * The attributes that are logged.
     *
     * @var array
     */
    protected static $logAttributes = [
        'file',
        'attachment_type', 
        'attachable_type',
        'attachable_id',
        'created_by',
        'updated_by',
        'remarks'
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


    public function attachable(){
        return $this->morphTo();
        }

    /**
     * A verifier belongs to users
     *      *
     * @return belongsTo
     */
    public function attachmentType()
    {
        return $this->belongsTo(Attachmenttype::class, 'attachment_type')->withDefault();
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
