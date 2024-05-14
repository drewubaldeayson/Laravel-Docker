<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSavedClinic extends Model
{
    use HasFactory;

    /**
     * Table name of model
     *
     * @var string
     */
    protected $table = 'user_saved_clinics';

    /**
     * Primary key field name of table
     *
     * @var string
     */
    protected $primaryKey = 'saved_clinic_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'clinic_id',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function clinics(){
        return $this->belongsTo(Clinic::class, 'clinic_id', 'clinic_id');
    }

    public function clinic_address()
    {
        return $this->hasOneThrough(
            ClinicAddress::class,
            Clinic::class,
            'clinic_id', // Foreign key on the Clinic table...
            'clinic_address_id', // Foreign key on the ClinicAddress table...
            'clinic_id', // Local key on the ClinicServiceEvent table...
            'clinic_address_id' // Local key on the Clinic table...
        );
    }

    /**
     * Additional fields from other connected tables
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['created_at','updated_at'];
}
